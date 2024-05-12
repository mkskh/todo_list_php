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
            <form action="app/add.php" method="POST" autocomplete="off">
                <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                    <input type="text" name="title" placeholder="Write your task"
                            style="border-color:red">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php }else { ?>
                    <input type="text" name="title" placeholder="Write your task">
                    <button type="submit">Add &nbsp; <span>&#43;</span></button>
                <?php }?>
            </form>
        </div>

        <?php
            $todos = $conn->query("SELECT * FROM todo_list ORDER BY id DESC")
        ?>

        <?php foreach ($todos as $todo) { ?>

            <div class="container" style="margin-top: 20px">
                <div class="todo-item" style="text-align: left; margin-left: 15px;">
                    <span id="<?php echo['id']; ?>" class="remove-to-do">x </span>
                    
                    <?php if($todo['checked']){ ?>
                        
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
            </div>
        <?php }?>
    </div>
</body>
</html>