<?php

session_start();
require_once "../../config/db.php";

if (isset($_REQUEST['delete_id'])) {
    $id = $_REQUEST['delete_id'];

    $select_stmt = $conn->prepare("SELECT * FROM student WHERE id_student = :id_student");
    $select_stmt->bindParam(':id_student', $id);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

    // Delete an original record from db
    $delete_stmt = $conn->prepare('DELETE FROM student WHERE id_student = :id_student ');
    $delete_stmt->bindParam(':id_student', $id);
    $delete_stmt->execute();

    if ($delete_stmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("refresh:1; url=student.php");
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

<body style="background-color: #8FBC8F;">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">ระบบประเมินสมรรถนะผู้เรียนจังหวัดสตูล</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid ">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <div align="center"><br>
                    <img src="../../images/icon1.png" height="100" class="img-circle" alt="Cinque Terre">
                </div>
                <div align="center">
                    <?php
                    if (isset($_SESSION['tech_login'])) {
                        $user_id = $_SESSION['tech_login'];
                        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <h4 class="mt-4">คุณครู <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['school_id'] . ' ' . $row['id_room'] ?></h4>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../teacher.php">หน้าแรก</a></li>
                    <li class="active"><a href="student.php">ข้อมูลนักเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของชั้นปี</a></li>
                    <li><a href="../../index.php">ออกจากระบบ</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0"><br>
                    <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal">เพิ่มนักเรียน</button>
                    <hr>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                            ?>
                        </div>
                    <?php } ?>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <h2>เพิ่มนักเรียน</h2>
                                <form action="addstudent.php" method="post">
                                    <div class="form-group">
                                        <label for="firstname">รหัสนักเรียน</label>
                                        <input type="text" class="form-control" name="number_id">
                                    </div>
                                    <div class="form-group">
                                        <label for="school">ชั้นปี</label>
                                        <select name="title" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <option value="ด.ช">ด.ช</option>
                                            <option value="ด.ญ">ด.ญ</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">ชื่่อ</label>
                                        <input type="text" class="form-control" name="student_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">นามสกุล</label>
                                        <input type="text" class="form-control" name="student_lastname">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="class_years">ชั้นปี</label>
                                        <input type="text" readonly value="<?= $row['id_room']; ?>" class="form-control" name="id_room">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="school_id">โรงเรียน</label>
                                        <input type="text" readonly value="<?= $row['school_id']; ?>" class="form-control" name="school_id">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="school_id">คุณครูประจำชั้น</label>
                                        <input type="text" readonly value="<?= $row['id']; ?>" class="form-control" name="id_teacher">
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="school">โรงเรียน</label>
                                        <select name="school_id" class="form-control" required>
                                            <option value="">เลือก</option>
                                            <?php
                                            foreach ($schools as $row) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                                    <button type="submit" name="submit" class="btn btn-default">บันทึก</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="10%" scope="col">ลำดับที่</th>
                                <th width="10%" scope="col">คำนำหน้า</th>
                                <th width="20%" scope="col">ชื่่อ</th>
                                <th width="20%" scope="col">นามสกุล</th>
                                <th width="10%" scope="col">ชั้นปี</th>
                                <th width="10%" scope="col">แก้ไข</th>
                                <th width="5%" scope="col">ฟอร์ม</th>
                                <th width="5%" scope="col">คะแนน</th>
                                <th width="5%" scope="col">พิมพ์รายงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['class_room'])) {
                                $class_id = $_SESSION['class_room'];
                                $stmt = $conn->query("SELECT t.*,c.class_name FROM student as t INNER JOIN class_room as c on c.id_room = t.id_room  WHERE t.id_teacher = $user_id ");
                                $stmt->execute();
                                $data = $stmt->fetchAll();

                                if (!$data) {
                                    echo "ไม่มี";
                                } else {
                                    foreach ($data as $student) {

                                        $sum = $student['']

                            ?>
                                        <tr>
                                            <td><?= $student['number_id']; ?></td>
                                            <td><?= $student['title']; ?></td>
                                            <td><?= $student['student_name']; ?></td>
                                            <td><?= $student['student_lastname']; ?></td>
                                            <td><?= $student['class_name']; ?></td>
                                            <td><a href="editstudent.php?id=<?= $student['id_student']; ?>" class="btn btn-defult btn-sm" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a><a href="?delete_id=<?php echo $student["id_student"]; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                                            <td>
                                                <a href="form.php?id=<?= $student['id_student']; ?>" class="btn btn-info btn-sm">ฟอร์ม</a>
                                            </td>
                                            <td><a href="#?id=<?= $student['id_student']; ?>" class="btn btn-default btn-sm">คะแนน</a>
                                            <td><a href="#?id=<?= $student['id_student']; ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                                            </td>

                                        </tr>

                            <?php  }
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>