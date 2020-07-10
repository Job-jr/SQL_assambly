<?php

session_start();
$conn = new mysqli('localhost','root','','sql_assembly');

/* -------------------------------- Closebtn -------------------------------- */

if (isset($_GET['close-btn'])){
    header("location:javascript://history.go(-1)");
    exit; 
}

/* -------------------------------- Addmodel -------------------------------- */
 
if (isset($_GET['submit-addmodel-btn'])){
    
    $model = mysqli_real_escape_string($conn, $_GET['model']);
    $model_th = mysqli_real_escape_string($conn, $_GET['model_th']);
    $model_en = mysqli_real_escape_string($conn, $_GET['model_en']);

    $sql = "INSERT INTO model (mod_id, mod_nameTH, mod_nameEN) VALUES ('$model', '$model_th', '$model_en')";
    if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
header("Location: model.php");
exit; 
}

/* -------------------------------------------------------------------------- */

/* -------------------------------- AddSubmodel -------------------------------- */
 
if (isset($_GET['submit-addsubmodel-btn'])){
    
    $id_model = mysqli_real_escape_string($conn, $_GET['id_model']);
    $name_submodel_th = mysqli_real_escape_string($conn, $_GET['name_submodel_th']);
    $sub_axle = mysqli_real_escape_string($conn, $_GET['sub_axle']);

    $sql = "INSERT INTO submodel (mod_id, sub_name, sub_axle) VALUES ('$id_model', '$name_submodel_th', '$sub_axle')";
    if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
header("Location: model.php");
exit; 
}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Add customer ------------------------------ */

if (isset($_GET['submit-customer-btn'])){
    
    $cus_firstname = mysqli_real_escape_string($conn, $_GET['cus_firstname']);
    $cus_tel = mysqli_real_escape_string($conn, $_GET['cus_tel']);
    $cus_add = mysqli_real_escape_string($conn, $_GET['cus_add']);

    $sql = "INSERT INTO customer (cus_firstname, cus_tel, cus_add) VALUES ('$cus_firstname', '$cus_tel', '$cus_add')";
    if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
header("Location: customer.php");

}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Update customer ------------------------------ */

if (isset($_GET['submit-update-customer-btn'])){

    $sql = "UPDATE customer SET  
                cus_firstname = '".$_GET["txt_cus_firstname"]."' , 
                cus_add = '".$_GET["txt_cus_add"]."' ,
                cus_tel = '".$_GET["txt_cus_tel"]."' 
                WHERE cus_id ='".$_GET["txt_cus_id"]."' ";

        if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>";
            echo "window.location = 'customer.php'; ";
            echo "alert('Update Succesfuly');";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to Update again');";
            echo "</script>";
            }
}
/* -------------------------------------------------------------------------- */

/* ------------------------------ Del customer ------------------------------ */

if (isset($_GET['delete_cus'])){

    $id = $_GET['delete_cus'];
    $sql = "DELETE FROM customer WHERE cus_id=$id";
    echo $sql;
    if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>";
            echo "window.location = 'customer.php'; ";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to Update again');";
            echo "</script>";
            }
}
/* -------------------------------------------------------------------------- */

/* ------------------------------ Add technical ------------------------------ */

if (isset($_GET['submit-technical-btn'])){
    
   if(isset($_GET['tec_tel'])&& $_GET['tec_tel']!=''){
       $tec_tel = mysqli_real_escape_string($conn, $_GET['tec_tel']);
    } else{
        echo"ERROR: กรุณาใส่ชื่อช่าง";
        exit;
        }

    
    if(isset($_GET['tec_name'])&& $_GET['tec_name']!=''){
        $tec_name  = mysqli_real_escape_string($conn, $_GET['tec_name']);
    }else {
        echo"ERROR: กรุณาใส่ชื่อช่าง";
        exit;
    }

    if(isset($_GET['tec_skill_paint'])){
        $tec_skill_paint  = mysqli_real_escape_string($conn, 1 );
    }else {
        $tec_skill_paint  = mysqli_real_escape_string($conn, 0 );
    }

    if(isset($_GET['tec_skill_elec'])){
        $tec_skill_elec  = mysqli_real_escape_string($conn, 1 );
    }else {
        $tec_skill_elec  = mysqli_real_escape_string($conn, 0 );
    }

    if(isset($_GET['tec_skill_chassis'])){
        $tec_skill_chassis  = mysqli_real_escape_string($conn, 1 );
    }else {
        $tec_skill_chassis = mysqli_real_escape_string($conn, 0 );
    }

    if(isset($_GET['tec_skill_weld'])){
        $tec_skill_weld  = mysqli_real_escape_string($conn, 1 );
    }else {
        $tec_skill_weld = mysqli_real_escape_string($conn, 0 );
    }
   

    $sql = "INSERT INTO technical (tec_tel, tec_skill_weld, tec_skill_paint, tec_skill_chassis, tec_skill_elec,  tec_name) 
            VALUES ('$tec_tel', '$tec_skill_weld', '$tec_skill_paint', '$tec_skill_chassis', '$tec_skill_elec', '$tec_name')";

    if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
header("Location: technical.php");

}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Update technical ------------------------------ */

