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
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            text-align:center;
        }
        body{
  background:#ffc299;
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
    <div class="wrapper cont">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create New Task</h2>
                    </div>
                    <i><p>Permission identified as <u><?php echo $user_level?> user</p></u></i>
                    <!-- <p>Please add task details and submit to create a task.</p> -->
                    <form action="inserttask.php" method="post">
                        
                        <div class="form-group">
                            <label>Task Name</label>
                            <input type="text" name="task_name" class="form-control" />
                        </div>
                        <?php if ($user_level): ?>
                        <div class="form-group">
                            <label>Task Assignee</label>
                            <input type="text" name="task_assignee" class="form-control">
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Task Status</label>
                            <input type="text" name="task_status" class="form-control">
                        </div>
                        <div class="form-group">
                        <input type="submit" class="btn btn-primary form-control"name="submit" value="Create Task"><hr>
                        <a href="index.php">
                        <button class="btn btn-success" id="button2">GO TO SCRUMBOARD</button></a>
                            
                        </div>
                        
                        <hr>
                    </form>
                    <br/>
                </div>
            </div>        
        </div>
        
    </div>
</body>
</html>