<?php include('../admin/partials/menu.php')?>;


<div class="main-content">
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset ($_SESSION['add']);

        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);

        }
        ?>

        <br><br>


        <!-- Add category form starts -->

       <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" placeholder="Category Title"></td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td><input type="file" name="image"></td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td><input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
                </td>
            </tr>
        
            <tr>
            <td>Active:</td>

             <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
            </tr>

            <tr>
                <td colspan="2"><input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
            </tr>
        </table>
        
        
       </form>


        <!-- Add category form ends -->

        <?php
        //check whether submit button clicked or not

        if(isset($_POST['submit']))
        {
            //get value from category form
            $title=$_POST['title'];

            //for radio type,check whetheer button is selected or not
            if(isset($_POST['featured']))
            {
                //get value from form
                $featured=$_POST['featured'];
            }
            else{
                //set default value
                $featured="No";
            }


            //for radio type,check whetheer button is selected or not
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                //set default value
                $active="No";
            }

            //check whether image selected or not and set the value for image name
            //accordingly
             // print_r($_FILES['image']);

            //die();//breaks code here

            if(isset($_FILES['image']['name']))
            {
                 //upload image
                 $image_name=$_FILES['image']['name'];

                 //upload image only if image is selected
                 if($image_name!="")
                 {
                 //auto rename our image
                 //get the extension of image(jpg,png,gif etc)
                 $ext= end(explode('.',$image_name));


                 //rename image
                 $image_name="Food_Category_".rand(000,999).'.'.$ext;
                 
                 //to upload image we needimage name, source and destination path
                 $source_path=$_FILES['image']['tmp_name'];

                 $destination_path="../images/category/".$image_name;

                 //uploading image
                 $upload=move_uploaded_file($source_path,$destination_path);


                 //check whether image is uploaded or not
                 //if image is not uploaded then process will stop and redirects with error message
                 if($upload==false)
                 {
                    //set message
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";

                    //redirect to category page
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                 }
                }

            } 

            else{
                //not upload image and set image_name as blank
                $image_name="";
            }

            //create query to insert category into database
            $sql="INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'

            ";

            //execute query an save in database
            $res=mysqli_query($conn,$sql);

            //check whether query executed or not and data added or not
            if($res==true)
            {
                //query executed and category added
                $_SESSION['add']="<div class='success'>Category Added Successfully</div>";

                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                //failed to add category
                $_SESSION['add']="<div class='error'>Failed to add category</div>";

                header('location:'.SITEURL.'admin/add-category.php');
            }

            
        }
        ?>
    </div>
</div>






<?php include("../admin/partials/footer.php")?>;