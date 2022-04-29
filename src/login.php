<?php
session_start();
 
if (isset($_SESSION['user'])) {
    header('Location: myaccount.php');
}
 
require_once 'class-db.php';
 
$error_message = '';
if (isset($_POST['submit'])) {
    $db = new DB();
    $response = $db->check_credentials($_POST['email'], $_POST['password']);
 
    if ($response['status'] == 'success') {
        $_SESSION['user'] = array('id' => $response['id'], 'fullname' => $response['fullname']);
        header('Location: Calories/index.php');
    }
 
    $error_message = ($response['status'] == 'error') ? $response['message'] : '';
}
?>
 

<head>
  <link rel="stylesheet" href="form.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign in</title>
</head>
<div class = "main">
    <p class="sign" align="center">Login</p>
    <form class="form1" method="post">
        <p>
            <input class="un" type="email" name="email" id="email" placeholder="Enter Email" required />
        </p>
        <p>
            <input class="pass" type="password" name="password" id="password" placeholder="Enter Password" required />
        </p>
        <input class="submit" type="submit" name="submit" value="Login" />
    </form>
    <p class="forgot" align="center"><a href="registration.php">Don't have an account?</p>
    <div class = "error">
        <?php if (!empty($error_message)) { ?>
            <div class="errorMsg">
                <strong><?php echo $error_message; ?></strong>
            </div>
        <?php } ?>
    </div>
</div>
</main>