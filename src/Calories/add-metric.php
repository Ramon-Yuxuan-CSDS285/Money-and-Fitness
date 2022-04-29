<?php 

include 'config.php';
session_start();

if (isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['name']) && isset($_POST['gender']) && isset($_POST['age'])){
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    if ($name != "" && $height != 0 && $weight != 0){
        $executeFirst = "DELETE FROM metric IF (email = '$email')";
        mysqli_query($conn, $executeFirst);
        $email = $_SESSION['user']['fullname'];
        $sql = "INSERT INTO metric (name, weight,height, gender, age, email) VALUES ('$name', '$weight','$height', '$gender', '$age', '$email')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
    else {
        echo 0;
    }
}
else {
    echo 0;
}
?>