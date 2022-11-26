<?php include('parts/menu.php')?>

        <!--Main Content Section Starts-->
        <div class = "maincontent">
            <div class = "wrapper"> 
                <h1>Manage User</h1>
                <br />
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    } 
                    if(isset($_SESSION['null']))
                    {
                        echo $_SESSION['null']; 
                        unset($_SESSION['null']); 
                    }
                    if(isset($_SESSION['exsit']))
                    {
                        echo $_SESSION['exsit']; 
                        unset($_SESSION['exsit']);
                    }
                   
                ?>
                <br /><br />
                <a href="add-user.php" class="btn-primary">Add User</a>
                <br /><br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //Query to get all Admin
                        $sql = "SELECT * FROM users";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql) ;
                        //Check whether the Query is Executed or not

                        if($res == TRUE) {
                            $count = mysqli_num_rows($res);
                            //Check whether have data (rows > 0)
                            if($count>0) {
                                while($rows=mysqli_fetch_assoc($res)) {
                                    $id = $rows['userId'];
                                    $fullname = $rows['fullname'];
                                    $username = $rows['username'];
                                    $email = $rows['email'];
                                    $phone = $rows['phone'];
                                    $address = $rows['address'];
                                    ?>
                                    <tr>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-user.php?id=<?php echo $id; ?>" class="btn-secondary">Update User</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-user.php?id=<?php echo $id; ?>" class="btn-danger">Delete User</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                //Do not Have Data in Database
                            }
                        }
                    ?>
                </table>
            </div>
            
        </div>
        <!--Main Content Section Ends-->

<?php include('parts/footer.php')?>