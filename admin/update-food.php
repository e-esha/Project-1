<?php include('../admin/partials/menu.php')?>;

<div class="maincontent">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        Display image
                    </td>
                </tr>

                <tr>
                    <td>Select New Image:</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                        <?php
                        //query to get active queries
                        $sql="SELECT * FROM tbl_category WHERE active='Yes";

                        //execute the query
                        $res=mysqli_query($conn, $sql);
                        
                        $count=mysqli_num_rows(
                            $res);

                        //check whether category available or not
                        if($count>0)
                        {
                            //category available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title=$row['title'];
                                $category_id=$row['id'];
                                echo"<option value='$category_id'>$category_title</option>";
    
                            }
                        }
                        else{
                            //category not available
                            echo"<option value='0'>Category Not Available</option>";
                        }

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
                    <td><input type="submit" name="submit" value="Update Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include("../admin/partials/footer.php")?>;