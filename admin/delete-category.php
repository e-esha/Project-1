
<!-- //include constant.php file -->
<?php include('./config/constant.php');?>
<?php

//check whether id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //get value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove physical image file if available
    if($image_name!="")

    {
        //image is available then remove it
        $path="../images/category/".$image_name;


        //remove image
        $remove=unlink($path);

        //if failed to remove image then add an error message and stop process
        if($remove==false)
        {
            //set the session message
            $_SESSION['remove']="<div class='error'>Failed to Remove Category Image</div>";

            //redirect to manage category page 
            header('location:'.SITEURL.'admin/manage-category.php');

            //stop the process
            die();

        }
    }

    //delete data from database
    $sql="DELETE FROM tbl_category WHERE id=$id";

    //execute query
    $res=mysqli_query($conn,$sql);

    //check whether data is delete from database or not
    if($res==true)
    {
        //set success message and redirect
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
        header("location:".SITEURL."admin/manage-category.php");


    }
    else{
        //set failed message and redirect
        $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";
        header("location:".SITEURL."admin/manage-category.php");

    }

    //redirect to  manage-category page with message
    


}
else
{
  //redirect to manage-category page
  header("location:".SITEURL."admin/manage-category.php");
}






?>
