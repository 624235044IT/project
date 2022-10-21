<?php

session_start();
require_once 'config/db.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
  .navbar {
    height: 400px;
    margin-bottom: 0;
    border-radius: 0;
  }

  body {

    line-height: 50px;
    margin: 0;

    -webkit-font-smoothing: antialiased !important;
  }

  .bg {
    background-color: #00008B;
  }

  .container {
    /* background-color: #555; */
    /* width: 450px;
    height: 200px; */
    position: absolute;
    top: 40%;
    left: 20%;

    margin-top: -100px;
    margin-left: -100px;

  }
</style>

<body class="bg">
  <nav class="navbar " style="background-color: #FFE4E1;">
    <!-- <a class="navbar-brand"  >
      <img style="position: relative; top:10px; "  src="images/02.png" height="100px" width="200px" class="d-inline-block align-top">
    </a>
    <a class="navbar-brand" style="text-align: center;">
    <h3 >ระบบประเมินสมรรถนะ</h3>
    </a> -->
  </nav><br>
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-m-pull-4" style="background-color:#ffff;">
        <div>
          <hr>
        </div>
        <iframe src="https://calendar.google.com/calendar/b/1/embed?height=316&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=Asia%2FBangkok&amp;src=Y29vcHNrcnVAZ21haWwuY29t&amp;src=dGgudGgjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%230B8043&amp;color=%23D50000&amp;showTitle=0&amp;showNav=1&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=1&amp;showTz=0" style="border-width:0" width="100%" height="316" frameborder="0" scrolling="no"></iframe>
      </div>
      <div class="col-sm-5 col-m-push-4" style="background-color:#ffff;">
        <hr>
        <form action="signin_db.php" method="post">
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
              <?php
              $stmt = $conn->prepare("SELECT * FROM school");
              $stmt->execute();
              $schools = $stmt->fetchAll();
              ?>
          <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" name="email" aria-describedby="email" style="width: 350px;">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">รหัสผ่าน</label>
            <input type="password" class="form-control" name="password" style="width: 350px;">
          </div>
          <button type="submit" name="signin" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form><br>
      </div>
    </div>

  </div>

  </div>
</body>

</html>