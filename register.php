<?php include 'inc/header.php'; ?>
<?php include 'lib/User.php'; ?>
<?php
    $user =  new User();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
        $userRegistration = $user->userRegistration($_POST);
    }
    
?>
<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
    <div class="container">
        <h1 class="display-4 text-center">New User Registration!</h1>
        <p class="text-center">Please register yourself to access all the functionalities of this system.</p>
    </div>
    </div>
    
    <div class="container">
    
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="card p-2">
                    <div class="card-body">
                        <!-- Error Showing -->
                        <?php
                            if(isset($userRegistration)){
                                echo "<p class='text-center'>".$userRegistration."</p>";
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Fullname</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo isset($_POST["fullname"]) ? htmlentities($_POST["fullname"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo isset($_POST["username"]) ? htmlentities($_POST["username"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo isset($_POST["email"]) ? htmlentities($_POST["email"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo isset($_POST["password"]) ? htmlentities($_POST["password"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="cpassword" value="<?php echo isset($_POST["cpassword"]) ? htmlentities($_POST["cpassword"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" name="register" value="Register">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</main>
<?php include 'inc/footer.php'; ?>
        

    