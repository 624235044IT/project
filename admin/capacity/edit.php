<?php

session_start();
require_once "../../config/db.php";

if (isset($_POST['btn_update'])) {
   
    $question = $_POST['question'];

    $sql = $conn->prepare("UPDATE form_question SET question = :question WHERE id_queustion  = id_queustion ");
    
    $sql->bindParam(':question', $question);
    $sql->execute();
    

    if ($sql) {
        $_SESSION['success'] = "แก้ไขได้";
        header("location:form.php");
    } else {
        $_SESSION['error'] = "แก้ไขไม่ได้";
        header("location:form.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {

            line-height: 22px;
            margin: 0;

            -webkit-font-smoothing: antialiased !important;
        }

        .container {
            background-color: #FFFFFF;
            width: 980px;
            /* height: 200px; */
            position: absolute;
            top: 25%;
            left: 35%;
            margin-top: -100px;
            margin-left: -100px;

        }

        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {
            height: 1500px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #FFFFFF;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }

        .modal-content {
            margin: 20px;
            padding: 20px;
        }

        .displayed {
            display: block;
            margin-left: 28%;
        }
    </style>
</head>

<body>
    <div class="card">
        <h3>แก้ไขตัวชี้วัด</h3>
    </div><br>

    <form action="edit.php" method="post" class="form-horizontal mt-5">
        <?php
        if (isset($_GET['id_queustion '])) {
            $id_queustion  = $_GET['id_queustion '];
            $select_stmt = $conn->query("SELECT * FROM form_question WHERE id_queustion = $id_queustion");
            $select_stmt->execute();
            $data = $select_stmt->fetch();
        }
        ?>
        <div class="form-group">
            <label for="question">ตัวชี้วัด:</label>
            <input type="text" value="<?= $data['question']; ?>" class="form-control" name="question">
        </div>
        <a href="form.php" class="btn btn-danger">ปิด</a>

        <input type="submit" name="btn_update" class="btn btn-default" value="บันทึก">
    </form>


</body>

<body>