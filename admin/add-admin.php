<?php include('../admin/partials/menu.php')?>;


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether session is set or not
        {
            echo $_SESSION['add'];//displaying session message if set
            unset ($_SESSION['add']);// rmeoving session message 
        }

        ?>
        <form action="" method="POST">
         <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your name"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></td>
            </tr>
           
         </table>

         </form>
    </div>
</div>

<?php include("../admin/partials/footer.php")?>;


<?php
//Process value from form and save it in database
//Cheeck whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //Get data from form

    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);  //password encryption


    //SQL QUERY TO SAVE DATA INTO DATABASE  --left=column names right=values from form-- 
    $sql="INSERT INTO tbl_admin SET
    full_name='$full_name',  
    username='$username',
    password='$password'
    ";


//EXECUTING QUERY AND SAVING DATA INTO DATABASE
 $res=mysqli_query($conn,$sql) or die(mysqli_error($conn)); //query execution code


 //check whether(Query is executed) data is inserted or not and display qppropriate message
 if($res==TRUE)
 {
    //create a session variable to display message
    $_SESSION['add']="Admin added successfully";

    //Redirect page to manage admin
   
    header("location:".SITEURL.'admin/manage-admin.php');
 }
 
 else{
    //create a session variable to display message
    $_SESSION['add']="Failed to add admin";

    //Redirect page to manage admin
   
    header("location:".SITEURL.'admin/add-admin.php');
 }


}


?>