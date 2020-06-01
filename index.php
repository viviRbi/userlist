
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="style.css" rel="stylesheet" type="text/css">

</head>
<?php 
    require_once "connect.php";
    require_once "status_helper.php";
    require_once "search_helper.php";
    require_once "usersList_helper.php";
    require_once "Paginator.class.php";
    require_once "paginator_helper.php";
?>
<body>
    
    <h2>Item Management</h2>

    <!-- Search and filter -->
    <section>
        <p><strong>Search and Filter</strong></p>

        <article id="statusFilter">
            <a href="http://localhost/php_exe/php_ex_12/index.php">All(<?php echo $database->countResult(); ?>)</a>&nbsp;&nbsp;
            <?php statusFilterDisplay(); ?>
        </article>

        <br/>

        <form action="#" method="get">
            <input name="search" value = "">
            <button onclick="returnFunc()">Clear</button>
            <input type="submit" value="search"></button>
        </form>
     
    </section>

    <br/><br/>

    <!--List item -->
    <section>
        <p style="display:inline-block;"><strong>List Item</strong></p><input  type='checkbox' name='checkAll' onchange="checkAll(this)">
        &nbsp;&nbsp;<a href="http://localhost/php_exe/php_ex_12/addUser.php">Add User</a>
        <form name="bullActionForm" action="http://localhost/php_exe/php_ex_12/multi_action.php" method='post'>
            <select name="bullaction" onchange="actionOption(this)">
                <option value = "null">Choose action</option>
                <option value = 0>Active</option>
                <option value = 1>Inactive</option>
                <option value = "multi-delete">Multi-Delete</option>
            </select>
            <input type="submit" id="actionSubmit" value="Apply" disabled="disabled" onclick="haveNotCheck(this)"/>

    <!-- User info -->
    </br></br></br>
        <table>
            <tr>
            <!-- cannot create function with check & radio input "checkAll is not a function" -->
                <th><p></p></th>
                <th><button ><strong><a <?php urlQuery("id"); ?>>ID</a></strong></button></th>
                <th><button ><strong><a <?php urlQuery("name"); ?>>Member Name</strong></button></th>
                <th><button ><strong><a <?php urlQuery("status"); ?>>Member Status</a></strong></button></th>
                <th><button ><strong><a <?php urlQuery("order"); ?>>Ordering</a></strong></button></th>
                <th>Action</th>
            </tr>

            <!-- WHERE: userList_helper.php -->

            <?php 

            // status
            $type = "list";
            $totalPage = '';

            if (isset($_GET['status'])){
                $type= $_GET['status']; 

                if(!strrpos($type,'?page=') == 0){
                    $type= substr($type,0,strpos($type,'?page='));
                }
                if($type == 'active'){
                    $totalUsers= $database->countResult("`status` = 0");
                }else{ 
                    $totalUsers= $database->countResult("`status` = 1");
                }
            } else{
                $totalUsers = $database->countResult();
            }
            
            // get other Query
       
            orderList("id");
            orderList("name");
            orderList("order");
      
            if (isset($_GET['search'])){
                orderList("search");
                $type = "search";
                $totalUsers= $database->countResult("`name` LIKE '%$searchWord%'");
            }
            ?>
            <!-- <form id="form2" name='checkEachForm' action="http://localhost/php_exe/php_ex_12/multi_action.php" method='post'> -->
                <?php echo usersList($type); ?>
            </form>

        </table>
    </section>

    <br/> <br/>
    <section>
        <p><strong>Pagination</strong></p>
        <?php 
        // other values save in paginator_helper
        $paginator  = new Paginator($totalUsers ,$totalUsersPerPage, $pageDisplay ,$currentPage);
        echo $paginator->showPage(); 
        ?>

        <p>Number of element on the page: <?php echo $paginator->getter()['countElements'] ?></p>
        <p>Showing page <?php echo $paginator->getter()['currentPage'] ?> of <?php echo $paginator->getter()['pageDisplay'] ?> pages</p>
        <div>
            <strong>Total entries: <?php echo $paginator->getter()['totalUsers'] ?> </strong>&nbsp;&nbsp;
            <strong>Total page: <?php echo $paginator->getter()['totalPage'] ?></strong>
        </div>
        
    </section>

    <script>
    // if value of select action = 'null', disabled. If not, remove attr
    // Call script2 not work. Can only paste the script here
        const actionSubmitBtn = document.querySelector('#actionSubmit')

        function actionOption(self){
            if(self.value == "null"){
                actionSubmitBtn.setAttribute('disabled',true)
            } else {
                if(actionSubmitBtn.getAttribute('disabled')){
                    actionSubmitBtn.removeAttribute('disabled')
                }
            }
        }

        function haveNotCheck(self){
            const checkboxes = document.getElementsByName('check[]');
            const checked = e => e.checked == true
            if(!checkboxes.some(checked)){
                alert('Please check the checkboxes')
                self.preventDefault()
            }
        }
        // check all checkboxes and take all values

        function checkAll(self){
            const checkboxes = document.getElementsByName('check[]');
            for(let i=0; i< checkboxes.length; i++){
                checkboxes[i].checked = self.checked;
            }
        }

        function returnFunc(){
            window.location.href="http://localhost/php_exe/php_ex_12/index.php/";
        }

    </script>
    
</body>
</html>