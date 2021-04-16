<?php
session_start();
$loggedin_user=$_SESSION['username'];
echo "Hi $loggedin_user";
?>
<?php
include_once 'config/config.php'; 
//Step2
$user_level_query = "SELECT * FROM users where username = '$loggedin_user'";


mysqli_query($mysql_db, $user_level_query) or die('Error querying database.');


//Step3
$user_level_query_result = mysqli_query($mysql_db, $user_level_query);
$user_level= mysqli_fetch_array($user_level_query_result)['level'];

echo $user_level;



//Step 4
//mysqli_close($mysql_db);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Project tracker</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lumen/bootstrap.min.css" integrity="sha384-GzaBcW6yPIfhF+6VpKMjxbTx6tvR/yRd/yJub90CqoIn2Tz4rRXlSpTFYMKHCifX" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <table width=100% height="60" cellspacing="5" cellpadding="5" bgcolor="#000000">
            <tr>
            	<td align="center"><font face="Verdana" color="White"><h3>SCRUM BOARD</h3></font></td>
        </table>
    </div>
</nav>    
<?php
include_once 'config/config.php'; 
//Step2
$todo_query = "SELECT * FROM task where task_status='TO DO' AND task_assignee='$loggedin_user' order by created_at ASC";
$inprogress_query = "SELECT * FROM task where task_status='IN-PROGRESS'  AND task_assignee='$loggedin_user' order by created_at ASC";
$review_query = "SELECT * FROM task where task_status='REVIEW' AND task_assignee='$loggedin_user' order by created_at ASC";
$complete_query = "SELECT * FROM task where task_status='COMPLETE' AND task_assignee='$loggedin_user' order by created_at ASC";

$todo_count_query = "SELECT count(*) as todo_count FROM task where task_status='TO DO' AND task_assignee='$loggedin_user'";
$inprogress_count_query = "SELECT count(*) as inprogress_count FROM task where task_status='IN-PROGRESS' AND task_assignee='$loggedin_user'";
$review_count_query = "SELECT count(*) as review_count FROM task where task_status='REVIEW' AND task_assignee='$loggedin_user'";
$complete_count_query = "SELECT count(*) as complete_count FROM task where task_status='COMPLETE' AND task_assignee='$loggedin_user'";


mysqli_query($mysql_db, $todo_query) or die('Error querying database.');
mysqli_query($mysql_db, $inprogress_query) or die('Error querying database.');
mysqli_query($mysql_db, $review_query) or die('Error querying database.');
mysqli_query($mysql_db, $complete_query) or die('Error querying database.');

mysqli_query($mysql_db, $todo_count_query) or die('Error querying database.');
mysqli_query($mysql_db, $inprogress_count_query) or die('Error querying database.');
mysqli_query($mysql_db, $review_count_query) or die('Error querying database.');
mysqli_query($mysql_db, $complete_count_query) or die('Error querying database.');

//Step3
$todo_result = mysqli_query($mysql_db, $todo_query);
$inprogress_result = mysqli_query($mysql_db, $inprogress_query);
$review_result = mysqli_query($mysql_db, $review_query);
$complete_result = mysqli_query($mysql_db, $complete_query);

$todo_count_result = mysqli_query($mysql_db, $todo_count_query);
$inprogress_count_result = mysqli_query($mysql_db, $inprogress_count_query);
$review_count_result = mysqli_query($mysql_db, $review_count_query);
$complete_count_result = mysqli_query($mysql_db, $complete_count_query);


//Step 4
//mysqli_close($mysql_db);
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lumen/bootstrap.min.css" integrity="sha384-GzaBcW6yPIfhF+6VpKMjxbTx6tvR/yRd/yJub90CqoIn2Tz4rRXlSpTFYMKHCifX" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap-flex.min.csss">
<style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            text-align:center;
        }
        body{
  background:#FFFFFF;
}
        .cont{
    border:1px solid black;
    box-shadow: 0px 1px 2px 1px;
    margin-top:20px;
    width:80vw;
    background:white;
     }
       
    </style>
    
    
</head>

<body>
<div class="container-fluid pt-3"><a href="index.php"><br>View all tasks</button></a>
    <a href="createtask.php">
<button class="btn btn-success" id="button2" style="float: right;">CREATE TASKS</button></a>
<div class="container-fluid pt-3"><br><br>
        
        <!-- <div section="wrapper cont">DRAG AND DROP BETWEEN VARIOUS STATES AND UPDATE STATUS</div> -->
        <div class="row flex-row flex-sm-nowrap py-3" >
            <div class="col-sm-6 col-md-4 col-xl-3 hello ">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">To Do - [ <?php echo mysqli_fetch_array($todo_count_result)['todo_count'] ?> ] </h6>
                         
                        
                        <div class="items border border-light">
                        <?php
                            while ($todo_row = mysqli_fetch_array($todo_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="drag-<?php echo $todo_row['task_id']?>"  draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title ">
                                      
                                        <i><p>TASK ID - <?php echo $todo_row['task_id']?></p></i><hr>
                                    </div>
                                    <p>TASK NAME -<?php echo $todo_row['task_name'] ?> </p><hr>
                                    <p>TASK ASSIGNEE -<?php echo $todo_row['task_assignee'] ?> </p>
                              
                                </div>
                            </div>

                            <div class="dropzone rounded" id="drop-<?php echo $todo_row['task_id']?>"  ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                           
                            <?php endwhile; ?>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello bg-warning">
                <div class="card bg-light ">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">In-progress - [ <?php echo mysqli_fetch_array($inprogress_count_result)['inprogress_count'] ?> ]</h6>
                        <div class="items border border-light success">
                        <?php
                            while ($inprogress_row = mysqli_fetch_array($inprogress_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                       
                                        <p>TASK ID - <?php echo $inprogress_row['task_id']?><hr>
                                    </div>
                                    <p>TASK NAME -
                                    <?php echo $inprogress_row['task_name'] ?> </p><hr>
                                    <p>TASK ASSIGNEE -<?php echo $inprogress_row['task_assignee'] ?> </p>
                                    
                                   
                                </div>
                            </div>
                            <div class="dropzone rounded" id="drop-<?php echo $todo_row['task_id']?>" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello ">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">BLOCKED-[ <?php echo mysqli_fetch_array($review_count_result)['review_count'] ?> ]</h6>
                        <div class="items border border-light">
                        <?php
                            while ($review_row = mysqli_fetch_array($review_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd9" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                      
                                        <p>TASK ID - <?php echo $review_row['task_id']?><hr>
                                    </div>
                                    <p> TASK NAME -
                                    <?php echo $review_row['task_name'] ?> </p><hr>
                                    <p>TASK ASSIGNEE -<?php echo $review_row['task_assignee'] ?> </p>
                                  
                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello bg-success">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">Complete - [ <?php echo mysqli_fetch_array($complete_count_result)['complete_count'] ?> ]</h6>
                        <div class="items border border-light">
                        <?php
                            while ($complete_row = mysqli_fetch_array($complete_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd11" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                       
                                        <p>TASK ID - <?php echo $complete_row['task_id']?><hr>
                                    </div>
                                    <p>TASK NAME -
                                    <?php echo $complete_row['task_name'] ?> </p><hr>
                                    <p>TASK ASSIGNEE -<?php echo $complete_row['task_assignee'] ?> </p>

                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                          
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script src="script.js"></script>

</body>

</html>