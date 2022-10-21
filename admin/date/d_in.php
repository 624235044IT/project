<mate charset="utf-8" />
<?php
echo "<pre>";
print_r($_POST);
echo "</pre>";
//exit();
?>
<?php include('dbconfig.php');




//สร้างตัวแปร
$d_1 = $_POST['d_1'];
$d_2 = $_POST['d_2'];
$d_3 = $_POST['d_3'];




//เพิ่มข้อมูล
$sql_date = " INSERT INTO tbl_date
(d_1, d_2, d_3)
VALUES
('$d_1', '$d_2', '$d_3')";




$result = mysqli_query($conn, $sql_date) or die("Error in query: $sql_date " . mysqli_connect_error());
//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//ถ้าสำเร็จให้ขึ้นอะไร
if ($result) {
    echo "<script type='text/javascript'>";
    echo "alert('Success');";
    echo "window.location = 't_date.php';";
    echo "</script>";
} else {
    //กำหนดเงื่อนไขว่าถ้าไม่สำเร็จให้ขึ้นข้อความและกลับไปหน้าเพิ่ม		
    echo "<script type='text/javascript'>";
    echo "alert('error!');";
    echo "window.location = 't_date.php'; ";
    echo "</script>";
}
?>