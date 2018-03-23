<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<title>2 Factor Authentication Test</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<?php

require_once '2FA.php';

$twoFa = new TwoFactorAuthenticator();

if(!isset($_GET["secret"])) {
  $secret = $twoFa->CreateSecret();
}
else {
  $secret = $_GET["secret"];
}
echo '<div>secret: <i id="secret">'.$secret.'</i></div>';
echo '<div>qr: <img style="display:block;" src="'.$twoFa->getQRCodeGoogleUrl('test', $secret, 'test').'"/></div>';

?>
<div>check code: <input type="text" id="codeInput" placeholder="Code" /> <button id="checkCode">check</button></div>
<div>status: <span id="status">Not Checked</span></div>
<script>
  $('#checkCode').click(function() {
    var secretKey, codeIn;
    secretKey = $('#secret').text();
    codeIn = $('#codeInput').val();

    $.ajax({
      url: "checkCode.php",
      type: "POST",
      data: {secret:secretKey, code:codeIn},
      success: function(result){
        if(result.Message) {
          $('#status').text(result.Message);
        }
      }
    });
  });
</script>
</body>
</html>
