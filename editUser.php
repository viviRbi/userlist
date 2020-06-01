
<?php 
    require_once "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
</head>

<body>
<?php 
    if(isset($_GET['id'])){
        $id= $_GET['id'];
    }else{
        header("Location: http://localhost/php_exe/php_ex_12/index.php");
    }

    $info = $database->listRecord("SELECT * FROM `$params[table]` WHERE `id` = $id"); 

    $name = $info[0]['name'];
    $status = $info[0]['status'];
    $ordering = $info[0]['ordering'];

    function selectedStatOption($num){
        global $status;
        // echo "stat" . $status;
        echo $status == "$num"? "select=selected": "";
    }

    $message = '';
    if(isset($_POST['ordering'])){
        $name = mysqli_real_escape_string($database->getConnect(),$_POST['name']);
        $status =  mysqli_real_escape_string($database->getConnect(),$_POST['status']);
        $ordering =  mysqli_real_escape_string($database->getConnect(),$_POST['ordering']);

        $updateData = $_POST;
        if($name){
            $database->update($updateData,$id);
            header("Location: http://localhost/php_exe/php_ex_12/index.php");
        }
        
        header("Location: http://localhost/php_exe/php_ex_12/index.php");
    }
?>

    <h2>Edit Page</h2>
    <form action="#" method="post" name="edit-form">
        <label>Id</label></br>
        <input value = <?php echo $id; ?> readonly></br></br>

        <label>Name</label></br>
        <!-- value bi mat chu sau khoang trang -->
        <input type="text" name="name" <?php echo "value ='$name'"; ?> ><?php echo $name; ?> </br></br>

        <label>Status</label></br>
        <select name="status">
            <option value='0' <?php echo selectedStatOption(0) ?>>Active</option>
            <option value='1' <?php echo selectedStatOption(1) ?>>Inactive</option>
        </select></br></br><?php echo $status; ?> 

        <label>Ordering</label></br>
        <input type="number" name="ordering" value = <?php echo $ordering ; ?> ></br></br>

        <input type="submit" value = "Submit">
    </form>
    <?php echo $_POST>0? "Edit success": ""; echo "</br>"?>
    <a href="http://localhost/php_exe/php_ex_12/index.php">Back</a>

</body>

</html>