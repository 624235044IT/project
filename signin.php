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
  <title>registration</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-5">

      </div>

      <div class="col-sm-5">
        <div class="container">
          <div class="card" style="border-radius: 25px;">
            <h3 class="mt-5">Login</h3>
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
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="email">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
              </div><br>
              <!-- <div class="mb-3">
                <label for="school" class="form-label">school</label>
                <select name="school_id" class="form-control" required>
                  <option value="">เลือก</option>
                  <?php
                  foreach ($schools as $row) { ?>
                    <option value="<?= $row['id']; ?>"><?= $row['schoolname']; ?></option>
                  <?php } ?>
                </select>
              </div><br> -->
              <button type="submit" name="signin" class="btn btn-primary">Signin</button>
            </form><br>
            <p>Click here to <a href="index.php">register</a></p>
            <hr>
          </div>
        </div>
      </div>


    </div>
  </div>
</body>

</html>