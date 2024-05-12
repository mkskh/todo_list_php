<?php
require 'db_conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="text-align:center;">
        
        <h1>My Todo List</h1>

        <div class="add-section">

            <!-- ADD a new task to the ToDo List -->
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <!-- If the field is empty after clicking Add - make border red -->
                    <input type="text" name="title" placeholder="Write your task"
                            style="border-color:red">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php }else { ?>
                    <!-- If the field is not empty!-->
                    <input type="text" name="title" placeholder="Write your task">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php }?>
            </form>

        </div>

        <!-- GRAB all tasks from db and place everyone on the page -->
        <?php
            $todos = $conn->query("SELECT * FROM todo_list ORDER BY id DESC")
        ?>

        <?php foreach ($todos as $todo) { ?>

            <div class="container" style="margin-top: 20px">
                <div class="todo-item" style="text-align: left; margin-left: 15px; display: flex; justify-content: space-between;">

                    <div style="display: inline-block;">
                        <?php if($todo['checked']){ ?>
                            
                            <!-- if the task is completed - strikethrough the text -->
                            <h4 style="margin-left: 0; text-decoration: line-through;"> 
                                <input type="checkbox" style="margin-top: 10px" checked> <?php echo $todo['title'] ?>
                            </h4>
                            <small><?php echo "Created:", " ", $todo['date_time'] ?></small>
                            
                        <?php }else { ?>

                            <h4 style="margin-left: 0"> 
                                <input type="checkbox" style="margin-top: 10px"> <?php echo $todo['title'] ?>
                            </h4>
                            <small><?php echo "Created:", " ", $todo['date_time'] ?></small>
                            
                        <?php }?>
                    </div>

                    <div style="display: inline-block; text-align:right; margin-top: 10px;">
                        <form action="app/remove.php" method="post" >
                            <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                            <button type="submit">x</button>
                        </form>
                    </div>

                </div>
            </div>
        <?php }?>
    </div>

</body>
</html>