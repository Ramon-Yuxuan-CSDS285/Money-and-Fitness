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
        $g = $row['gender'];
        $a = $row['age'];
    }
}

$wk = $w * 0.45359237;
if($g == "Male") {
    $mc = ((88.4 + 13.4 * $wk) + (4.8 * $h) - (5.68 * $a)) * 1.375;
    $mc = round($mc);
}

else{
    $mc = ((447.6 + 9.25 * $wk) + (3.1 * $h) - (4.33 * $a)) * 1.375;
    $mc = round($mc);
}

echo '<div class="total">Hi, ' . $n . ', your height is ' . $h . ' cm and your weight is ' . $w . ' lbs.</div>
        <br>
        <div class="mc">Your recommended daily calories is ' .$mc. ' calories';
?>