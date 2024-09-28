<?php
  

  //include constant.php for SITEURL
  include('C:/xampp/htdocs/food-order/admin/config/constant.php');

  //destroy the session 
  session_destroy();//unsets $_SESSION ['user']

  //Redirect to login page
  header('location:'.SITEURL.'admin/login.php');



?>