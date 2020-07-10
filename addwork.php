<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c181bfd09c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>เพิ่มงาน</title>
</head>

<body>
    <div class="container">

        <!-- ------------------------------- sidebar ------------------------------- -->

        <div class="sidebar">
            <header><img src="img/logo.png" width="170px" height="55px"></header>

            <div class="user">
                <h3>Admin</h3>
            </div>

            <ul class="nav-list">
                <li><a href="home.php"><i class="fas fa-file-alt fa-lg"></i>ตารางาน</a></li>
                <li><a href="addwork.php"><i class="fas fa-file-medical fa-lg"></i>เพิ่มงาน</a></li>
                <li><a href="historywork.php"><i class="fas fa-file fa-lg"></i>ประวัติงาน</a></li>
                <li><a href="historycar.php"><i class="fas fa-file fa-lg"></i>ประวัติรถ</a></li>
            </ul>
            <ul class="nav-list">
                <li><a href="model.php"><i class="fas fa-car fa-lg"></i>โมเดลรถ</a></li>
            </ul>
            <ul class="nav-list">
                <li><a href="customer.php"><i class="fas fa-id-card fa-lg"></i>ข้อมูลลูกค้า</a></li>
                <li><a href="technical.php"><i class="fas fa-id-card fa-lg"></i>ข้อมูลช่าง</a></li>
                <li><a href="user.php"><i class="fas fa-id-card fa-lg"></i>ข้อมูลบุคลากร</a></li>
            </ul>
            <ul class="nav-list">
                <li><a href="Summary.php"><i class="fas fa-chart-line fa-lg"></i>ผลสรุป</a></li>
                <li><a href="Summarywork.php"><i class="fas fa-chart-line fa-lg"></i>ผลการทำงาน</a></li>
            </ul>

            <div class="bottom-btn">
                <a href="index.php"><input type="button" class="btn-logout" value="ออกจากระบบ"></a>
            </div>
        </div>

        <!-- ----------------------------------------------------------------------- -->

        <!-- ------------------------------- header -------------------------------- -->

        <div class="header">
            <div class="title">
                <div class="title-text">
                    <h2>เพิ่มงาน</h2>

                </div>
            </div>
        </div>

        <!-- ----------------------------------------------------------------------- -->



        <!-- ------------------------------- content ------------------------------- -->

        <div class="content">
            <?php
            $conn = new mysqli('localhost', 'root', '', 'sql_assembly');
            if (empty($_REQUEST['user_id'])) {
                $user_id = '';
            } else {
                $user_id = $_REQUEST['user_id'];
            }
            if (empty($_REQUEST['id_model'])) {
                $model = '';
            } else {
                $model =  $_REQUEST['id_model'];
            }
    
            ?>
            <form name="add_work" action="addwork.php" method="GET" id="add_work">
                <div class="modal-body">
                    <ul>
                        <li>
                            <t>ชื่อลูกค้า*</t><i><input type="text" class="text" name="user_id" value="<?php echo $user_id ?>" required></i>

                        </li>
                        <!-- <li>
                            <t>รหัสติดตามสินค้า*</t><i><input type="text" class="text" name="" required></i>
                        </li> -->
                        <li>
                            รหัสโมเดลหลัก
                            <i>
                                <select name="id_model" class="select" id="id_model" style="width: 20%;" onchange="this.form.submit()">
                                    <?php if ($model == '')
                                        echo '<option value="" selected>โปรดเลือก</option>';
                                    else
                                        echo '<option value="">โปรดเลือก</option>';
                                    ?>

                                    <?php
                                    $sql = mysqli_query($conn, "SELECT mod_id FROM model");
                                    while ($row = $sql->fetch_assoc()) {
                                        if ($row['mod_id'] == $model)
                                            echo "<option value='" . $row['mod_id'] . "' selected >" . $row['mod_id'] . "</option>";
                                        else
                                            echo "<option value='" . $row['mod_id'] . "'>" . $row['mod_id'] . "</option>";
                                    }
                                    $sql->free_result();
                                    ?>
                                </select>
                            </i>

                            รหัสโมเดลย่อย
                            <i>
                                <select name="id_submodel" class="select" id="id_submodel" style="width: 20%;">
                                    <?php
                                     echo '<option value="" selected>โปรดเลือก</option>';
                                    $sql = mysqli_query($conn, "SELECT sub_name FROM submodel where mod_id = '$model' ");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value='" . $row['sub_name'] . "'>" . $row['sub_name'] . "</option>";
                                    }
                                    $sql->free_result();
                                    ?>
                                </select>
                            </i>
                        </li>
                        <!-- <li>
                            <t>รหัสรถเริ่มต้น*</t><i><input type="text" class="text" name="first-car_id " style="width:10%;" required></i>
                            จำนวนเพลา
                            <i>
                                <select name="sub_axle" id="" style="width : 10%; ">
                                    <option value="2">2 เพลา</option>
                                    <option value="3">3 เพลา</option>
                                </select>
                            </i>
                        </li>
                        <li>
                            <t>รายละเอียด</t><i><input type="text" class="text" name="" required></i>
                        </li>
                        <li>
                            <t>วันที่เปิดJOB*</t><i><input type="date" class="text" name="" style="width: 20%;" required></i>
                            วันกำหนดส่ง*<i><input type="date" class="text" name="" style="width: 20%;" required></i>
                        </li>
                        <li>
                            ช่างสี*
                            <i>
                                <select name="tec_id_paint" class="select" id="tec_id_paint" style="width: 20%;" required>

                                </select>
                            </i>

                            ช่างไฟ*
                            <i>
                                <select name="tec_id_elec" class="select" id="tec_id_elec" style="width: 20%;" required>

                                </select>
                            </i>
                        </li>
                        <li>
                            ช่างเหล็ก*
                            <i>
                                <select name="tec_id_weld" class="select" id="tec_id_weld" style="width: 20%;" required>

                                </select>
                            </i>

                            ช่างช่วงล่าง*
                            <i>
                                <select name="tec_id_chassis" class="select" id="tec_id_chassis" style="width: 20%;" required>

                                </select>
                            </i>
                        </li> -->
                        <input type="button" name="btSubmit" id="btSubmit" value="Submit" onclick="">
                    </ul>
                </div>
            </form>
        </div>
    </div>

    </div>

</body>

</html>

<?php
mysqli_close($conn);
?>