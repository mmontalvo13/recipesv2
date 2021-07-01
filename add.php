<?php include("header.php"); ?>

<?php 

if(isset($_POST['submit'])){
    // Connect to database
    $conn = mysqli_connect('localhost', 'matias', '13junio02', 'recipesv2');

    // check connection
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
        exit();
    }

    $ingredients = $_POST['ingredient'];
    $measurements = $_POST['measurement'];
    $quantity = $_POST['quantity'];

    foreach($ingredients as $key => $value){
        $sql = "INSERT INTO test(ingredient, measurement, quantity) 
        VALUES('". mysqli_real_escape_string($conn, $value) ."', 
        '".mysqli_real_escape_string($conn, $measurements[$key])."', 
        '".mysqli_real_escape_string($conn, $quantity[$key])."')";
    }

    if(mysqli_query($conn, $sql)){
        //success
        header('Location: index.php');
      }else{
        //error
        echo 'Query error: ' . mysqli_error($conn);
      }

    mysqli_close($conn);
}

?>




<script>
    $(document).ready(function(e){
        //Variables
        var html = '<p /> <div> <label id="counter">1</label><input type="text" name="ingredient[]" id="childingredient" placeholder="Ingredient"> <input type="text" name="measurement[]" id="childmeasurement" placeholder="Measurement"><input type="text" name="quantity[]" id="childquantity" placeholder="Quantity">  <a href="" id="remove">x</a> </div>';
        var counter = 2;

        //Add rows to the form
        $("#add").click(function(e){
            $("#container").append(html);
            $("#counter").text(counter);
            $("#counter").attr('id', 'counter'+counter)
            counter++;
            e.preventDefault();
        });
        //Remove rows to the form
        $("#container").on('click', '#remove', function(e){
            $(this).parent('div').remove();
            counter--;
            e.preventDefault();
        });   
    });
    </script>

  <form action="add.php" method="POST">
    <div class="form_header">Ingredients</div>
    <div class="container" id="container">
        <div class="firstrow">
            <a href="" id="add_fake">Add</a>
            <label id="counter1">1</label>
            <input type="text" name="ingredient[]" id="ingredient" placeholder="Ingredient"> 
            <input type="text" name="measurement[]" id="measurement" placeholder="Measurement">
            <input type="text" name="quantity[]" id="quantity" placeholder="Quantity">
            <a href="" id="add">Add</a>
        </div>
    </div>
    <input type="submit" name="submit" id="submit">
  </form>
</body>
</html>