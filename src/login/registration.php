<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

require_once "vendor/autoload.php";
require_once 'class-db.php';

global $password;
$password = "taskTree123";

$arr_message = array();
if (isset($_POST['submit'])) {
 
    // check for spam
    if(!empty($_POST['honeypot'])) {
        die('Spams are not allowed!');
    }
 
    $db = new DB();
    if(!$db->email_exists($_POST['email'])) {
 
        $activation_key = sha1(mt_rand(10000,99999).time().$_POST['email']);
 
        $db->insert_user(
            array(
                'fullname' => $_POST['fullname'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'activation_key' => $activation_key,
            )
        );
 
        // send activate account email
        // try {
        //     $mail = new PHPMailer(true);
 
        //     $mail->isMail();
        //     $mail->Host = 'smtp.gmail.com'; // host
        //     $mail->SMTPDebug = 2;
        //     $mail->SMTPAuth = true;
        //     $mail->Username = 'tasktreellc@gmail.com'; //username
        //     $mail->Password = $password; //password
        //     $mail->SMTPSecure = 'ssl';
        //     $mail->Port = 465; //smtp port
        //     $mail->Sendmail = 'C:\xampp\sendmail';
        //     $mail->setFrom('tasktreellc@gmail.com', 'SENDER NAME', 0);
        //     $mail->addAddress($_POST['email'], $_POST['fullname']);
         
        //     $mail->isHTML(true);
        //     $mail->Subject = 'Activate Your Account';
        //     $mail->Body    = 'Hello '.ucwords($_POST['fullname']).',<br>
        //                     <p>Click the link below to activate your account.</p>
        //                     <a href="DOMAIN_URL/activate.php?key='.$activation_key.'">Activate Account</a><br>
        //                     Thanks,<br>Admin';
         
        //     $mail->send();
        //     $arr_message = array('class' => 'success', 'message' => 'We have sent an activation link on your email. Please activate your account.');
        // } catch (Exception $e) {
        //     $arr_message = array('class' => 'error', 'message' => 'Email could not be sent. Mailer Error: '. $mail->ErrorInfo);
        // }
        header('Location: login.php');
    } else {
        $arr_message = array('class' => 'error', 'message' => 'Email is already exist.');
    }
}
?>

<head>
  <link rel="stylesheet" href="form.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>

<style>
label.error {
    color:red;
    width: 76%;
font-weight: 700;
font-size: 14px;
letter-spacing: 1px;
padding: 10px 20px;
margin-bottom: 50px;
margin-left: 46px;
text-align: center;
margin-bottom: 27px;
font-family: 'Ubuntu', sans-serif;
}
</style>
<div class="main1">
    <p class="sign" align="center">Sign up</p>
    <form class="form1" method="post" id="frmRegistration">
        <p>
            <input class="un" type="text" name="fullname" id="fullname" placeholder="Enter Full Name" required />
        </p>
        <p>
            <input class="un" type="email" name="email" id="email" placeholder="Enter Email" required />
        </p>
        <p>
            <input class="pass" type="password" name="password" id="password" placeholder="Enter Password" required />
        </p>
        <p>
            <input class="pass" type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required />
        </p>
        <input type="hidden" name="honeypot" />
        <input class="submit" type="submit" name="submit" value="Register" />
    </form>
    <p class="forgot" align="center"><a href="login.php">Already have an account?</p>
    <?php if (!empty($arr_message)) { ?>
        <div class="errorMsg">
            <strong><?php echo $arr_message['message']; ?></strong>
        </div>
    <?php } ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
jQuery(function($) {
    $('#frmRegistration').validate({
        rules: {
            "confirm-password": {
                equalTo: '#password'
            }
        }
    });
});
</script>