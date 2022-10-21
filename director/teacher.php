<?php
session_start();
require_once "../config/db.php";

//สร้างเงื่อนไขตรวจสอบถ้ามีการค้นหาให้แสดงเฉพาะรายการค้นหา
if (isset($_GET['firstname']) && $_GET['firstname'] != '') {

    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $firstname = "%{$_GET['firstname']}%";

    //คิวรี่ข้อมูลมาแสดงจากการค้นหา
    $stmt = $conn->prepare("SELECT* FROM users WHERE firstname LIKE ?");
    $stmt->execute([$firstname]);
    $stmt->execute();
    $result = $stmt->fetchAll();
} else {
    //คิวรี่ข้อมูลมาแสดงตามปกติ *แสดงทั้งหมด
    $stmt = $conn->prepare("SELECT* FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll();
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
    <link rel="stylesheet" href="../style.css" type="text/css" />
    <link rel="stylesheet" href="../newstyle.css" type="text/css" />
</head>

<body style="background-color: #F5F5DC;">

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
                    <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <div align="center"><br>
                    <img src="../images/icon2.png" height="100" class="img-circle" alt="Cinque Terre">
                </div>
                <div align="center">
                    <?php
                    if (isset($_SESSION['director_login'])) {
                        $user_id = $_SESSION['director_login'];
                        $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                    <h4 class="mt-4">ผู้อำนวยการ <?php echo $row['firstname'] . ' ' . $row['lastname'] . ' ' . $row['school_id'] ?></h4>
                </div><hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="director.php">หน้าแรก</a></li>
                    <li class="active"><a href="teacher.php">รายชื่อครูประจำชั้น</a></li>
                    <li><a href="form.php">สมรรถนะ(ตัวชี้วัด)</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0">
                    <hr>
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

                    <form action="teacher.php" method="get">
                        <div class="mb-3 row">
                            <!-- d-none d-sm-block คือซ่อนเมื่ออยู่หน้าจอโทรศัพท์ -->
                            <label class="col-3 col-sm-2 col-form-label d-none d-sm-block">ค้นหาข้อมูล</label>
                            <div class="col-7 col-sm-5">
                                <input type="text" name="firstname" required class="form-control" placeholder="ระบุชื่อที่ต้องการค้นหา" value="<?php if (isset($_GET['firstname'])) {
                                                                                                                                                    echo $_GET['firstname'];
                                                                                                                                                } ?>">
                            </div>
                            <div class="col-2 col-sm-1">
                                <button type="submit" class="btn btn-primary">ค้นหา</button>
                            </div>
                            <div class="col-2 col-sm-1">
                                <a href="teacher.php" class="btn btn-success">Reset</a>
                            </div>
                        </div>
                    </form>
                    <?php
                    //แสดงข้อความที่ค้นหา
                    if (isset($_GET['firstname']) && $_GET['firstname'] != '') {
                        echo '<font color="red"> ข้อมูลการค้นหา : ' . $_GET['firstname'];
                        echo ' *พบ ' . $stmt->rowCount() . ' รายการ</font><br><br>';
                    } ?>
                    <hr>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM school");
                    $stmt->execute();
                    $schools = $stmt->fetchAll();
                    ?>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
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
                                        <option value="director">director</option>
                                        <option value="teacher">teacher</option>
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
                                <th>ห้องเรียน</th>
                                <th>ข้อมูล</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['school_id'])) {
                                $index = 1;
                                $user_id = $_SESSION['school_id'];
                                $stmt = $conn->query("SELECT u.*, c.class_name FROM users as u INNER JOIN class_room as c on c.id_room = u.id_room WHERE u.school_id = $user_id AND urole = 'teacher'");
                                $stmt->execute();
                                $data = $stmt->fetchAll();

                                if (!$data) {
                                    echo "ไม่มี";
                                } else {
                                    foreach ($data as $a) {

                            ?>
                                        <tr>
                                            <td><?= $index++; ?></td>
                                            <td><?= $a['firstname']; ?></td>
                                            <td><?= $a['lastname']; ?></td>
                                            <td><?= $a['phone']; ?></td>
                                            <td><?= $a['email']; ?></td>
                                            <td><?= $a['urole']; ?></td>
                                            <td><?= $a['class_name']; ?></td>
                                            <td><a href="student.php?id=<?= $a["id"]; ?>" class="btn btn-danger btn-xs">ข้อมูล</a></td>
                                        </tr>

                            <?php }
                                }
                            } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid text-center">
        <p>Footer Text</p>
    </footer>

</body>

</html>