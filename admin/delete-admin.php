<?php

//include constant.php file
include('./config/constant.php');

//1.get ID of Admin to be deleted
 $id=$_GET['id'];

//2.Create SQL Query to delete Admin
$sql="DELETE from tbl_admin WHERE id=$id";

//execute query
$res=mysqli_query($conn,$sql);

//check whether query executed successfully or not
if($res==TRUE)
{
    //create a session variable to display message
    $_SESSION['delete']="<div class='success'>Admin deleted successfully";

    //redirect to manage-admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

  
}
else{
    $_SESSION['delete']="<div class='error'>Failed to delete admin</div>'";
    header('location:'.SITEURL.'admin/manage-admin.php');
} 


//3. Redirect to Manage ADmin page with message

?>