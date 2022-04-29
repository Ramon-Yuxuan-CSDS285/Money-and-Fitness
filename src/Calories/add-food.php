<?php 

include 'config.php';
session_start();

if (isset($_POST['food']) && isset($_POST['servings'])){
    $food = $_POST['food'];
    $servings = $_POST['servings'];
    $price = $_POST['price'];

    //fetches data of names of possible foods
    $api_url = "https://api.spoonacular.com/food/ingredients/search?apiKey=ceabb584829847a0820cb61a92afdf62&query=" .$food. "&number=1&sortDirection=desc";
    $food_data = json_decode( file_get_contents($api_url),true);
    //if its not in ingredients just menu list
    if($food_data['results'] == null){
        $api_url = "https://api.spoonacular.com/food/menuItems/search?apiKey=ceabb584829847a0820cb61a92afdf62&query=" .$food. "&number=1&sortDirection=desc";
        $food_data = json_decode( file_get_contents($api_url),true);
        $food_name = $food_data['menuItems'][0]['title'];

        //fetcches data of the autocompleted menu item
        $food_id = $food_data['menuItems'][0]['id'];
        $api_url_ingredient = "https://api.spoonacular.com/food/menuItems/".$food_id."?apiKey=ceabb584829847a0820cb61a92afdf62";
        $ingredient_data = json_decode( file_get_contents($api_url_ingredient),true);
        $length = count($ingredient_data['nutrition']['nutrients']);
        $food_price = $ingredient_data['price'];

        //loops and stores macro nutrients of inputted food
        for($x = 0; $x < $length; $x++){
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Calories"){
                $food_calorie = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Protein"){
                $food_protein = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Carbohydrates"){
                $food_carb = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Fat"){
                $food_fat = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Saturated Fat"){
                $food_sat = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
        }

    }
    //sets food name from the ingredients list
    else{
        $food_name = $food_data['results'][0]['name'];

        //fetches data of the autocompleted food
        $food_id = $food_data['results'][0]['id'];
        $api_url_ingredient = "https://api.spoonacular.com/food/ingredients/".$food_id."/information?apiKey=ceabb584829847a0820cb61a92afdf62&amount=" .$servings. "";
        $ingredient_data = json_decode( file_get_contents($api_url_ingredient),true);
        $length = count($ingredient_data['nutrition']['nutrients']);
        $food_price = $ingredient_data['estimatedCost']['value'];

        //loops and stores macro nutrients of inputted food
        for($x = 0; $x < $length; $x++){
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Calories"){
                $food_calorie = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Protein"){
                $food_protein = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Carbohydrates"){
                $food_carb = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Fat"){
                $food_fat = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
            if($ingredient_data['nutrition']['nutrients'][$x]['name'] == "Saturated Fat"){
                $food_sat = $ingredient_data['nutrition']['nutrients'][$x]['amount'];
            }
        }
    }
    


    

    if ($food_name != "" && $food_calorie != 0){
        $email = $_SESSION['user']['fullname'];
        $sql = "INSERT INTO food (foodName,calorie,protein,carb,fat,saturated_fat,servings, email) VALUES ('$food_name','$food_calorie','$food_protein','$food_carb','$food_fat','$food_sat','$servings','$email')";
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
    $sql = "INSERT INTO tasks (title,num, email) VALUES ('$food_name','$price','$email')";
    $result = mysqli_query($conn, $sql);
}else {
    echo 0;
}

?>