<?php

include 'config.php';

$sql = "SELECT * FROM tasks";
$result = mysqli_query($conn, $sql);
$budgetTotal = 0;

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)){
        $budgetTotal += $row['num'];
?>

<li>
    <span class="text"><?php echo $row['title']; ?> $<?php echo $row['num']; ?></span>
    <i id="removeBtn" class="icon fa fa-trash" data-id="<?php echo $row['id']; ?>"></i>
    <i id="editBtn" class="icon fa fa-pencil" data-toggle="modal" data-target="#myModal" data-role="update" data-id="<?php echo $row['id']; ?>"></i>
</li>

<?php
    }
    echo '<div class="pending-text">Your budget total is $' . $budgetTotal . '</div>';
}
else {
    echo"<li><span class='text'>Budget not made.</span></li>";
}
?>