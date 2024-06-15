import re
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
import enchant
import sys
import json
import pymysql

def preprocess_text(text):
    # Lakukan casefolding
    text = text.lower()
    # print("Teks setelah casefolding:", text)

    # Lakukan filtering stopwords
    stopword_factory = StopWordRemoverFactory()
    stopword_remover = stopword_factory.create_stop_word_remover()
    text = stopword_remover.remove(text)
    # print("Teks setelah filtering stopwords:", text)

    # Lakukan stemming
    stemmer_factory = StemmerFactory()
    stemmer = stemmer_factory.create_stemmer()
    text = stemmer.stem(text)
    # print("Teks setelah stemming:", text)

    # Lakukan tokenizing
    tokens = re.findall(r'\b\w+\b', text)
    # print("Tokens hasil tokenizing:", tokens)

    return tokens

def spelling_correction(tokens):
    # Inisialisasi Enchant untuk bahasa Indonesia
    dictionary = enchant.Dict("id_ID")

    corrected_tokens = []
    for token in tokens:
        if not dictionary.check(token):
            suggestions = dictionary.suggest(token)
            if suggestions:
                corrected_token = suggestions[0]
            else:
                corrected_token = token
        else:
            corrected_token = token
        corrected_tokens.append(corrected_token)

    return corrected_tokens

def kmp_search(tokens, pattern):
    matches = []
    text = ' '.join(tokens)
    n = len(text)
    m = len(pattern)
    lps = compute_lps_array(pattern)
    i = 0  # index for text[]
    j = 0  # index for pattern[]
    while i < n:
        if pattern[j] == text[i]:
            i += 1
            j += 1
        if j == m:
            matches.append(i - j)
            j = lps[j - 1]
        elif i < n and pattern[j] != text[i]:
            if j != 0:
                j = lps[j - 1]
            else:
                i += 1
    return matches

def compute_lps_array(pattern):
    m = len(pattern)
    lps = [0] * m
    length = 0
    i = 1
    while i < m:
        if pattern[i] == pattern[length]:
            length += 1
            lps[i] = length
            i += 1
        else:
            if length != 0:
                length = lps[length - 1]
            else:
                lps[i] = 0
                i += 1
    return lps

def main():
    if len(sys.argv) != 2:
        sys.exit(1)
    
    input_text = sys.argv[1]
    
    # Preprocessing
    preprocessed_text = preprocess_text(input_text)
    corrected_text = spelling_correction(preprocessed_text)
    # print("Teks setelah preprocessing dan spelling correction:", ' '.join(corrected_text))
    
    connection = pymysql.connect(host='localhost',
                                 user='root',
                                 password='',
                                 database='chatbot',
                                 cursorclass=pymysql.cursors.DictCursor)

    try:
        with connection.cursor() as cursor:
            sql = "SELECT pattern FROM tb_pattern"
            cursor.execute(sql)
            patterns = cursor.fetchall()

            matched_patterns = []
            for row in patterns:
                pattern = row['pattern']
                matches = kmp_search(corrected_text, pattern)
                if matches:
                    matched_patterns.append(pattern)


        connection.close()

        responses = []
        if matched_patterns:
            connection = pymysql.connect(host='localhost',
                                         user='root',
                                         password='',
                                         database='chatbot',
                                         cursorclass=pymysql.cursors.DictCursor)
            with connection.cursor() as cursor:
                for pattern in matched_patterns:
                    sql = """
                        SELECT response
                        FROM tb_response
                        WHERE id_kategori IN (SELECT id_kategori FROM tb_pattern WHERE pattern LIKE %s)
                    """
                    cursor.execute(sql, ('%' + pattern + '%',))
                    rows = cursor.fetchall()
                    for row in rows:
                        responses.append(row['response'])

            connection.close()
        # Cetak respons yang ditemukan
        # print("Responses found:", responses)

        # Mengembalikan hasil pencarian pola dalam format JSON
        print(json.dumps(responses))

    except Exception as e:
        print("Error:", e)
        connection.close()

if __name__ == "__main__":
    main()