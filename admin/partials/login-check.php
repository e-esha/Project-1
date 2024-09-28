


<?php

//check whether user is logged in or not
//Authorization

if(!isset($_SESSION['user']))
{
   //user is not logged in
   
   $_SESSION['no-login-message']="<div class='request text-center'>Please login to access admin panel</div>";

   //redirect to login page with message
   header('location:'.SITEURL.'admin/login.php');
}

?>