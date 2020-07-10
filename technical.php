<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
    <script src="https://kit.fontawesome.com/c181bfd09c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>โมเดลรถ</title>
</head>
<body>
    <div class="container">

<!-- ------------------------------- sidebar ------------------------------- -->

        <div class="sidebar">
            <header><img src="img/logo.png" width="170px" height="55px"></header>

            <div class="user"><h3>Admin</h3></div>

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
<?php
        $s = '';

        if (isset($_POST['tec_search'])) {
            $tec_search = $_POST['tec_search'];
            //echo $tec_search;
        } else {
            $tec_search = '';
        }

        $conn = new mysqli('localhost', 'root', '', 'sql_assembly');

        $s = '%' . $tec_search . '%'
?>
<!-- ------------------------------- header -------------------------------- -->

        <div class="header">
            <div class="title">
                <div class="title-text">
                    <h2>ข้อมูลช่าง</h2>
                    <div class="title-btn">
                        <button class="title-btn-01" onclick="openFormAddModel()">เพิ่มข้อมูลช่าง<i class="fas fa-plus" style="margin-left: 6px;"></i></button>
                        <form  method="post">
                            <input type="text" name="tec_search" />
                            <input type="submit" name="submit" id="submit" value="search"><br><br>
                        </form>
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
                        <th style="width: 200px">ชื่อช่าง</th>
                        <th style="width: 150px">เบอร์โทรศัพท์</th>
                        <th style="width: 100px">ช่างเชื่อม</th>
                        <th style="width: 100px">ช่างสี</th>
                        <th style="width: 100px">ช่างช่วงล่าง</th>
                        <th style="width: 100px">ช่างไฟ</th>
                        <th style="width: 100px">การกระทำ</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $conn = new mysqli('localhost','root','','sql_assembly');
                        $sql = mysqli_query($conn, "SELECT tec_id,tec_name, tec_tel, tec_skill_weld, tec_skill_paint, tec_skill_chassis, tec_skill_elec FROM technical where tec_name like '$s' or tec_tel like '$s'");
                        while ($row = $sql->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $row["tec_name"];?></td>
                                <td><?php echo $row["tec_tel"];?></td>
                        <?php
                                if($row["tec_skill_weld"] == 0){
                                    echo "<td><i class='fas fa-times'></i></td>";
                                }else{
                                    echo "<td><i class='fas fa-check'></i></td>";
                                }

                                if($row["tec_skill_paint"] == 0){
                                    echo "<td><i class='fas fa-times'></i></td>";
                                }else{
                                    echo "<td><i class='fas fa-check'></i></td>";
                                }

                                if($row["tec_skill_chassis"] == 0){
                                    echo "<td><i class='fas fa-times'></i></td>";
                                }else{
                                    echo "<td><i class='fas fa-check'></i></td>";
                                }

                                if($row["tec_skill_elec"] == 0){
                                    echo "<td><i class='fas fa-times'></i></td>";
                                }else{
                                    echo "<td><i class='fas fa-check'></i></td>";
                                }
                        ?>
                                <td>
                                    <a href=technical_edit.php?tec_id=<?php echo $row["tec_id"];?>">
                                    <i class='fas fa-pencil-alt' style='font-size:20px;color:green;margin: 0px 20px 0px 0px'></i></a>

                                    <a href="get_DB.php?delete_tec=<?php echo $row["tec_id"];?>" onclick="return confirm('ต้องการลบข้อมูลหรือไม่ !'); " >
                                    <i class='fas fa-trash-alt' style='font-size:20px;color:red;margin: 0px 15px 0px 0px'></i></a>
                                </td>
                            </tr>
                        <?php } ?>                   
                
                <?php
                mysqli_close($conn);
                ?>
                </tbody>
            </table>    
        </div>
            
                
                <!-- -------------------------------- add technical --------------------------------- -->

            <div class="form-modal">
                <form action="get_DB.php" id="add-technical" class="modal">
                    <div class="modal-dialog">
                        <section class="modal-content">
                            <header class="modal-header">
                                <h3 class="modal-title">เพิ่มข้อมูลช่าง</h3>
                                <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddModel()" name="close-btn"><i class="fas fa-times"></i></button>
                            </header>
                                <div class="modal-body">
                                    <ul>
                                        <li><t>ชื่อช่าง</t><i><input type="text" class="text" name="tec_name" required="" oninvalid="this.setCustomValidity('กรุณาใส่ชื่อช่าง')"oninput="setCustomValidity('')"></i></li>
                                        <li><t>เบอร์โทรศัพท์</t><i><input type="text" class="text" name="tec_tel" required="" oninvalid="this.setCustomValidity('กรุณาใส่เบอร์โทร')"oninput="setCustomValidity('')"></i></li>
                                        <li><t>ทักษะ</t>
                                            <input class="checkbox" type="checkbox" value="1" name="tec_skill_paint">
                                            <label class="text-checkbox-1">ช่างสี</label>
                                            <input class="checkbox" type="checkbox" value="1" name="tec_skill_elec">
                                            <label class="text-checkbox">ช่างไฟ</label>
                                        </li>
                                        <li><t style="color: #fff;">ฟ </t>
                                            <input class="checkbox" type="checkbox" value="1" name="tec_skill_chassis">
                                            <label class="text-checkbox">ช่างช่วงล่าง</label>
                                            <input class="checkbox" type="checkbox" value="1" name="tec_skill_weld">
                                            <label class="text-checkbox">ช่างเหล็ก</label>
                                        </li>
                                        
                                    </ul>
                                </div>
                            <footer class="modal-footer">
                                <div class="footer-btn">
                                    <input class="modal-btn-01 "type="submit" value="บันทึก" name="submit-technical-btn">
                                </div>
                            </footer>
                        </section>
                    </div>
                </form>
            </div>            
        </div>
        
            
    </div>

<!-- --------------------------------- .js --------------------------------- -->

<script>

    function openFormAddModel() {
      document.getElementById("add-technical").style.display = "block";
    }
  
    function closeFormAddModel() {
      document.getElementById("add-technical").style.display = "none";
    }

  

    
    

    
    
    
</script>
    

</body>
</html>