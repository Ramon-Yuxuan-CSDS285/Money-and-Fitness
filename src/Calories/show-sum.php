<?php 

include 'config.php';
session_start();

$email = $_SESSION['user']['fullname'];
$sql = "SELECT * FROM food WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$sum = 0;
$carb = 0;
$protein = 0;
$fat = 0;
$saturated_fat = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sum = $sum + $row['calorie'];
        $carb = $carb + $row['carb'];
        $protein = $protein + $row['protein'];
        $fat = $fat + $row['fat'];
        $saturated_fat = $saturated_fat + $row['saturated_fat'];

    }
}

echo '<div class="total">You have ' . $sum . ' calories in total right now. <br/>
                         Protein: ' .$protein. 'g<br/>
                         Carbohydrate: ' .$carb. 'g<br/>
                         Fat: ' .$fat. 'g<br/>
                         Saturated Fat: ' .$saturated_fat. 'g
      </div>';
?>