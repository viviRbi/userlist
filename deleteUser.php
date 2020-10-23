<?php 
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
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        $id = mysqli_real_escape_string($database->getConnect(),$id); 
        if($id){
            $database->delete($id);
            header("Location: $FRONTEND/index.php");
        }
    }else{
        echo "Unsuccessful. Please go back to <a href='$FRONTEND'>Home page</a>";
    }
?>
</body>
</html>