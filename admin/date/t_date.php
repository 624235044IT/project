<?php
include('dbconfig.php');
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

<body style="background-color: #00008B;">

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
                    <img src="../../images/icon.jpg" height="100" class="img-circle" alt="Cinque Terre">
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
                </div><hr>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="../admin.php">หน้าแรก</a></li>
                    <li><a href="../admin.php">ข้อมูลโรงเรียน</a></li>
                    <li><a href="../director/director.php">ข้อมูลผู้อำนวยการ</a></li>
                    <li><a href="../teacher/teacher.php">ข้อมูลคุณครู</a></li>
                    <li><a href="../class/class.php">เพิ่มห้อง</a></li>
                    <li><a href="../capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
                    <li class="active"><a href="../date/t_date.php">ช่วงเวลาประเมิน</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-10 col-sm-offset-1">
                    <form action="d_in.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <center>
                            <br><br><br>
                            <p>
                            <h2>ช่วงเวลาประเมิน
                            </h2>
                            </p><br>
                            <?php
                            date_default_timezone_set('Asia/Bangkok');
                            $date_nows = date('d-m-Y H:i:s');
                            $date_nows2 = date('Y-m-d H:i:s');
                            echo $date_nows;
                            echo "<br>";
                            echo $date_nows2;
                            ?>
                            <!-- วันที่ปัจจุบัน -->

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">


                                        <label for="exampleInputEmail1"><b>วันที่ระบบเปิด</b></label><br />
                                        <input type="hidden" name="d_1" value="<?php echo $date_nows; ?>">
                                        <input class="form-control" type="date" name="d_2">

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="exampleInputEmail1"><b>วันที่ระบบปิด</b></label><br />
                                    <input type="hidden" name="d_1" value="<?php echo $date_nows; ?>">
                                    <input class="form-control" type="date" name="d_3">

                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-block">ตกลง</button>

                        </center>


                    </form>
                    <br>

                    <?php
                    $sql_date = "SELECT * FROM tbl_date"
                        or die("Error : " . mysqli_connect_error($sql_date));
                    $sql_date = mysqli_query($con, $sql_date);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>