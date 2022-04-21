<?php 

include 'config.php';

if (isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['name'])){
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $name = $_POST['name'];
    if ($name != "" && $height != 0 && $weight != 0){
        $executeFirst = "DELETE FROM metric";
        mysqli_query($conn, $executeFirst);
        $sql = "INSERT INTO metric (name, weight,height) VALUES ('$name', '$weight','$height')";
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