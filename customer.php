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
                    <h2>ข้อมูลลูกค้า</h2>
                    <div class="title-btn">
                        <button class="title-btn-01" onclick="openFormAddModel()">เพิ่มข้อมูลลูกค้า<i class="fas fa-plus" style="margin-left: 6px;"></i></button>
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
                            <th style="width: 300px">ชื่อลูกค้า</th>
                            <th style="width: 100px">เบอร์โทรศัพท์</th>
                            <th style="width: 500px">ที่อยู่</th>
                            <th style="width: 100px">การกระทำ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $conn = new mysqli('localhost','root','','sql_assembly');
                            $sql = mysqli_query($conn, "SELECT * FROM customer");
                            while ($row = $sql->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?php echo $row["cus_firstname"];?></td>
                                <td><?php echo $row["cus_tel"];?></td>
                                <td><?php echo $row["cus_add"];?></td>
                                <td>
                                    <a href="customer_edit.php?cus_firstname=<?php echo $row["cus_firstname"];?>">
                                    <i class='fas fa-pencil-alt' style='font-size:20px;color:green;margin: 0px 15px 0px 0px'></i></a>

                                    <a href="get_DB.php?delete_cus=<?php echo $row["cus_id"];?>" onclick="return confirm('ต้องการลบข้อมูลหรือไม่ !'); " >
                                    <i class='fas fa-trash-alt' style='font-size:20px;color:red;margin: 0px 15px 0px 0px'></i></a>

                                </td>    
                            </tr>
                        <?php } ?> 
                        </tbody>
                </table>   
            </div>
            
                
                <!-- -------------------------------- add customer --------------------------------- -->
            
            <div class="form-modal">                   
                <form action="get_DB.php" id="add-customer" class="modal">
                    <div class="modal-dialog">
                        <section class="modal-content">
                            <header class="modal-header">
                                <h3 class="modal-title">เพิ่มข้อมูลลูกค้า</h3>
                                <button id="close-btn-1" class="modal-btn-close" onclick="closeFormAddModel()" name="close-btn"><i class="fas fa-times"></i></button>
                            </header>
                                <div class="modal-body">
                                    <ul>
                                        <li><t>ชื่อลูกค้า</t><i><input type="text" class="text" name="cus_firstname"></i></li>
                                        <li><t>ที่อยู่</t><i><textarea id="" cols="num" rows="num" name="cus_add" ></textarea></i></li>
                                        <li><t>เบอร์โทรศัพท์</t><i><input type="text" class="text" name="cus_tel"></i></li>
                                    </ul>
                                </div>
                            <footer class="modal-footer">
                                <div class="footer-btn">
                                    <input class="modal-btn-01 "type="submit" value="บันทึก" name="submit-customer-btn">
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
      document.getElementById("add-customer").style.display = "block";
    }
  
    function closeFormAddModel() {
      document.getElementById("add-customer").style.display = "none";
    }


</script>
    

</body>
</html>