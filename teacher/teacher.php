<?php

session_start();
require_once "../config/db.php";

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
                    <li><a href="../index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid ">
        <div class="row content">
            <div class="col-sm-2 sidenav">
                <div align="center"><br>
                    <img src="../images/icon1.png" height="100" class="img-circle" alt="Cinque Terre">
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
                    <li class="active"><a href="teacher.php">หน้าแรก</a></li>
                    <li><a href="../teacher/student/student.php">ข้อมูลนักเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ห้องเรียน</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/ชั้นปี</a></li>
                    <li><a href="#">รายงานภาพรวมสมรรถนะของผู้เรียน/โรงเรียน</a></li>
                    <li><a href="../index.php">ออกจากระบบ</a></li>
                </ul><br>
            </div><br>
            <div class="container">
                <div class=" col-sm-11 col-sm-offset-0">
                    <h3>ระบบประเมินสมรรถนะพื้นที่ทางการศึกษาจังหวัดสตูล</h3> <br>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="../images/A1.jpg">
                            </div>

                            <div class="item">
                                <img src="../images/A2.jpg">
                            </div>

                            <div class="item">
                                <img src="../images/A3.jpg">
                            </div>
                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div><br>

                <section class="bg-white">
                    <div class="col-sm-10">
                        <div class="playlists-block-header">
                            <div class="d-flex align-items-center m-b-10">
                                <div class="d-flex align-items-center ">
                                    <div class="align-self-center">
                                        <h3 class="text-primary-ct m-t-0 m-b-0">
                                            สมรรถนะหลัก 6 ด้าน </h3><br>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            สมรรถนะหลัก (Core Competencies) ตาม (ร่าง) กรอบหลักสูตรการศึกษาขั้นพื้นฐาน
                                            พุทธศักราช …. หมายถึง สมรรถนะที่กำหนดให้เป็นพื้นฐานที่นักเรียนทุกคนต้องได้รับการพัฒนาให้เป็นความสามารถติดตัว
                                            เมื่อจบการศึกษา มีลักษณะเป็นสมรรถนะข้ามสาระการเรียนรู้หรือคร่อมวิชา สามารถพัฒนาให้เกิดขึ้นแก่ผู้เรียนได้ในสาระการเรียนรู้ต่าง ๆ
                                            ที่หลากหลาย หรือสามารถนำไปประยุกต์ใช้ในการพัฒนาผู้เรียนให้เรียนรู้สาระต่าง ๆ ได้ดีขึ้น เป็นสมรรถนะที่มีลักษณะ “content – free” คือ ไม่ขึ้นกับเนื้อหาสาระของศาสตร์ใด ๆ
                                            อย่างไรก็ตามสมรรถนะหลักโดยตัวมันเองไม่ได้ปราศจากความรู้ แต่ความรู้ที่เป็นองค์ประกอบของสมรรถนะหลักจะเป็นองค์ความรู้เชิงกระบวนการ (Procedural Knowledge)
                                            ซึ่งเป็นชุดของขั้นตอนหรือการปฏิบัติเพื่อดำเนินการให้บรรลุเป้าหมายของสมรรถนะนั้น ๆ เป็นได้ทั้งกระบวนการที่ใช้เฉพาะศาสตร์หรือบูรณาการข้ามศาสตร์ เช่น ความรู้ที่เป็นองค์ประกอบของสมรรถนะการคิดขั้นสูงเป็นเป็นชุดความรู้ที่เกี่ยวข้องกับกระบวนการคิดประเภทต่าง ๆ เช่น การคิดวิเคราะห์ การคิดเชิงวิพากษ์ และการคิดสร้างสรรค์</h4><br>
                                        <h4 class="text-primary-ct m-t-0 m-b-0">
                                            สมรรถนะทั้ง 6 ด้าน ได้แก่ </h4>
                                        <h4 class="text-primary-ct m-t-0 m-b-0">
                                            1.สมรรถนะการจัดการตนเอง </h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            2.สมรรถนะการคิดขั้นสูง</h4>
                                        <h4 class="text-primary-ct m-t-0 m-b-0">
                                            3.สมรรถนะการสื่อสาร</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            4.สมรรถนะการรวมพลังทำงานเป็นทีม</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            5.สมรรถนะการเป็นพลเมืองที่เข้มแข็ง</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            6.สมรรถนะการอยู่ร่วมกับธรรมชาติและวิทยาการอย่างยั่งยืน</h4><br>
                                        <h4 class="text-primary-ct m-t-0 m-b-0">
                                            สมรรถนะทั้ง 6 ด้าน จะได้รับการพัฒนาผ่านขอบข่ายการเรียนรู้ (Learning Area) 5 ด้าน เพื่อบูรณาการหัวข้อการเรียนรู้ข้ามศาสตร์ให้ผู้เรียนสามารถพัฒนาและแสดงความสามารถผ่านมุมมองต่าง ๆ ได้แก่</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            1. ขอบข่ายการเรียนรู้ด้านสุขภาวะกายและจิต</h4>
                                        <h4 class="text-primary-ct m-t-0 m-b-0">
                                            2. ขอบข่ายการเรียนรู้ด้านภาษา ศิลปะและวัฒนธรรม</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            3. ขอบข่ายการเรียนรู้ด้านโลกของงานและการประกอบอาชีพ</h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            4. ขอบข่ายการเรียนรู้ด้านคณิตศาสตร์ วิทยาศาสตร์และเทคโนโลยี </h4>
                                        <h4 class="m-t-0 m-b-0 hidden-xs">
                                            5. ขอบข่ายการเรียนรู้ด้านสังคมและความเป็นมนุษย์</h4><br>
                                        <div class="col-sm-10">
                                            <img src="../images/A4.png" style="width: 50%;">
                                            <h4 class="m-t-0 m-b-0 hidden-xs"><br>
                                                การพัฒนาผู้เรียนให้เกิดสมรรถนะและรากฐานสำคัญ ผ่านขอบข่ายการเรียนรู้ เพื่อบรรลุเป้าหมายสำคัญ คือ มาตรฐานการศึกษาของชาติในรูปแบบผลลัพธ์ที่พึงประสงค์ทางการศึกษา พ.ศ. 2561
                                                ทั้ง 3 ด้าน ได้แก่</h4>
                                            <h4 class="m-t-0 m-b-0 hidden-xs">
                                                1. การเป็นผู้เรียนรู้</h4>
                                            <h4 class="m-t-0 m-b-0 hidden-xs">
                                                2. การเป็นผู้ร่วมสร้างสรรค์นวัตกรรม</h4>
                                            <h4 class="m-t-0 m-b-0 hidden-xs">
                                                3. การเป็นพลเมืองที่เข้มแข็ง</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>
    </div>

</body>

</html>