<?php

include 'config.php';

$task = $_POST['task'];
$num = $_POST['num'];

$sql = "INSERT INTO tasks (title, num) VALUES ('$task','$num')";
$result = mysqli_query($conn, $sql);

if($result) {
    echo 1;
}
else {
    echo 0;
}
?>