if (isset($_GET['submit-update-technical-btn'])){

    $sql = "UPDATE technical SET  
                tec_name = '".$_GET["txt_tec_name"]."' , 
                tec_tel = '".$_GET["txt_tec_tel"]."' ,
                tec_skill_paint = '".$_GET["txt_tec_skill_paint"]."' ,
                tec_skill_elec = '".$_GET["txt_tec_skill_elec"]."' ,
                tec_skill_chassis = '".$_GET["txt_tec_skill_chassis"]."' , 
                tec_skill_weld = '".$_GET["txt_tec_skill_weld"]."'  
                WHERE tec_id ='".$_GET["txt_tec_id"]."' ";

        if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>";
            echo "window.location = 'technical.php'; ";
            echo "alert('Update Succesfuly');";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to Update again');";
            echo "</script>";
            }

}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Del technical ------------------------------ */

if (isset($_GET['delete_tec'])){

    $id = $_GET['delete_tec'];
    $sql = "DELETE FROM technical WHERE tec_id=$id";
    echo $sql;
    if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>";
            echo "window.location = 'technical.php'; ";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to Update again');";
            echo "</script>";
            }
}
/* -------------------------------------------------------------------------- */

/* ------------------------------ Add user ------------------------------ */

if (isset($_GET['submit-user-btn'])){
    
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $use_password  = mysqli_real_escape_string($conn, $_GET['use_password']);
    $use_firstname = mysqli_real_escape_string($conn, $_GET['use_firstname']);
    $use_lastname = mysqli_real_escape_string($conn, $_GET['use_lastname']);
    $use_role = mysqli_real_escape_string($conn, $_GET['use_role']);

    $sql = "INSERT INTO user (user_id, use_password, use_firstname, use_lastname, use_role) 
            VALUES ('$user_id', '$use_password', '$use_firstname', '$use_lastname', '$use_role')";

    if(mysqli_query($conn, $sql)){
        echo "Records inserted successfully.";
    }
    else{
        echo "Not Records inserted successfully.";
    } 
    
header("Location: user.php");

}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Update user ------------------------------ */

if (isset($_GET['submit-update-user-btn'])){

    $conn = mysqli_connect('localhost','root','','sql_assembly');

    $sql = "UPDATE user SET  
                use_password = '".$_GET["txt_user_password"]."' , 
                use_firstname = '".$_GET["txt_use_firstname"]."' ,
                use_lastname = '".$_GET["txt_use_lastname"]."' ,
                use_role = '".$_GET["txt_use_role"]."'  
                WHERE user_id ='".$_GET["txt_user_id"]."' ";

    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo "<script type='text/javascript'>";
        echo "window.location = 'user.php'; ";
        echo "alert('อัพเดตเสร็จสมบูรณ์');";
        echo "</script>";
        }
        else{
        echo "<script type='text/javascript'>";
        echo "alert('Error back to Update again');";
        echo "</script>";
        }
    
}

/* -------------------------------------------------------------------------- */

/* ------------------------------ Del User ------------------------------ */

if (isset($_GET['delete_user'])){

    $id = $_GET['delete_user'];
    $sql = "DELETE FROM user WHERE user_id=$id";
    echo $sql;
    if(mysqli_query($conn, $sql)){
            echo "<script type='text/javascript'>";
            echo "window.location = 'user.php'; ";
            echo "</script>";
            }
            else{
            echo "<script type='text/javascript'>";
            echo "alert('Error back to Update again');";
            echo "</script>";
            }
}
/* -------------------------------------------------------------------------- */


exit;
?>