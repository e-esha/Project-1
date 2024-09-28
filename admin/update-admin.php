<?php include('../admin/partials/menu.php')?>;
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

       
        <br><br>

        <?php
        //get ID of selected Admin
        $id=$_GET['id'];

        //Create SQL Query to get details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";

        //execute query
        $res=mysqli_query($conn,$sql);

        //check whether query executed or not
        if($res==TRUE)
        {
            //check whether data is available or not
            $count=mysqli_num_rows($res);

            //check whether data is available or not
            if($count==1)
            {
              //get details
              $row=mysqli_fetch_assoc($res);

              $full_name=$row['full_name'];
              $username=$row['username'];
            
            }
            else{
                //redirect to manage-admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }

        else{

        }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username?>"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
           
         </table>
        </form>
</div>
</div>


<?php

//check whether submit is clicked or not
if(isset($_POST['submit']))
{

    //get all values from form to update 
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    //sql query to update admin
    $sql="UPDATE tbl_admin SET 
    full_name='$full_name',
    username='$username'

    WHERE id='$id'
    ";

    //execute query
    $res=mysqli_query($conn,$sql);

    ///check whether query executed successfully or not
    if($res==TRUE)
    {
        //query executed and admin updated
        $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

    else{
        //failed to update admin
        $_SESSION['update']="<div class='error'>Failed to update admin </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    
}

?>
<?php include("../admin/partials/footer.php")?>;