<?php 

include 'config.php';

$sql = "SELECT * FROM food";
$result = mysqli_query($conn, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $sum = $sum + $row['calorie'];
    }
}

echo '<div class="total">You have ' . $sum . ' calories in total right now.</div>';
?>