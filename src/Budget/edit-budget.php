<?php

include 'config.php';

$id = $_POST['id'];
$task = $_POST['item'];
$num = $_POST['value'];

$sql = "UPDATE tasks SET title='$task', num='$num'  WHERE id='$id'";
$result = mysqli_query($conn, $sql);

if(!$result) {
    echo 1;
}
else {
    echo 0;
}
?>