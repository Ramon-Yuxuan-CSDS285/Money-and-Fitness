<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="index.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	

	<title>Todo List App - Pure Coding</title>
</head>
<body>
	<div class="wrapper">
		<a href="../Budget/budget.html">Budget</a>
		<p>
			<a href="../logout.php">Log Out</a>
		</p>
		<br>
		<h2 class="title">Calculate Daily Calorie Intake</h2>
		<br>
		<div class="inputFields">
			<form>
				<input type="text" id="name" placeholder="Enter your name">
				<input type="number" id="height" placeholder="Enter your height (cm)">
				<input type="number" id="weight" placeholder="Enter your weight (lbs)">
				<input type="number" id="age" placeholder="Enter your age">
				<select name="gender" id="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>
				<br>
				<button type="submit" id="addBtn" class="btn">Submit</button>
				<!-- <button type="submit" id="get" class = "btn" style="float:right; margin-left: 10%;">get weight and height</button> -->
			</form>
		</div>
		<br>
		<div id="metric">

		</div>
		<br>
		<br>
		<div class="inputFields">
			<form class="foodList">
				<input type="text" id="typeOfFood" placeholder="Enter Name of Food">
				<input type="number" id="servings" placeholder="Enter the amount of servings">
				<input type="number" id="price" placeholder="Enter the cost">
				<br>
				<button type="submit" id="submitFoodList" class="btn">Submit</button>
			</form>
		</div>
		<div class="content">
			<!-- <span class="text">food</span>
			<span class="text">calorie</span> -->
			<ul id="tasks">
			
			</ul>
			<div id="calorieSum">

			</div>
			<div id="erase">
				<button type="reset" id="resetFoodList" class="btn">Clear List</button>
			</div>
		</div>
	</div>
	

	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script>
		$(document).ready(function() {


			// Show Tasks
			function loadTasks() {
				$.ajax({
					url: "show-food.php",
					type: "POST",
					success: function(data) {
						$("#tasks").html(data);
					}
				});
			}

			//show total calories
			function loadTotalCalories() {
				$.ajax({
					url: "show-sum.php",
					type: "POST",
					success: function(data) {
						$("#calorieSum").html(data);
					}
				});
			}


			// Add Task
			$("#submitFoodList").on("click", function(e) {
				e.preventDefault();

				var servings = $("#servings").val();
				var typeOfFood = $("#typeOfFood").val();
				var price = $("#price").val();
				

				$.ajax({
					url: "add-food.php",
					type: "POST",
					data: {food : typeOfFood, servings: servings, price: price},
					success: function(data) {
						loadEverything();
						$("#servings").val('');
						$("#typeOfFood").val('');
						if (data == 0) {
							alert("Something wrong went. Please try again.");
						}
					}
				});
			});

			// Add Task
			$("#resetFoodList").on("click", function(e) {
				e.preventDefault();

				$.ajax({
					url: "reset-food.php",
					type: "POST",
					data: {},
					success: function(data) {
						loadEverything();
					}
				});
			});

			function loadEverything() {
				loadTasks();
				loadTotalCalories();
				loadMetrics();
			}

			loadEverything();

			//show weight and height
			function loadMetrics() {
				$.ajax({
					url: "show-metric.php",
					type: "POST",
					success: function(data) {
						$("#metric").html(data);
					}
				});
			}

			//add weight and height
			$("#addBtn").on("click", function(e) {
				e.preventDefault();

				var weight = $("#weight").val();
				var height = $("#height").val();
				var name = $("#name").val();
				var gender = $('#gender').val();
				var age = $("#age").val();

				$.ajax({
					url: "add-metric.php",
					type: "POST",
					data: {weight : weight, height: height, name: name, gender: gender, age: age},
					success: function(data) {
						loadEverything();
						$("#weight").val('');
						$("#height").val('');
						$("#name").val('');
						$("#gender").val('');
						$("#age").val('');
						if (data == 0) {
							alert("Something wrong went. Please try again.");
						}
					}
				});
			});
			
			// Remove Task
			$(document).on("click", "#removeBtn", function(e) {
				e.preventDefault();
				var id = $(this).data('id');
				
				$.ajax({
					url: "remove-food.php",
					type: "POST",
					data: {id: id},
					success: function(data) {
						loadEverything();
						if (data == 0) {
							alert("Something wrong went. Please try again.");
						}
					}
				});
			});
		});
	</script>
</body>
</html>