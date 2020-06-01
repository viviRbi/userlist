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
        $id = mysqli_real_escape_string($database->getConnect(),$id); 
        if($id){
            $database->delete($id);
            header("Location: http://localhost/php_exe/php_ex_12/index.php");
        }
    }else{
        echo "Unsuccessful. Please go back to <a href='http://localhost/php_exe/php_ex_12/index.php'>Home page</a>";
    }
?>
</body>
</html>