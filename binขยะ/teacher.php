<?php

require_once "../../config/db.php";
if (isset($_REQUEST['delete_id'])) {
  $id = $_REQUEST['delete_id'];

  $select_stmt = $conn->prepare("SELECT * FROM users WHERE id = :id");
  $select_stmt->bindParam(':id', $id);
  $select_stmt->execute();
  $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

  // Delete an original record from db
  $delete_stmt = $conn->prepare('DELETE FROM users WHERE id = :id');
  $delete_stmt->bindParam(':id', $id);
  $delete_stmt->execute();

  header('Location:teacher.php');
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="../../style.css" type="text/css" />
  <script>
    $(document).ready(function() { //
      $("#school").change(function() { //

        $.ajax({
          url: "select.php", //ทำงานกับไฟล์นี้
          data: "id_school=" + $("#school").val(), //ส่งตัวแปร
          type: "POST",
          async: false,
          success: function(data, status) {
            $("#class_room").html(data);

          },

          error: function(xhr, status, exception) {
            alert(status);
          }

        });
        //return flag;
      });
    });
  </script>
</head>

<body style="background-color: #00008B;">

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <div align="center"><br>
          <img src="../../images/icon.jpg" height="150" class="img-circle" alt="Cinque Terre">
        </div>
        <div align="center">
          <?php
          session_start();
          require_once "../../config/db.php";
          if (isset($_SESSION['admin_login'])) {
            $user_id = $_SESSION['admin_login'];
            $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
          }
          ?>
          <h4 class="mt-4">Welcome, <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['school_id'] ?></h4>
        </div><br>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="../admin.php">หน้าแรก</a></li>
          <li><a href="../school.php">ข้อมูลโรงเรียน</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">เพิ่มสมาชิก
              <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="../director/director.php">ข้อมูลผู้อำนวยการ</a></li>
              <li class="active"><a href="teacher.php?id=">ข้อมูลคุณครู</a></li>
            </ul>
          </li>
          <li><a href="../class/class.php">เพิ่มห้อง</a></li>
          <li><a href="../capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
          <li><a href="../date/t_date.php">ช่วงเวลาประเมิน</a></li>
          <li><a href="../../index.php">ออกจากระบบ</a></li>
        </ul><br>
      </div><br>
      <div class="container">
        <div class=" col-sm-15 col-sm-offset-0"><br>
          <button type="button" class="btn btn-primary btn-m" data-toggle="modal" data-target="#myModal">เพิ่มคุณครู</button>
          <hr>
          <form action="add_teacher.php" method="post">
            <?php if (isset($_SESSION['error'])) { ?>
              <div class="alert alert-danger" role="alert">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
              <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['warning'])) { ?>
              <div class="alert alert-warning" role="alert">
                <?php
                echo $_SESSION['warning'];
                unset($_SESSION['warning']);
                ?>
              </div>
            <?php } ?>
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <h2>เพิ่มคุณครู</h2>
                  <div class="form-group">
                    <label for="firstname">ชื่่อ</label>
                    <input type="text" class="form-control" name="firstname">
                  </div>
                  <div class="form-group">
                    <label for="lastname">นามสกุล</label>
                    <input type="text" class="form-control" name="lastname">
                  </div>
                  <div class="form-group">
                    <label for="phone">เบอร์โทร</label>
                    <input type="text" class="form-control" name="phone">
                  </div>
                  <div class="form-group">
                    <label for="email">อีเมล</label>
                    <input type="text" class="form-control" name="email">
                  </div>
                  <div class="form-group">
                    <label for="password">รหัสผ่าน:</label>
                    <input type="password" class="form-control" name="password">
                  </div>
                  <div class="form-group">
                    <label for="password">ยืนยันรหัสผ่าน:</label>
                    <input type="password" class="form-control" name="c_password">
                  </div>
                  <div class="form-group">
                    <label for="urole">ตำแหน่ง:</label>
                    <select name="urole" class="form-control">
                      <option value="">เลือก</option>
                      <option value="director">director</option>
                      <option value="teacher">teacher</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <?php
                    include("dbcon.php");
                    $sql = "SELECT * FROM  school" or die("Error:" . mysqli_error($con));
                    $result = mysqli_query($con, $sql);
                    echo "โรงเรียน : <select id='school' name='id_school' class='form-control'>";
                    echo "<option value=''>-Select-</option>";
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='$row[0]'>" . $row["schoolname"] . "</option>";
                    }
                    echo "</select>";
                    echo '</div>';
                    echo '<div class="form-group">';
                    $sql = "SELECT * FROM  class_room WHERE id_school='1'" or die("Error:" . mysqli_error($con));
                    $result = mysqli_query($con, $sql);
                    echo "ชั้นปี : <select id='class_room' name='id_room' class='form-control'>";
                    echo "<option value=''>-Select-</option>";
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='$row[0]>" . $row["class_name"] . " </option>";
                    }
                    echo "</select>";

                    mysqli_close($con);

                    ?>
                  </div>
                  <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                  <button type="submit" name="signup" class="btn btn-default">บันทึก</button>
          </form>
        </div>
      </div>
    </div>
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>ลำดับที่</th>
          <th>ชื่่อ</th>
          <th>นามสกุล</th>
          <th>เบอร์โทร</th>
          <th>อีเมล</th>
          <th>ตำแหน่ง</th>
          <th>โรงเรียน</th>
          <th>ชั้นปี</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require_once "../../config/db.php";
        $index = 1;
        $stmt = $conn->query("SELECT u.*, s.schoolname , c.class_name FROM users as u INNER JOIN school as s ON s.id = u.school_id INNER JOIN class_room as c on u.id_room = c.id_room  WHERE u.urole = 'teacher'");
        $stmt->execute();
        $data = $stmt->fetchAll();
        if (!$data) {
          echo "<tr><td> </td></tr>";
        } else {
          foreach ($data as $a) {
        ?>
            <tr>
              <td><?= $index++; ?></td>
              <td><?= $a['firstname']; ?></td>
              <td><?= $a['lastname']; ?></td>
              <td><?= $a['phone']; ?></td>
              <td><?= $a['email']; ?></td>
              <!-- <td><?= strlen($a['password']); ?></td> -->
              <td><?= $a['urole']; ?></td>
              <td><?= $a['schoolname']; ?></td>
              <td><?= $a['class_name']; ?></td>

              <td>
                <a href="edit_teacher.php?id=<?= $a['id']; ?>" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">แก้ไข</a>
              <td><a href="?delete_id=<?php echo $a["id"]; ?>" class="btn btn-danger btn-xs">ลบ</a></td>
              </td>
            </tr>
        <?php  }
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>