<?php 

include 'config.php';
$sql = "SELECT * FROM metric";
$result = mysqli_query($conn, $sql);
$sum = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $n = $row['name'];
        $w = $row['weight'];
        $h = $row['height'];
    }
}

echo '<div class="total">Hi, ' . $n . ', your height is ' . $h . ' cm and your weight is ' . $w . ' lbs.</div>';
?>