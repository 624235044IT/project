<?php

session_start();
require_once "../../config/db.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $urole = $_POST['urole'];
    // $c_password = $_POST['c_password'];

    if (empty($firstname)) {
        $_SESSION['error'] = 'please enter your name';
        header("location:director.php");
    } else if (empty($lastname)) {
        $_SESSION['error'] = 'please enter your last name';
        header("location:director.php");
    } else if(empty($urole)) {
        $_SESSION['error'] = 'please enter urole';
        header("location:director.php");
    } else {


    $sql = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, urole = :urole  WHERE id = :id");
    $sql->bindParam(':id', $id);
    $sql->bindParam(':firstname', $firstname);
    $sql->bindParam(':lastname', $lastname);
    $sql->bindParam(':urole', $urole);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
        header("location: director.php");
    } else {
        $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
        header("location: director.php");
    }
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
    <link rel="stylesheet" href="../../style.css" type="text/css" />
    <link rel="stylesheet" href="../../newstyle.css" type="text/css" />
</head>

<body>

    <div class="card">
        <h1 class="container-">แก้ไขข้อมูลผู้อำนวยการ</h1>
    </div><br>
    <form action="edit_director.php" method="post" enctype="multipart/form-data">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $id");
            $stmt->execute();
            $data = $stmt->fetch();
        }
        ?>
        <div class="form-group">
            <label for="firstname">ชื่่อ</label>
            <input type="hidden" readonly value="<?= $data['id']; ?>" class="form-control" name="id">
            <input type="text" value="<?= $data['firstname']; ?>" class="form-control" name="firstname">
        </div>
        <div class="form-group">
            <label for="lastname">นามสกุล</label>
            <input type="text" value="<?= $data['lastname']; ?>" class="form-control" name="lastname">
        </div>
        <!-- <div class="form-group">
            <label for="phone">เบอร์โทร</label>
            <input type="text" value="<?= $data['phone']; ?>" class="form-control" name="phone">
        </div>
        <div class="form-group">
            <label for="email">อีเมล</label>
            <input type="text" value="<?= $data['email']; ?>" class="form-control" name="email">
        </div> -->
        <!-- <div class="form-group" hidden>
            <label for="password">รหัสผ่าน:</label>
            <input type="password" value="<?= $data['phone']; ?>" class="form-control" name="password">
        </div> -->
        <!-- <div class="form-group" hidden>
            <label for="password">ยืนยันรหัสผ่าน:</label>
            <input type="password" value="<?= $data['phone']; ?>" class="form-control" name="c_password">
        </div> -->
        <div class="form-group" hidden>
            <input type="text" readonly value="<?= $data['urole']; ?>" class="form-control" name="urole">
        </div>
        <a class="btn btn-danger" href="director.php">ปิด</a>
        <button type="submit" name="update" class="btn btn-default">บันทึก</button>
        <hr>
    </form>

</body>

</html>