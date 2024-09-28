<?php include('C:/xampp/htdocs/food-order/admin/config/constant.php');?>

<html>
    <head>
        <title>Login - Food Order</title>
        <link rel="stylesheet" href="./css/admin.css">
        
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
             
       if(isset($_SESSION['login']))
       {
        echo $_SESSION['login']; 
        unset($_SESSION['login']); 
       }

       if(isset($_SESSION['no-login-message']))
       {
        echo $_SESSION['no-login-message']; 
        unset($_SESSION['no-login-message']); 
       }
       ?>
       <br><br>

         <!-- Login Form -->

            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter password"> <br><br>
                

                <input type="submit" value="Login" name="submit" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form ends -->
            <p class="text-center">Created By - <a href="www.eshatmg.com.np">Esha Tamang</a></p>
        </div>
    </body>
</html>


<?php
//check whether the submit button clicked or not

if(isset($_POST['submit']))
{
    //process for login 
    //get data from Login form
    $username=$_POST['username'];
    $password=md5($_POST['password']);


    //create query to check whether the user with username and password exists or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";


    //execute query
    $res=mysqli_query($conn, $sql);

    //count rows to check whether the user exists or not

    $count = mysqli_num_rows($res);
        if($count==1){
       
           //user available and Login succeess
           $_SESSION['login'] = "<div class='success text-center'>Login Successful</div>";
           
           //check whether user is logged in or not
           $_SESSION['user']=$username;

           //redirect to homepage/dashboard
           header('location:'.SITEURL.'admin/');

        }

        else{
             //user does not exist set message and redirect
             $_SESSION['login']="<div class='error text-center'>Username or Password doesn't match</div>";
             header('location:'.SITEURL.'admin/login.php');


        }


}

?>