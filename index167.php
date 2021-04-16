


<!DOCTYPE html>
<html>

<head>
    <title>Project tracker</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <a href="createrecord.php">Create task</a>
    
<?php
include_once 'config/config.php'; 
//Step2
$todo_query = "SELECT * FROM task where task_status='TO DO' order by created_at ASC";
$inprogress_query = "SELECT * FROM task where task_status='IN-PROGRESS'  order by created_at ASC";
$review_query = "SELECT * FROM task where task_status='REVIEW'  order by created_at ASC";
$complete_query = "SELECT * FROM task where task_status='COMPLETE'  order by created_at ASC";

$todo_count_query = "SELECT count(*) as todo_count FROM task where task_status='TO DO'";
$inprogress_count_query = "SELECT count(*) as inprogress_count FROM task where task_status='IN-PROGRESS'";
$review_count_query = "SELECT count(*) as review_count FROM task where task_status='REVIEW'";
$complete_count_query = "SELECT count(*) as complete_count FROM task where task_status='COMPLETE'";


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

    
</head>

<body>
    <div class="container-fluid pt-3">
        <h3 class="font-weight-light text-white">Kanban Board</h3>
        <div class="small  text-light">Drag and drop between various status</div>
        <div class="row flex-row flex-sm-nowrap py-3">
            <div class="col-sm-6 col-md-4 col-xl-3 hello">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">To Do - [ <?php echo mysqli_fetch_array($todo_count_result)['todo_count'] ?> ] </h6>
                         
                        
                        <div class="items border border-light">
                        <?php
                            while ($todo_row = mysqli_fetch_array($todo_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title ">
                                        <!-- <img src="//placehold.it/30" class="rounded-circle float-right"> -->
                                        <p>TASK-<?php echo $todo_row['task_id']?></p>
                                    </div>
                                    <p><?php echo $todo_row['task_name'] ?> </p>
                                    <!-- // <button class="btn btn-primary btn-sm">View</button> -->
                                </div>
                            </div>

                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                           
                            <?php endwhile; ?>
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">In-progess - [ <?php echo mysqli_fetch_array($inprogress_count_result)['inprogress_count'] ?> ]</h6>
                        <div class="items border border-light">
                        <?php
                            while ($inprogress_row = mysqli_fetch_array($inprogress_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                        <!-- <img src="//placehold.it/30" class="rounded-circle float-right"> -->
                                        <p>TASK-<?php echo $inprogress_row['task_id']?>
                                    </div>
                                    <p>
                                    <?php echo $inprogress_row['task_name'] ?> </p>
                                    
                                    <!-- <button class="btn btn-primary btn-sm">View</button> -->
                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title text-uppercase text-truncate py-2">Review - [ <?php echo mysqli_fetch_array($review_count_result)['review_count'] ?> ]</h6>
                        <div class="items border border-light">
                        <?php
                            while ($review_row = mysqli_fetch_array($review_result)): 

                            ?>
                            <div class="card draggable shadow-sm" id="cd9" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                        <!-- <img src="//placehold.it/30" class="rounded-circle float-right"> -->
                                        <p>TASK-<?php echo $review_row['task_id']?>
                                    </div>
                                    <p>
                                    <?php echo $review_row['task_name'] ?> </p>
                                    <!-- </p> -->
                                    <!-- <button class="btn btn-primary btn-sm">View</button> -->
                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 hello">
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
                                        <!-- <img src="//placehold.it/30" class="rounded-circle float-right"> -->
                                        <p>TASK-<?php echo $complete_row['task_id']?>
                                    </div>
                                    <p>
                                    <?php echo $complete_row['task_name'] ?> </p>

                                    <!-- <button class="btn btn-primary btn-sm">View</button> -->
                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>
                            <!-- <div class="card draggable shadow-sm" id="cd12" draggable="true" ondragstart="drag(event)">
                                <div class="card-body p-2">
                                    <div class="card-title">
                                        <img src="//placehold.it/30" class="rounded-circle float-right">
                                        <a href="" class="lead font-weight-light">TSK-146</a>
                                    </div>
                                    <p>
                                        This is a description of a task item.
                                    </p>
                                    <button class="btn btn-primary btn-sm">View</button>
                                </div>
                            </div>
                            <div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div> -->
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