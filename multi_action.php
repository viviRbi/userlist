<?php 
    require_once "connect.php";
    require_once "status_helper.php";
    print_r($_POST);

    if(isset($_POST)){
        $action = $_POST['bullaction'];
        if($action == 'multi-delete'){
            $database->delete($_POST['check']);
        }else{
            $updateTo= statusCheck($action);
            $updateToArr= array('status'=>$action);
            foreach($_POST['check'] as $value){
                $database->update($updateToArr,$value);
            }
        }
        header("Location: http://localhost/php_exe/php_ex_12/index.php");
    }
  
?>