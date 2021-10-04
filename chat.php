<?php
	ob_start();
	session_start();
	require_once 'language.php';

	$sessid = session_id();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="chat">
      <div style ="display: flex; justify-content: center; margin-bottom: 20px;">
        <input type="text" name="" placeholder="Введите псевдоним" class="input_username_chat" value = "User12345">
        <button id = "change_username_button" name = "connect_to">Изменить</button>
      </div>
      <div class="chat-container">
        <div class="chat-frame">
          <div class="chat-fix" style="margin-top: 30px;">
            <div class="chat-fix-your" style="margin-left: 120px;">
            </div>
          </div>
        </div>
        <div style ="display: flex; justify-content: center;">
          <input type="text" name="" placeholder="Введите сообщение для чата" class="input_chat">
        </div>
      </div>
    </div>
    <script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
      $('body').ready(function() {
        var timer = setTimeout(update_messages, 400);
        var cout_message = 0;

        $('.input_chat').keypress(function (e) {
          if (e.which == 13) {
            if($('.input_chat').val().trim() != '') {
              put_message_to_server($('.input_username_chat').val(), $('.input_chat').val());
            } else {
              $('.input_chat').val('');
            }
            return false;
          }
        });

        function update_messages() {
					var session_id = /SESS\w*ID=([^;]+)/i.test(document.cookie) ? RegExp.$1 : false;

          $.ajax({
                type: "POST",
                url: 'chat_update_message.php',
    						dataType: "json",
                success: function(data){
									$('.chat-fix').html('');

									data.messages.forEach(function(item, i, arr) {
										if(session_id == data.sessions[i]) {
											$('.chat-fix').append('<div class="chat-fix-your" style="margin-left: 120px;"><div class="your-message-chat"><span style="font-family: GothamSSm Narrow Light;">You:</span><br>' + item + '</div></div>');
										} else {
											if(data.accesses[i] == 1) {
												$('.chat-fix').append('<div class="message-chat" style = "background: #e56565"><span style="font-family: GothamSSm Narrow Light;">' + data.usernames[i] + '</span><br>' + item + '</div>');
											} else {
												$('.chat-fix').append('<div class="message-chat"><span style="font-family: GothamSSm Narrow Light;">' + data.usernames[i] + '</span><br>' + item + '</div>');
											}
										}
									});

									if(data.messages.length > cout_message) {
										cout_message = data.messages.length;
										$('.chat-frame').scrollTop($('.chat-frame').prop('scrollHeight'));
									}
                }
           });
          timer = setTimeout(update_messages, 400);
        }

        function put_message_to_server(user, mes) {
          $.ajax({
                type: "POST",
                url: 'chat_put_message.php',
                data: {
                  message: mes,
                  username: user,
                  id_channel: 1212
                },
                success: function(response) {
                  $('.chat-fix').append('<div class="chat-fix-your" style="margin-left: 120px;"><div class="your-message-chat"><span style="font-family: GothamSSm Narrow Light;">You:</span><br>' + $('.input_chat').val() + '</div></div>');
                  last_message = $('.input_chat').val();

                  $('.input_chat').val('');
                  $('.chat-frame').scrollTop($('.chat-frame').prop('scrollHeight'));
                }
           });
         }
      });
    </script>
  </body>
</html>

<?php
	ob_end_flush();
?>
