<?php

    // Connect to database
    $conn = mysqli_connect('localhost', 'matias', '13junio02', 'recipesv2');

    // check connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }

        
    // RECIPES
    $recipes = array();
    $sql = "SELECT recipe_id, recipe_name, recipe_description FROM recipes";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        array_push($recipes, $row);
    }
    mysqli_free_result($result);


    // INGREDIENTS
    $ingredients = array();
    $sql = "SELECT q.quantity_id, ingredient_name, measurement_name, ingredient_quantity, recipe_id FROM ingredients AS i INNER JOIN quantity AS q ON i.ingredient_id = q.ingredient_id INNER JOIN measurements AS m ON q.measurement_id = m.measurement_id";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        array_push($ingredients, $row);
    }
    mysqli_free_result($result);


    // STEPS
    $steps = array();
    $sql = "SELECT recipe_id, step_number, step_description FROM recipe_steps ORDER BY step_number";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        array_push($steps, $row);
    }
    mysqli_free_result($result);
?>