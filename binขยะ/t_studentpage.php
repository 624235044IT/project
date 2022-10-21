<?php

session_start();
require_once "../../config/db.php";

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

<body style="background-color: #8FBC8F;">

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div align="center"><br>
          <img src="../../images/icon1.png" height="150" class="img-circle" alt="Cinque Terre">
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
          <h4 class="mt-4">Welcome, <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['school_id'] . ' ' . $row['id_room'] ?></h4>
        </div><br>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="../teacher.php">หน้าแรก</a></li>
          <li class="active"><a href="student.php">ข้อมูลนักเรียน</a></li>
          <li><a href="#">รายงานภาพรวมสมรรถนะของห้องเรียน</a></li>
          <li><a href="#">รายงานภาพรวมสมรรถนะของชั้นปี</a></li>
          <li><a href="../../index.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>
      <div class="container">
        <div class=" col-sm-15 col-sm-offset-0">
          <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal">เพิ่มนักเรียน</button>
          <hr>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <h2>เพิ่มนักเรียน</h2>
                <form action="addstudent.php" method="post">
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
                    <label for="school">ชั้นปี</label>
                    <select name="school_id" class="form-control" required>
                      <option value="">เลือก</option>
                      <?php
                      foreach ($schools as $row) { ?>
                        <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
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
                <th width="40%" scope="col">ชื่่อ</th>
                <th width="20%" scope="col">นามสกุล</th>
                <th width="10%" scope="col">ชั้นปี</th>
                <th width="5%" scope="col">ฟอร์ม</th>
                <th width="5%" scope="col">คะแนน</th>
                <th width="5%" scope="col">แก้ไขคะแนน</th>
                <th width="5%" scope="col">พิมพ์รายงาน</th>
                <th width="5%" scope="col">แก้ไข</th>
                <th width="5%" scope="col">ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_SESSION['class_room'])) {
                $index = 1;
                $class_id = $_SESSION['class_room'];
                $stmt = $conn->query("SELECT t.*,c.class_name FROM student as t INNER JOIN class_room as c on c.id_room = t.id_room  WHERE t.id_teacher = $user_id ");
                $stmt->execute();
                $data = $stmt->fetchAll();

                if (!$data) {
                  echo "ไม่มี";
                } else {
                  foreach ($data as $student) {

              ?>
                    <tr>
                      <td><?= $index++; ?></td>
                      <td><?= $student['student_name']; ?></td>
                      <td><?= $student['student_lastname']; ?></td>
                      <td><?= $student['class_name']; ?></td>
                      <td><a href="../../form/form.php?id=<?= $student['id_student']; ?>" class="btn btn-info btn-sm">ฟอร์ม</a>
                      <td><a href="#?id=<?= $student['id_student']; ?>" class="btn btn-default btn-sm">คะแนน</a>
                      <td><a href="#?id=<?= $student['id_student']; ?>" class="btn btn-warning btn-sm">แก้ไขคะแนน</a>
                      <td><a href="#?id=<?= $student['id_student']; ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
                      <td><a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">แก้ไขชื่อ</a>
                      <td><a href="#" class="btn btn-danger btn-sm">ลบ</a></td>
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

  <!-- สิ้นสุด container -->









</body>

</html>