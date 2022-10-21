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
    <style>
        body {

            line-height: 22px;
            margin: 0;

            -webkit-font-smoothing: antialiased !important;
        }

        .container {
            background-color: #ffff;
            width: 800px;
            height: 500px;
            position: absolute;
            top: 30%;
            left: 40%;
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
            margin-left: auto;
            margin-right: auto
        }
    </style>

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
                    <li><a href="../admin.php">ข้อมูลโรงเรียน</a></li>
                    <li><a href="../director/director.php">ข้อมูลผู้อำนวยการ</a></li>
                    <li><a href="../teacher/teacher.php">ข้อมูลคุณครู</a></li>
                    <li><a href="../class/class.php">เพิ่มห้อง</a></li>
                    <li><a href="../capacity/form.php">ตัวชี้วัดสมรรถนะ</a></li>
                    <li class="active"><a href="../date/t_date.php">ช่วงเวลาประเมิน</a></li>
                    <li><a href="../../index.php">ออกจากระบบ</a></li>
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
    <!-- สิ้นสุด container -->
</body>

</html>
<!-- <div class="container">
    <div class="row">

        <?php foreach ($sql_date as $rs) { ?>
            <div class="col-sm-4">

                <div class="card">

                    <div class="card-body">
                        <b>
                            <p class="card-text">Date_1 : <?php echo $rs['d_1']; ?></p>
                            <br />
                            <p class="card-text">Date_2 : <?php echo $rs['d_2']; ?></p>
                            <br />
                            <p class="card-text">Date_3 : <?php echo $rs['d_3']; ?></p>
                            <br />
                            <p class="card-text">Date(CURRENT_TIMESTAMP) : <?php echo $rs['d_insert']; ?></p>
                            <br />
                            <p class="card-text">Date(CURRENT_TIMESTAMP-Modify) : <?php echo date('d/m/Y H:i:s', strtotime($rs['d_insert'])); ?></p>
                        </b>
                    </div>
                </div>
                <br />

            </div> -->


<!-- <?php } ?>

    </div>
</div> -->