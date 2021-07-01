 <?php include("data.php"); ?>
 <?php include("header.php"); ?>


    <div class="container">

    <form action="index.php" method="post">
        
        <label for="selecter_id">Elegí una receta: </label>
        <select name="selected_id" id="selected_id">
            <option value=""></option>
            <?php foreach($recipes as $recipe):?>
            <option value="<?php echo $recipe['recipe_id']?>"><?php echo ucfirst($recipe['recipe_name'])?></option>
            <?php endforeach;?>
        </select>
        
        <input type="submit" value="BUSCAR">
    
    </form>

    
    <?php 

        if(isset($_POST['selected_id'])){
            
            $id = $_POST['selected_id'];
            
            if(empty($id)){
                echo "Selecciona una receta";
                exit();
            }else{
                foreach($recipes as $recipe){
                    if($recipe['recipe_id'] == $id){
                        $selected_recipe = $recipe;
                    }
                }
                if(empty($selected_recipe)){
                    echo "No encontramos la receta que buscabas"; 
                    exit();
                }
            }
    
            ?> <h1>Receta: <?php echo(ucfirst($selected_recipe['recipe_name'])); ?></h1> <?php 
            
            
            ?> <h2 class="list_heading">Ingredientes</h2> <?php
            echo "<div class='list_display'>";
            echo "<ul>";
            foreach($ingredients as $ingredient){
                if($ingredient['recipe_id'] == $id){
                    ?> 
                    <li><?php echo $ingredient['ingredient_quantity'] . " " . $ingredient['measurement_name'] . " " . $ingredient['ingredient_name']?></li>
                    <?php
                }
            }
            echo "</ul>";
            echo "</div>";
            

            ?> <h2 class="list_heading">Procedimiento</h2> <?php
            echo "<div class='list_display'>";
            echo "<ol>";
            foreach($steps as $step){
                if($step['recipe_id'] == $id){
                    ?>
                    <li><?php echo $step['step_description']?></li>
                    <?php
                }
            }
            echo "</ol>";
            echo "</div>";
        }

    ?>
        </div>
    </body>
</html>
