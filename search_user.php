

<?php
$s = '';
$conn = new mysqli('localhost','root','','sql_assembly');
$use_search = $_POST['use_search'];
$s = '%'.$use_search.'%'

?>

<div class="header">
            <div class="title">
                <div class="title-text">
                    <h2>ข้อมูลบุคลากร</h2>
                    <div class="title-btn">

                        <form action="search.php" method="post">
                        <input type="text" name="use_search" />
                        <input type="submit" name="submit" id="submit" value="search"><br><br>
                        </form>
                    
                    </div>
                </div>
            </div>
        </div>

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
                    $sql = mysqli_query($conn, "SELECT user_id, use_firstname, use_lastname, use_role FROM user Where user_id like '$s'");
                    while ($row = $sql->fetch_assoc()){
                        echo "<tr>
                            <td>". $row["user_id"]."</td>
                            <td>". $row["use_firstname"]."</td>
                            <td>". $row["use_lastname"]."</td>";

                            if($row["use_role"] == 'A'){
                                echo "<td>Admin</td>";
                            }
                            if($row["use_role"] == 'U'){
                                echo "<td>User</td>";
                            }
                            if($row["use_role"] == 'R'){
                                echo "<td>ReadOnly</td>";
                            }
                            echo "<td>";
                                echo "<button onclick=\"JavaScript:openFormAddModel_1('".$row["user_id"]."')\"> <i class='fas fa-pencil-alt' style='font-size:20px;color:green;margin: 0px 20px 0px 0px'></i></button>";
                                
                            echo "</td>";    
                            echo "   
                            </tr>";
                    }
                    echo "</table>"
                   ?>
                </tbody>
               </table> 
            </div>