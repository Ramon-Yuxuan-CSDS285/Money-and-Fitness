<?php

include 'config.php';
session_start();
$email = $_SESSION['user']['fullname'];


$task = $_POST['task'];
$num = $_POST['num'];

$sql = "INSERT INTO tasks (title, num, email) VALUES ('$task','$num', '$email')";
$result = mysqli_query($conn, $sql);

if($result) {
    echo 1;
}
else {
    echo 0;
}
?>