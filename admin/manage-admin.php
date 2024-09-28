<?php include('../admin/partials/menu.php')?>;

    <!-- Main content-->
    <div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/>

        <?php
       if(isset($_SESSION['add']))
       {
        echo $_SESSION['add']; //Displaying session message
        unset($_SESSION['add']);  //Removing session message
       }

      
       if(isset($_SESSION['delete']))
       {
        echo $_SESSION['delete']; //Displaying session message
        unset($_SESSION['delete']);  //Removing session message
       }


        
       if(isset($_SESSION['update']))
       {
        echo $_SESSION['update']; //Displaying session message
        unset($_SESSION['update']);  //Removing session message
       }

       if(isset($_SESSION['user not found']))
       {
        echo $_SESSION['user not found']; //Displaying session message
        unset($_SESSION['user not found']);  //Removing session message
       }

       
       if(isset($_SESSION['pwd-not-match']))
       {
        echo $_SESSION['pwd-not-match']; 
        unset($_SESSION['pwd-not-match']); 
       }

       if(isset($_SESSION['change-pwd']))
       {
        echo $_SESSION['change-pwd']; 
        unset($_SESSION['change-pwd']); 
       }


       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $errors = [];

        // Validation
        if (empty($full_name)) {
            $errors[] = "Full Name is required.";
        }

        if (empty($username)) {
            $errors[] = "Username is required.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        if (empty($errors)) {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
            // Proceed with adding to the database
            $stmt = $conn->prepare("INSERT INTO tbl_admin (full_name, username) VALUES (?, ?)");
            $stmt->bind_param("ss", $full_name, $username);

            if ($stmt->execute()) {
                $_SESSION['add'] = "<div class='success'> Admin added successfully.</div>";
                header("location:".SITEURL.'admin/manage-admin.php'); // Redirect to manage-admin
            } 
            else {
                echo "Error adding admin: " . $stmt->error;
            }

            $stmt->close();
        } 
        else {
            // Display errors
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
    }
      


        ?>

        <br><br><br>

        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <br><br><br>
        

        <table class='tbl-full'>
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>


            <?php
            //query to select/get all admins 
             $sql="SELECT * FROM tbl_admin";

             //execute query
             $res=mysqli_query($conn,$sql);

             //check whether the query is executed or not
             if($res==TRUE)
             {
                //count rows to check whether we have data in databse or not
                $count=mysqli_num_rows($res);//function to get all the rows in database

                //$sn=1;//create a variable and assign value

                //check the num of rows
                if($count>0)
                {
                   while($rows=mysqli_fetch_assoc($res))
                   {
                   //using while loop to get all data from database
                   
                   //get individual data
                   //left--column name,right---variable
                   $id=$rows['id'];
                   $full_name=$rows['full_name'];
                   $username=$rows['username'];

                   //display values in table
                   ?>

                   
                      <tr>
                       <td><?php echo $id;?></td>
                        <td><?php echo $full_name;?></td>
                       <td><?php echo $username;?></td>
                      <td>
                       <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                       <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                       <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                     </td>
                     </tr>

                   <?php

                }
            }


                else{
                    echo "<tr><td colspan='4'>No Admin Found</td></tr>";
                }

             }

            ?>
        </table>

        
        </div>

        
    </div>
    <!--Main content -->

    <?php include("../admin/partials/footer.php")?>;

</body>
</html>
