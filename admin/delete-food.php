<?php
include('C:/xampp/htdocs/food-order/admin/config/constant.php');

//check whether value is passed on URL or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //process to delete
    //1.get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //2.remove the image if available
    //check whether the imageis available or not and delete only if available
    if($image_name!="")
    {
        //It has image and need to remove from folder
        //get the image path
        $path="C:/xampp/htdocs/food-order/images/food/".$image_name;

        //remove image file from folder
        $remove=unlink($path);

        //check whether image is successfully remove or not
        if($remove==false)
        {
           //failed to remove image
           $_SESSION['upload']="<div class='error'>Failed to Remove Image File</div>";
           header("location:".SITEURL."admin/manage-food.php");
           die();
        }
        else{

        }
    }

    //3.delete food from database
    //create sql query
    $sql="DELETE FROM tbl_food WHERE id='$id'";

    //execute query
    $res=mysqli_query($conn,$sql);

     //check whether query executed or not and set the session message 
     //4.redirect to manage food  page with session message
     if($res==true)
     {
         //food deleted
         $_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
         header("location:".SITEURL."admin/manage-food.php");
 
 
     }
     else{
         //failed to delete
         $_SESSION['delete']="<div class='error'>Failed to Delete Food</div>";
         header("location:".SITEURL."admin/manage-food.php");
 
     }
}

else{
    //redirect to manage food page
    $_SESSION['unauthorize']="<div class='error'>Unauthorized Access</div>";
    header("location:".SITEURL."admin/manage-food.php");
}
?>