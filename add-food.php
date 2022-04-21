<?php 

include 'config.php';

if (isset($_POST['food']) && isset($_POST['calorie'])){
    $food = $_POST['food'];
    $calorie = $_POST['calorie'];
    if ($food != "" && $calorie != 0){
        $sql = "INSERT INTO food (foodName,calorie) VALUES ('$food','$calorie')";
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
}else {
    echo 0;
}

?>