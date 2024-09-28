<?php include('../admin/partials/menu.php')?>;

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                <td>Old Password:</td>
                <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>


                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit"name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
//check whether submit button is clicked or not
if(isset($_POST['submit']))
{

    //get data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);



    //check whether user with current ID and current password exists or not

    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // execute Query
    $res=mysqli_query($conn,$sql);

    if($res==true)
    {
        //check whether data available or not
        $count=mysqli_num_rows($res);

        if($count==1){

            //check whether newpassword and confirm password matches or not
        if($new_password == $confirm_password)
            {
                // Update the password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true)
                {
                    // Success, redirect with success message
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    // Failed to update password
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                // Passwords do not match
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        else{
             //user does not exist set message and redirect
             $_SESSION['user not found']="<div class='error'>User Not Found.</div>";
             header('location:'.SITEURL.'admin/manage-admin.php');


        }


    }

}
?>
<?php include("../admin/partials/footer.php")?>;


