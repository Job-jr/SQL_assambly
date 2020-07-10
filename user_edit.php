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

<!-- ------------------------------- header -------------------------------- -->

        <div class="header">
            <div class="title">
                <div class="title-text">
                    <h2>ข้อมูลบุคลากร</h2>
                    <div class="title-btn">
                        <button class="title-btn-01" onclick="openFormAddModel()">เพิ่มข้อมูลบุคลากร<i class="fas fa-plus" style="margin-left: 6px;"></i></button>
                        <button class="title-btn-02" >ค้นหา<i class="fas fa-search" style="margin-left: 6px;"></i></button>
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
                       <th style="width: auto">ชื่อผู้ใช้</th>
                       <th style="width: auto">ชื่อ</th>
                       <th style="width: auto">นามสกุล</th>
                       <th style="width: auto">สิทธิ์</th>
                       <th style="width: auto">การกระทำ</th>
                   </tr>
                </thead>
                <tbody>
                   <?php
                    $conn = new mysqli('localhost','root','','sql_assembly');
                    $sql = mysqli_query($conn, "SELECT user_id, use_firstname, use_lastname, use_role FROM user");
                    while ($row = $sql->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?php echo $row["user_id"];?></td>
                            <td><?php echo $row["use_firstname"];?></td>
                            <td><?php echo $row["use_lastname"];?></td>
                            <?php
                                if($row["use_role"] == 'A'){
                                    echo "<td>Admin</td>";
                                }
                                if($row["use_role"] == 'U'){
                                    echo "<td>User</td>";
                                }
                                if($row["use_role"] == 'R'){
                                    echo "<td>ReadOnly</td>";
                                }
                            ?>
                            <td><a href="edit_user_1.php?user_id=<?php echo $row["user_id"];?>"><i class='fas fa-pencil-alt' style='font-size:20px;color:green;margin: 0px 20px 0px 0px'></i></a></td> 
                        </tr>
                    <?php } ?>                   
                </table>
                <?php
                mysqli_close($conn);
                ?>
                </tbody>
               </table> 
            </div>
                
<!-- -------------------------------- add user --------------------------------- -->

            <div class="form-modal">
                <form action="get_DB.php" id="add-user" class="modal">
                    <div class="modal-dialog">
                        <section class="modal-content">
                            <header class="modal-header">
                                <h3 class="modal-title">เพิ่มข้อมูลบุคลากร</h3>
                                <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddModel()" name="close-btn"><i class="fas fa-times"></i></button>
                            </header>
                                <div class="modal-body">
                                    <ul>
                                        <li><t>ชื่อผู้ใช้</t><i><input type="text" class="text" name="user_id" required></i></li>
                                        <li><t>รหัสผ่าน</t><i><input type="text" class="text" name="use_password" required></i></li>
                                        <li><t>ชื่อ</t><i><input type="text" class="text" name="use_firstname"></i></li>
                                        <li><t>นามสกุล</t><i><input type="text" class="text" name="use_lastname"></i></li>
                                        <li><t>สิทธิ์การใช้งาน</t>
                                            <i>
                                                <select name="use_role" class="select" >
                                                    <option selected="selected">โปรดเลือก</option>
                                                    <option value="A">Admin</option>
                                                    <option value="U">User</option>
                                                    <option value="R">Read only</option>
                                                </select>
                                            </i>
                                        </li>
                                        
                                    </ul>
                                </div>
                            <footer class="modal-footer">
                                <div class="footer-btn">
                                    <input class="modal-btn-01 "type="submit" value="อัพเดต" name="submit-user-btn">
                                </div>
                            </footer>
                        </section>
                    </div>
                </form>
            </div>

              
                        <!-- -------------------------------- edituser --------------------------------- -->

            <?php

            $conn = new mysqli('localhost','root','','sql_assembly');  
            $struser_id = null;

            if(isset($_GET["user_id"])){
                $struser_id = $_GET["user_id"];
            } 

            $sql = "SELECT * FROM user WHERE user_id =  '".$struser_id."' ";
            $query = mysqli_query($conn,$sql);
            $result=mysqli_fetch_array($query,MYSQLI_ASSOC);

            ?>


            <div class="form-modal">
                <form action="get_DB.php" class ="modal-1" method="get" >
                    <div class="modal-dialog">
                        <section class="modal-content">
                            <header class="modal-header">
                                <h3 class="modal-title">แก้ไขข้อมูลบุคลากร</h3>
                                <a class="modal-btn-close" href="user.php"><i class="fas fa-times"></i></a>
                            </header>
                                <div class="modal-body">  
                                    <ul>
                                    <input type="hidden" name="txt_user_id" class="text" value="<?php echo $result["user_id"]; ?>">
                                        <li><t>ชื่อผู้ใช้</t><i><input type="text" class="text" name="txt_user_id" value="<?php echo $result["user_id"];?>" required></i></li>
                                        <li><t>รหัสผ่าน</t><i><input type="text" class="text" name="txt_user_password" value="<?php echo $result["use_password"];?>" required></i></li>
                                        <li><t>ชื่อ</t><i><input type="text" class="text" name="txt_use_firstname" value="<?php echo $result["use_firstname"];?>"> </i></li>
                                        <li><t>นามสกุล</t><i><input type="text" class="text" name="txt_use_lastname" value="<?php echo $result["use_lastname"];?>"> </i></li>
                                        <li><t>สิทธิ์การใช้งาน</t>
                                            <i>
                                                <select name="txt_use_role" class="select" value="<?php echo $result["use_role"];?>">
                                                    <option selected="selected"><?php echo $result["use_role"];?></option>
                                                    <option value="A">Admin</option>
                                                    <option value="U">User</option>
                                                    <option value="R">Read only</option>
                                                </select>
                                            </i>
                                        </li>   
                                    </ul>
                                </div>
                            <footer class="modal-footer">
                                <div class="footer-btn">
                                    <input class="modal-btn-01 "type="submit" value="อัพเดต" name="submit-update-user-btn">
                                </div>    
                            </footer>
                        </section>
                    </div>
                </form>
            </div> 
            <?php
                mysqli_close($conn);
            ?> 

        </div>
        
            
    </div>

<!-- --------------------------------- .js --------------------------------- -->

<script>

    function openFormAddModel() {
      document.getElementById("add-user").style.display = "block";
    }
  
    function closeFormAddModel() {
      document.getElementById("add-user").style.display = "none";
    }
  
    function closeFormAddModel_1() {
      document.getElementById("add-update-user").style.display = "none";
    }
    
</script>
    

</body>
</html>