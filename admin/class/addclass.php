<?php 

    session_start();
    require_once '../../config/db.php';

    if (isset($_POST['submit'])) {
        $schoolname = $_POST['schoolname'];
        $class_group = $_POST['class_group'];
        $school_id = $_POST['school_id'];
    

                    $stmt = $conn->prepare("INSERT INTO class_room(class_name, id_class_group, id_school) 
                                            VALUES(:class_name, :id_class_group, :id_school)");
                    $stmt->bindParam(":class_name", $schoolname);
                    $stmt->bindParam(":id_class_group", $class_group);
                    $stmt->bindParam(":id_school", $school_id);
                    $stmt->execute();
                    $conn = null;
                   
                   if ($stmt){
                   $_SESSION['success'] = "registered successfully!";
                    header("location:class.php");
                } else {
                    $_SESSION['error'] = "something went wrong!";
                    header("location:class.php");
                }
    
                }

?>