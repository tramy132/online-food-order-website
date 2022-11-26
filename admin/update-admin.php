<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Update Admin</h1>
                <br />
                <?php 
                    //Get the ID of Selected Admin
                    $id=$_GET['id'];

                    //Create SQL Query to Get the Details
                    $sql="SELECT * FROM admins WHERE adminId=$id";

                    //Execute the Query
                    $res=mysqli_query($conn, $sql);

                    //Check whether the query is executed or not
                    if($res==true)
                    {
                        // Check whether the data is available or not
                        $count = mysqli_num_rows($res);
                        //Check whether we have admin data or not
                        if($count==1)
                        {
                            // Get the Details
                            //echo "Admin Available";
                            $row=mysqli_fetch_assoc($res);

                            $fullname = $row['fullname'];
                            $username = $row['username'];
                            $password = $row['password'];
                        }
                        else
                        {
                            //Create a Session Variable to Display Message
                            $_SESSION['update'] = "<div class='error'>ID is not exist</div>";
                            //Redirect to Manage Admin PAge
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
        
                ?>

                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Full Name: </td>
                            <td>
                                <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $username; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td>
                                <input type="password" name="password" value="<?php echo $password; ?>">
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Submit" class="btn-secondary">
                            </td>
                        </tr>
            
                    </table>
                </form>
            </div>
        
        </div>
        <!--Main Content Section Ends-->
<?php include('parts/footer.php')?>

<?php
    // Button is clicked or not
    if(isset($_POST['submit'])) {
        //Get the Data from form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //Check some things
        $check = true;
        if($fullname == '' || $username == '' || $password =='') {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['null'] = "<div class='error'>Failed to Update Admin. Data is mustn't null!</div>";
        } 
        $sql1 = "SELECT * FROM admins WHERE username = '$username' AND adminId != $id";
        $res1 = mysqli_query($conn, $sql1); 
        $count1 = mysqli_num_rows($res1);
        if($count1 > 0) {
            $check = false;
            //Create a Session Variable to Display Message
            $_SESSION['exsit'] = "<div class='error'>Failed to Update Admin. Username already exsits!</div>";
        }

        //If have not error => update
        if($check) {
            //Create a SQL Query to Update Admin
            $sql = "UPDATE admins SET
                fullname = '$fullname',
                username = '$username', 
                password = '$password'
                WHERE adminId = '$id'
            ";
            //Executing Query and Saving Data into Datbase
            $res = mysqli_query($conn, $sql);
            //Check whether (Query is Executed) and display appropriate message
            if($res == TRUE) {
                //Create a Session Variable to Display Message
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            } else {
                //Create a Session Variable to Display Message
                $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            }
        } 

        //Redirect Page to Manage Admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
?>