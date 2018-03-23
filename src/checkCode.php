<?php
  require_once '2FA.php';

  header('Content-type: application/json');

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
      if(isset($_POST["secret"]) && isset($_POST["code"])) {
        $twoFa = new TwoFactorAuthenticator();

        $checkResult = $twoFa->verifyCode($_POST["secret"], $_POST["code"], 2);    // 2 = 2*30sec clock tolerance
        if ($checkResult) {
            echo json_encode(array("Status" => true, "Message" => "Passed"));
        } else {
            echo json_encode(array("Status" => false, "Message" => "Code Denied", "Secret" => $_POST["secret"], "Code" => $_POST["code"]));
        }
      }
      else {
        echo json_encode(array("Status" => false, "Message" => "Missing parameters"));
      }
      break;

    default:
      echo json_encode(array("Status" => false, "Message" => "Wrong Request method"));
      break;
  }
