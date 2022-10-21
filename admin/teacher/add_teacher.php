<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['signup'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $urole = $_POST['urole'];
        $school = $_POST['id_school'];
        $class = $_POST['id_room'];

        if (empty($firstname)) {
            $_SESSION['error'] = 'please enter your name';
            header("location: teacher.php");
        } else if (empty($lastname)) {
            $_SESSION['error'] = 'please enter your last name';
            header("location: teacher.php");
        } else if (empty($phone)) {
            $_SESSION['error'] = 'please enter your last name';
            header("location: teacher.php");
        } else if (empty($email)) {
            $_SESSION['error'] = 'please enter email';
            header("location: teacher.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'invalid email format';
            header("location: teacher.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'please enter your password';
            header("location: teacher.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 10) {
            $_SESSION['error'] = 'password must be between 10 and 20 characters long.';
            header("location: teacher.php");
        } else if (empty($c_password)) {
            $_SESSION['error'] = 'please confirm your password.';
            header("location: teacher.php");
        } else if ($password != $c_password) {
            $_SESSION['error'] = 'passwords do not match';
            header("location: teacher.php");
        }  else if(empty($urole)) {
            $_SESSION['error'] = 'please enter urole';
            header("location: teacher.php");
        } else if (empty($school)) {
            $_SESSION['error'] = 'please enter school';
            header("location: teacher.php");
        } else if (empty($class)) {
            $_SESSION['error'] = 'please enter school';
            header("location: teacher.php");
        }else {
            try {

                $check_email = $conn->prepare("SELECT * FROM users WHERE id_room = :id_room");
                $check_email->bindParam(":id_room", $class);
                $check_email->execute();
                $row = $check_email->fetch(PDO::FETCH_ASSOC);

                if ($row['id_room'] == $class) {
                    $_SESSION['warning'] = "this email is already in the system";
                    header("location: teacher.php");
                } else if (!isset($_SESSION['error'])) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("INSERT INTO users(firstname, lastname, phone, email, password, urole, school_id, id_room) 
                                            VALUES(:firstname, :lastname, :phone, :email, :password, :urole, :school_id, :id_room)");
                    $stmt->bindParam(":firstname", $firstname);
                    $stmt->bindParam(":lastname", $lastname);
                    $stmt->bindParam(":phone", $phone);
                    $stmt->bindParam(":email", $email);
                    $stmt->bindParam(":password", $passwordHash);
                    $stmt->bindParam(":urole", $urole);
                    $stmt->bindParam(":school_id", $school);
                    $stmt->bindParam(":id_room", $class);
                    $stmt->execute();
                    $_SESSION['success'] = "เพิ่มข้อมูลสำเร็จ";
                    header("refresh:1; url= teacher.php");
                } else {
                    $_SESSION['error'] = "เพิ่มข้อมูลล้มเหลว";
                    header("refresh:1; url= teacher.php");
                }
                
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }


?>