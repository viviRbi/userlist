
<?php 
    session_start();
    require_once "define.php";
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
    $name = '';
    $status = '';
    $ordering = '';

    $insertInfo = array();
    $message ='';

    if(isset($_POST['name'])){
        foreach($_POST as $key=>$value){
            $_SESSION['user'][$key] = $value;
            $value = mysqli_real_escape_string($database->getConnect(),$value);
            $$key = $value;
            $insertInfo["$key"]=$value;
  
        }
        
        $database->insert($insertInfo);
        header("Location: $FRONTEND"."/index.php");
    }

    if(isset($_SESSION['user'])){
        foreach($_SESSION['user'] as $key=>$value){
            $$key = $value;
        }
    }
?>

    <h2>Add Page</h2>
    <form action="#" method="post" name="add-form">

        <label>Name</label></br>
        <input type="text" name="name" value=<?php echo $name?>> </br></br>

        <label>Status</label></br>
        <select name="status">
            <option value='0' <?php echo $status == 0? "selected='selected'": ""?>>Active</option>
            <option value='1' <?php echo $status == 1? "selected='selected'": ""?>>Inactive</option>
        </select></br></br>

        <label>Ordering</label></br>
        <input type="number" name="ordering" value = <?php echo $ordering?>></br></br>

        <input type="submit" value = "Submit">
    </form>
  
    <a href="<?php echo $FRONTEND?>">Back </a>
    <?php echo $message ?>

</body>

</html>