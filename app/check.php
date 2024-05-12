<?php

if(isset($_POST['id'])){
    require '../db_conn.php';

    $id = $_POST['id'];

    if(empty($id)){
        echo 'error';
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todo_list WHERE id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['id'];
        $checked = $todo['checked'];

        if ($checked) {
            $uChecked = 0;
        } else {
            $uChecked = 1;
        }

        $res = $conn->query("UPDATE todo_list SET checked=$uChecked WHERE id=$uId");

        if($res){
            header("Location: ../index.php?mess=success");
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}