<?php

session_start();
require_once "../../config/db.php";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $number_id = $_POST['number_id'];
    $title = $_POST['title'];
    $student_name = $_POST['student_name'];
    $student_lastname = $_POST['student_lastname'];

    if (empty($student_name)) {
        $_SESSION['error'] = 'please enter your name';
        header("location:student.php");
    } else if (empty($student_lastname)) {
        $_SESSION['error'] = 'please enter your last name';
        header("location:student.php");
    } else {


        $sql = $conn->prepare("UPDATE student SET number_id = :number_id, title = :title, student_name = :student_name, student_lastname = :student_lastname  WHERE id_student = :id_student");
        $sql->bindParam(':id_student', $id);
        $sql->bindParam(':number_id', $number_id);
        $sql->bindParam(':title', $title);
        $sql->bindParam(':student_name', $student_name);
        $sql->bindParam(':student_lastname', $student_lastname);
        $sql->execute();

        if ($sql) {
            $_SESSION['success'] = "แก้ไขเพิ่มข้อมูลเสร็จสิ้น";
            header("location: student.php");
        } else {
            $_SESSION['error'] = "แก้ไขข้อมูลล้มเหลว";
            header("location: student.php");
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
        <h1 class="container-">แก้ไขข้อมูลนักเรียน</h1>
    </div><br>
    <form action="editstudent.php" method="post">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $conn->query("SELECT * FROM student WHERE id_student = $id");
            $stmt->execute();
            $data = $stmt->fetch();
        }
        ?>
        <div class="form-group">
            <label for="lastname">รหัสนักเรียน</label>
            <input type="text" value="<?= $data['number_id']; ?>" class="form-control" name="number_id">
        </div>
        <div class="form-group">
            <label for="school">คำนำหน้า</label>
            <select name="title" class="form-control" required>
                <option value="">เลือก</option>
                <option value="ด.ช">ด.ช</option>
                <option value="ด.ญ">ด.ญ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="firstname">ชื่่อ</label>
            <input type="hidden" readonly value="<?= $data['id_student']; ?>" class="form-control" name="id">
            <input type="text" value="<?= $data['student_name']; ?>" class="form-control" name="student_name">
        </div>
        <div class="form-group">
            <label for="lastname">นามสกุล</label>
            <input type="text" value="<?= $data['student_lastname']; ?>" class="form-control" name="student_lastname">
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
        <!-- <div class="form-group" hidden>
            <input type="text" readonly value="<?= $data['urole']; ?>" class="form-control" name="urole">
        </div> -->
        <a class="btn btn-danger" href="student.php">ปิด</a>
        <button type="submit" name="update" class="btn btn-default">บันทึก</button>
        <hr>
    </form>

</body>

</html>