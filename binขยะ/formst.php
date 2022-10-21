<?php

session_start();
require_once "../../config/db.php";

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM tb_question WHERE id_question = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
        $_SESSION['success'] = "ลบข้อมูลเสร็จสิ้น";
        header("location:form.php");
    }
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
    <style>
        body {

            line-height: 22px;
            margin: 0;

            -webkit-font-smoothing: antialiased !important;
        }

        .container {
            background-color: #FFFFFF;
            width: 980px;
            /* height: 200px; */
            position: absolute;
            top: 25%;
            left: 35%;
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
            margin-left: 28%;
        }
    </style>
</head>

<body style="background-color: #00008B;">

    <div class="container-fluid">
        <div class="row content">
            <div class="container">
                <div class=" col-sm-15 col-sm-offset-0">
                    <?php
                    if (isset($errorMsg)) {
                    ?>
                        <div class="alert alert-danger">
                            <strong>Wrong! <?php echo $errorMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($insertMsg)) {
                    ?>
                        <div class="alert alert-success">
                            <strong>Success! <?php echo $insertMsg; ?></strong>
                        </div>
                    <?php } ?>
                    <form action="save.php" method="post">
                        <table class="table  table-bordered">
                            <tr bgcolor="#F5FFFA">
                                <!-- <td width="25">&nbsp;</td> -->
                                <td colspan="10" align="center">ระบบประเมินสมรรถนะของผู้เรียนพื้นที่นวัตกรรมจังหวัดสตูล</td>
                            </tr><br>
                            <tr>
                                <th width="5%" scope="col">ลำดับ</th>
                                <th width="40%" scope="col">รายการประเมินตัวชี้วัด</th>
                                <th width="5%" scope="col">มากที่สุด</th>
                                <th width="5%" scope="col">มาก</th>
                                <th width="5%" scope="col">ปานกลาง</th>
                                <th width="5%" scope="col">น้อย</th>
                                <th width="5%" scope="col">น้อยที่สุด</th>
                                <!-- <th width="10%" scope="col">เครื่องมือ</th> -->
                            </tr>
                            </th>

                            <?php
                            $select_stmt = $conn->prepare("SELECT * FROM form_header ");
                            $select_stmt->execute();
                            $data = $select_stmt->fetchAll();

                            ?>
                            <tbody>
                                <TR class='HeaderDetail'>
                                    <TD BGCOLOR=#E0E0E0 COLSPAN='7'>ความสามารถในการสื่อสาร</TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>1
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีความสามารถในการรับ-ส่งสาร </TD><input type="hidden" name="D02" value="101" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice1" name="Q02" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice2" name="Q02" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice3" name="Q02" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice4" name="Q02" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice5" name="Q02" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>2
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีความสารถในการถ่ายทอดความรู้ </TD><input type="hidden" name="D03" value="102" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice6" name="Q03" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice7" name="Q03" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice8" name="Q03" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice9" name="Q03" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice10" name="Q03" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>3
                                    </TD>
                                    <TD bgcolor=#F0F7F7>ใช้วิธีการสื่อสารที่เหมาะสมมีประสิทธิภาพ</TD><input type="hidden" name="D04" value="103" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice11" name="Q04" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice12" name="Q04" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice13" name="Q04" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice14" name="Q04" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice15" name="Q04" value="1" /></TD>
                                </TR>

                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>4
                                    </TD>
                                    <TD bgcolor=#F0F7F7>เจรจาต่อรองเพื่อขจัดและลดปัญหาความขัดแย้งต่าง ๆได้ </TD><input type="hidden" name="D05" value="104" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice16" name="Q05" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice17" name="Q05" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice18" name="Q05" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice19" name="Q05" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice20" name="Q05" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>5
                                    </TD>
                                    <TD bgcolor=#F0F7F7>เลือกรับและไม่รับข้อมูลข่าวสารด้วยเหตุผลและถูกต้อง </TD><input type="hidden" name="D06" value="105" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice21" name="Q06" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice22" name="Q06" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice23" name="Q06" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice24" name="Q06" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice25" name="Q06" value="1" /></TD>
                                </TR>
                                <TR class='HeaderDetail'>
                                    <TD BGCOLOR=#E0E0E0 COLSPAN='7'>ความสามารถในการคิด</TD>
                                </TR>

                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>7
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีความสารถในการคิด/วิเคราะห์ </TD><input type="hidden" name="D08" value="201" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice31" name="Q08" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice32" name="Q08" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice33" name="Q08" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice34" name="Q08" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice35" name="Q08" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>8
                                    </TD>
                                    <TD bgcolor=#F0F7F7>ทักษะในการคิดนอกรอบอย่างสร้างสรรค์ </TD><input type="hidden" name="D09" value="202" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice36" name="Q09" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice37" name="Q09" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice38" name="Q09" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice39" name="Q09" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice40" name="Q09" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>9
                                    </TD>
                                    <TD bgcolor=#F0F7F7>สามารถคิดอย่างมีวิจรณญาณ </TD><input type="hidden" name="D10" value="203" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice41" name="Q10" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice42" name="Q10" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice43" name="Q10" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice44" name="Q10" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice45" name="Q10" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>10
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีความสามารถในการสร้างองค์ความรู้ </TD><input type="hidden" name="D11" value="204" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice46" name="Q11" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice47" name="Q11" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice48" name="Q11" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice49" name="Q11" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice50" name="Q11" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>11
                                    </TD>
                                    <TD bgcolor=#F0F7F7> ตัดสินใจแก้ปัญหาเกี่ยวกับตนเองได้อย่างเหมาะสม</TD><input type="hidden" name="D12" value="205" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice51" name="Q12" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice52" name="Q12" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice53" name="Q12" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice54" name="Q12" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice55" name="Q12" value="1" /></TD>
                                </TR>
                                <TR class='HeaderDetail'>
                                    <TD BGCOLOR=#E0E0E0 COLSPAN='7'>ความสามารถในการแก้ปัญหา</TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>12
                                    </TD>
                                    <TD bgcolor=#F0F7F7>สามารถแก้ปัญหาและอุปสรรคต่าง ๆ ที่เผชิญได้ </TD><input type="hidden" name="D15" value="301" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice56" name="Q15" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice57" name="Q15" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice58" name="Q15" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice59" name="Q15" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice60" name="Q15" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>13
                                    </TD>
                                    <TD bgcolor=#F0F7F7>เข้าใจความสัมพันธ์และการเปลี่ยนแปลงในสังคม </TD><input type="hidden" name="D16" value="302" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice61" name="Q16" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice62" name="Q16" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice63" name="Q16" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice64" name="Q16" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice65" name="Q16" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>14
                                    </TD>
                                    <TD bgcolor=#F0F7F7>แสวงหาความรู้ประยุกต์ความรู้มาใช้ในการป้องกันและแก้ปัญหา </TD><input type="hidden" name="D17" value="303" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice66" name="Q17" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice67" name="Q17" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice68" name="Q17" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice69" name="Q17" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice70" name="Q17" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>15
                                    </TD>
                                    <TD bgcolor=#F0F7F7>สามารถตัดสินได้อย่างเหมาะสมตามวัย ครอบคลุมเนื้อหาครบตามแนวการเรียน </TD><input type="hidden" name="D18" value="304" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice71" name="Q18" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice72" name="Q18" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice73" name="Q18" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice74" name="Q18" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice75" name="Q18" value="1" /></TD>
                                </TR>
                                <TR class='HeaderDetail'>
                                    <TD BGCOLOR=#E0E0E0 COLSPAN='7'>ความสามารถในการใช้ทักษะชีวิต</TD>
                                </TR>

                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>16
                                    </TD>
                                    <TD bgcolor=#F0F7F7>เรียนรู้ด้วยตัวเองได้อย่างเหมาะสมกับวัย </TD><input type="hidden" name="D19" value="401" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice76" name="Q19" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice77" name="Q19" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice78" name="Q19" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice79" name="Q19" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice80" name="Q19" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>17
                                    </TD>
                                    <TD bgcolor=#F0F7F7>สามารถทำงานกลุ่มร่วมกับผู้อื่นได้ </TD><input type="hidden" name="D20" value="402" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice81" name="Q20" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice82" name="Q20" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice83" name="Q20" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice84" name="Q20" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice85" name="Q20" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>18
                                    </TD>
                                    <TD bgcolor=#F0F7F7>นำความรู้ที่ได้ไปใช้ประโยชน์ในชีวิตประจำวัน</TD><input type="hidden" name="D21" value="403" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice86" name="Q21" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice87" name="Q21" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice88" name="Q21" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice89" name="Q21" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice90" name="Q21" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>19
                                    </TD>
                                    <TD bgcolor=#F0F7F7>จัดการปัญหาและความขัดเเย้งได้อย่างเหมาะสม </TD><input type="hidden" name="D22" value="404" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice91" name="Q22" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice92" name="Q22" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice93" name="Q22" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice94" name="Q22" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice95" name="Q22" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>20
                                    </TD>
                                    <TD bgcolor=#F0F7F7>หลีกเลี่ยงพฤติกรรมไม่พึงประสงค์ที่ส่งผลกระทบต่อตนเอง</TD><input type="hidden" name="D23" value="405" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice96" name="Q23" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice97" name="Q23" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice98" name="Q23" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice99" name="Q23" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice100" name="Q23" value="1" /></TD>
                                </TR>
                                <TR class='HeaderDetail'>
                                    <TD BGCOLOR=#E0E0E0 COLSPAN='7'>ความสามารถในการใช้เทคโนโลยี</TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>21
                                    </TD>
                                    <TD bgcolor=#F0F7F7>เลือกและใช้เทคโนโลยีได้อย่างเหมาะสม</TD><input type="hidden" name="D25" value="501" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice101" name="Q25" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice102" name="Q25" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice103" name="Q25" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice104" name="Q25" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice105" name="Q25" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>22
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีทักษะกระบวนการทางเทคโนโลยี </TD><input type="hidden" name="D26" value="502" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice106" name="Q26" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice107" name="Q26" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice108" name="Q26" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice109" name="Q26" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice110" name="Q26" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>23
                                    </TD>
                                    <TD bgcolor=#F0F7F7>สามารถนำเทคโนโลยีไปใช้พัฒนาตนเอง</TD><input type="hidden" name="D27" value="503" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice111" name="Q27" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice112" name="Q27" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice113" name="Q27" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice114" name="Q27" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice115" name="Q27" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>24
                                    </TD>
                                    <TD bgcolor=#F0F7F7>ใช้เทคโนโลยีในการแก้ปัญหาได้อย่างสร้างสรรค์ </TD><input type="hidden" name="D28" value="504" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice116" name="Q28" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice117" name="Q28" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice118" name="Q28" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice119" name="Q28" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice120" name="Q28" value="1" /></TD>
                                </TR>
                                <TR class='normaldetail'>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7>
                                        <Font color='RED'></font>25
                                    </TD>
                                    <TD bgcolor=#F0F7F7>มีคุณธรรม จริยธรรม ในการใช้เทคโนโลยี </TD><input type="hidden" name="D29" value="505" />
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice121" name="Q29" value="5" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice122" name="Q29" value="4" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice123" name="Q29" value="3" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice124" name="Q29" value="2" /></TD>
                                    <TD ALIGN=CENTER bgcolor=#F0F7F7><input type="radio" id="choice125" name="Q29" value="1" /></TD>
                                </TR>


                            </tbody>
                        </table>
                        <button type="submit" name="submit" class="btn btn-warning ">บันทึก</button><br>
                    </form>
                </div>
            </div>
        </div>
    </div>




</body>

</html>