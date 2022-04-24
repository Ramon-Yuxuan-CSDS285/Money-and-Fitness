<?php 

include 'config.php';

$sql = "SELECT * FROM food";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

?>

<li>
    <span class="text"><?php echo "" .$row['servings']. " " .$row['foodName']. "" ; ?></span>
    <span class="text"><?php echo "calorie: " .$row['calorie']. ""; ?></span>
    <span class="text"><?php echo "protein: " .$row['protein']. "g"; ?></span>
    <span class="text"><?php echo "carbohydrate: " .$row['carb']. "g"; ?></span>
    <span class="text"><?php echo "fat: " .$row['fat']. "g"; ?></span>
    <span class="text"><?php echo "saturated fat: " .$row['saturated_fat']. "g"; ?></span>
    <br>
    <i id="removeBtn" class="icon fa fa-trash" data-id="<?php echo $row['id']; ?>"></i>
</li>

<?php
    }
    echo '<div class="pending-text">You have ' . mysqli_num_rows($result) . ' food items added.</div>';
} else {
    echo "<li><span class='text'>No food added.</span></li>";
}

?>