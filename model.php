<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script src="https://kit.fontawesome.com/c181bfd09c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>โมเดลรถ</title>
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
                    <h2>โมเดลรถ</h2>
                    <div class="title-btn">
                        <button class="title-btn-01" onclick="openFormAddModel()">เพิ่มโมเดลหลัก<i class="fas fa-plus" style="margin-left: 6px;"></i></button>
                        <button class="title-btn-01" onclick="openFormAddSubModel()">เพิ่มโมเดลย่อย<i class="fas fa-plus" style="margin-left: 6px;"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----------------------------------------------------------------------- -->

        <!-- ------------------------------- content ------------------------------- -->
        <div class="content">
            <div class="content-data">
                <table>
                    <thead>
                        <tr>
                            <th>โมเดลหลัก</th>
                            <th>โมเดลย่อย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmp = "";
                        $conn = new mysqli('localhost', 'root', '', 'sql_assembly');
                        $sql = mysqli_query($conn, "SELECT mod_id, sub_name FROM submodel ORDER BY mod_id, sub_name");
                        while ($row = $sql->fetch_assoc()) {
                            if ($stmp == $row["mod_id"]) {
                                echo "<tr>
                                    <td></td>
                                    <td>" . $row["sub_name"] . "</td>
                                    </tr>";
                            } else {
                                $stmp = $row["mod_id"];
                                echo "<tr>
                                    <td>" . $row["mod_id"] . "</td>
                                    <td>" . $row["sub_name"] . "</td>
                                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="form-modal">

                <!-- -------------------------------- add model --------------------------------- -->

                <form action="get_DB.php" id="add-model" class="modal">
                    <div class="modal-dialog">
                        <section class="modal-content">
                            <header class="modal-header">
                                <h3 class="modal-title">เพิ่มโมเดลหลัก</h3>
                                <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddModel()" name="close-btn"><i class="fas fa-times"></i></button>
                            </header>
                            <div class="modal-body">
                                <ul>
                                    <li>
                                        <t>รหัสโมเดลหลัก</t><i><input type="text" class="text" name="model"></i>
                                    </li>
                                    <li>
                                        <t>ชื่อโมเดล(TH)</t><i><input type="text" class="text" name="model_th"></i>
                                    </li>
                                    <li>
                                        <t>ชื่อโมเดล(EN)</t><i><input type="text" class="text" name="model_en"></i>
                                    </li>
                                </ul>
                            </div>
                            <footer class="modal-footer">
                                <div class="footer-btn">
                                    <button class="modal-btn-02" onclick="btntosubmodel()" type="button">เพิ่มโมเดลย่อย</button>
                                    <input class="modal-btn-01 " type="submit" value="บันทึก" name="submit-addmodel-btn">
                                </div>
                            </footer>
                        </section>
                    </div>
                </form>

                <!-- -------------------------------- add sub model --------------------------------- -->

                <form action="get_DB.php" id="add-sub-model" class="modal">
                    <!-- -------------------------------- Step1 --------------------------------- -->
                    <div class="modal-tab" id="step1">
                        <div class="modal-dialog">
                            <section class="modal-content">
                                <header class="modal-header">
                                    <h3 class="modal-title">เพิ่มโมเดลย่อย</h3>
                                    <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddSubModel()" name="close-btn"><i class="fas fa-times"></i></button>
                                </header>
                                <div class="modal-body">
                                    <ul>
                                        <li>
                                            <t>รหัสโมเดลหลัก</t>
                                            <i>
                                                <select name="id_model" class="select" id="select-01" style="width: 40%;">
                                                    <?php
                                                    $conn = new mysqli('localhost', 'root', '', 'sql_assembly');
                                                    $sql = mysqli_query($conn, "SELECT mod_id FROM model");
                                                    while ($row = $sql->fetch_assoc()) {
                                                        echo "<option value='" . $row['mod_id'] . "'>" . $row['mod_id'] . "</option>";
                                                    }
                                                    $sql->free_result();
                                                    ?>
                                                </select>
                                                <button class="modal-btn-03" onclick="btntoaddmodel()" type="button">เพิ่มโมเดลหลัก</button>
                                            </i>
                                        </li>
                                        <li>
                                            <t>ชื่อโมเดลย่อย(TH)</t><i><input type="text" class="text" name="name_submodel_th"></i>
                                        </li>
                                        <li>
                                            <t>จำนวนเพลา</t>
                                            <a>
                                                <input type="radio" class="radio" name="sub_axle" value="2"> 2 เพลา
                                                <input type="radio" class="radio" name="sub_axle" value="3"> 3 เพลา
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <footer class="modal-footer">
                                    <div class="footer-btn">
                                        <input class="modal-btn-01" type="submit" value="บันทึก" name="submit-addsubmodel-btn">
                                        <button class="modal-btn-01" id="next-btn" type="button">ต่อไป</button>
                                    </div>
                                </footer>
                            </section>
                        </div>
                    </div>

                    <!-- -------------------------------- Step2 --------------------------------- -->

                    <div class="modal-tab" id="step2">
                        <div class="modal-dialog">
                            <section class="modal-content-01">
                                <header class="modal-header">
                                    <h3 class="modal-title">เพิ่มโมเดลย่อย</h3>
                                    <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddSubModel()" name="close-btn"><i class="fas fa-times"></i></button>
                                </header>
                                <div class="modal-body">
                                    ##
                                </div>
                                <footer class="modal-footer">
                                    <div class="footer-btn">
                                        <button class="modal-btn-02" id="per-btn" type="button">ย้อนกลับ</button>
                                        <input class="modal-btn-01" type="submit" value="บันทึก" name="submit-addsubmodel-btn">
                                    </div>
                                </footer>
                            </section>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <!-- --------------------------------- .js --------------------------------- -->

    <script>
        function openFormAddModel() {
            document.getElementById("add-model").style.display = "block";
        }

        function openFormAddSubModel() {
            document.getElementById("add-sub-model").style.display = "block";
        }

        function closeFormAddModel() {
            document.getElementById("add-model").style.display = "none";
        }

        function closeFormAddSubModel() {
            document.getElementById("add-sub-model").style.display = "none";
        }

        function btntosubmodel() {
            document.getElementById("add-model").style.display = "none";
            document.getElementById("add-sub-model").style.display = "block";
        }

        function btntoaddmodel() {
            document.getElementById("add-sub-model").style.display = "none";
            document.getElementById("add-model").style.display = "block";
        }

        var v = $("#add-sub-model").validate({});

        $("#next-btn").click(function() {
            if (v.form()) {
                $(".modal-tab").hide();
                $("#step2").fadeIn(500);
            }
        });

        $("#per-btn").click(function() {
            if (v.form()) {
                $(".modal-tab").hide();
                $("#step1").fadeIn(500);
            }

            $(".modal-btn-close").click(function() {
                var url = "model.php";
                $(location).attr('href', url);
            });
        });
    </script>


</body>

</html>