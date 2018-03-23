<?php
  require_once '2FA.php';

  header('Content-type: application/json');

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
      if(isset($_POST["secret"])) {
        $twoFa = new TwoFactorAuthenticator();
        echo json_encode(array("Status" => true, "Code" => $twoFa->getCode($_POST["secret"])));
      }
      else {
        echo json_encode(array("Status" => false, "Message" => "Missing parameters"));
      }
      break;

    default:
      echo json_encode(array("Status" => false, "Message" => "Wrong Request method"));
      break;
  }
