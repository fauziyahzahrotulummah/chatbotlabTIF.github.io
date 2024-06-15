<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Lab TIF</title>
    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Chatbot Lab TIF</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hai, ada yang bisa saya bantu? </p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="text-message" type="text" placeholder="Ketikkan sesuatu disini..." required>
                <button id="send-btn">Kirim</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#text-message").keypress(function(event) {
                if (event.which == 13) {
                    event.preventDefault();
                    $("#send-btn").click();
                }
            });

            $("#send-btn").on("click", function(){
                var message = $("#text-message").val();
                var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ message +'</p></div></div>';
                
                $(".form").append(msg);
                $("#text-message").val('')

                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'isi_message=' + message,
                    success: function(result){
                        var reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append(reply);
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
</body>
</html>
