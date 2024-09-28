<?php include('../admin/partials/menu.php')?>;
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Title of the food">
                </td>
            </tr>
            

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description" placeholder="Description of the food" cols="30" rows="5"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td>
                   
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>       
            </tr>

            <tr>
                <td>Category:</td>
                <td><select name="category">

                <?php

                //create PHP code to display categories from database
                // 1.create sqlquery to get all active categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                $res=mysqli_query($conn, $sql);

                //count rows to check whether we have categories or not
                $count=mysqli_num_rows($res);
                
                //if count>0 we have categories else we don't have
                if($count>0)
                {
                    //we have categories
                    while($row=mysqli_fetch_assoc($res))

                    {
                        //get the details of categories
                        $id=$row['id'];
                        $title=$row['title'];
                        ?>
                       
                       <option value="<?php echo $id?>"><?php echo $title;?></option>
                  
                        <?php
                    }
                }

                else{
                    //we don't have categories
                    ?>
                     <option value="0">No category found</option>

                    <?php
                }

                // 2.display on dropdown 


                ?>
                </select>
            </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
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
                <td colspan="2">
                    <input type="submit"  name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

        <?php

        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the food in database
            // 1.get the data from Form
            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            //check whether radio button for featured and active are checked or not
            if(isset($_POST['featured']))
            {
                $featured=$_POST['featured'];
            }
            else{
                $featured="No"; //setting default value
            }

            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else{
                $active="No"; //setting default value
            }

            //2.Upload image if selected
            //check whether the selected image is clicked or not and upload image only if the image is selected

            if(isset($_FILES['image']['name']))
            {
               //get the details of the selected image
               $image_name=$_FILES['image'] ['name'];

               //check  whether image is selected or not and upload image only if selected
               if($image_name!="")
               {
                //image is selected
                //1. Rename the image
                //get the extension of selected image like png,jpg etc
                $ext=end(explode('.',$image_name));

                //create new name for image
                $image_name="Food-Name".rand(0000,9999).".".$ext;

                //2.Upload the image
                //get the src and destination path
                //src path-->current location of image

                $src=$_FILES['image']['tmp_name'];

                //destination path for image to be uploaded
                $dst="../images/food/".$image_name; 

                //upload food image
                $upload=move_uploaded_file($src,$dst);

                //check whether image is uploaded or not
                if($upload==false)
                {
                    //failed to upload the image
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                    
                     //redirect to add food page with error message
                    header("location:".SITEURL."admin/add-food.php");

                    //stop the process
                    die();
                }



               }

            }

            else{
                //set default value as blank
                $image_name="";
            }

            //3.insert into database
            //create a query to save or add food
            
            $sql2="INSERT INTO tbl_food SET
                 title='$title',
                 description='$description',
                 price=$price,
                 image_name='$image_name',
                 category_id=$category,
                 featured='$featured',
                 active='$active'
             ";

             //execute query
             $res2=mysqli_query($conn, $sql2);

             //check whether data inserted or not
             if($res2==true)
             {
                //data inserted successfully
                $_SESSION['add']="<div class='success'>Food Added Successfully</div>";
                header("location:".SITEURL."admin/manage-food.php");

             }
             else
             {
                //failed to insert data
                $_SESSION['add']="<div class='error'>Failed to add food...</div>";
                header("location:".SITEURL."admin/manage-food.php");
             }
        }

        
        ?>
    </div>
</div>
<?php include("../admin/partials/footer.php")?>;