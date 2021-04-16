<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
        .html,.body {
    border:black;
    height: 40%;
    
}.button2 {background-color: black;}

html {
    display: table;
    margin: auto;
}

body {
    display: table-cell;
    vertical-align: middle;
}
    .cont{
    border:1px solid black;
    box-shadow: 0px 1px 2px 1px;
    margin-top:20px;
    width:80vw;
    margin:auto;
    margin-top:20px;
        background:white;
        text-align:center;
    }
    body{
        background:#b3b3b3;
    }
    </style>
</head>
<body>
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
<?php
include_once 'config/config.php';
if(isset($_POST['submit']))
{    
     //$task_id = $_POST['task_id'];
     
     $task_name = $_POST['task_name'];
     $task_status=$_POST['task_status'];
     if($user_level):
        $task_assignee = $_POST['task_assignee'];
     $insert= mysqli_query($mysql_db,"INSERT INTO `task` (`task_name`,`task_assignee`,`created_at`,`task_status`)
     VALUES ('$task_name','$task_assignee',now(),'$task_status')");
     else :
        $insert= mysqli_query($mysql_db,"INSERT INTO `task` (`task_name`,`created_at`,`task_status`)
     VALUES ('$task_name',now(),'$task_status')");
      endif; 
     if(!$insert)
    {
        echo "<h2><strong><U>FILL ALL FIELDS CORRECTLY AND RETRY.THE DATA task IS NOT SUBMITTED!</U></h2></strong>";
    }
    else
    {   echo "<br>";
        echo "<br>";
        echo "<h3><strong><center>Tasks created successfully.</center></strong></h3>";
    }
     mysqli_close($mysql_db);
}
?>
<body> <div class="cont"><br><br>
<h5>Have another Task? <br><br><a href="createrecord.php"><br><button class="btn btn-primary"  id="button1">ADD NEXT task</button></a></h5>
<br><br>
<h5>Filled all entries?<a href="index.php"><br><br>
<button class="btn btn-success" id="button2">GO TO SCRUM BOARD</button></a></h5><br><br>


</html>