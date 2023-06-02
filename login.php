<?php 
    include 'inc/header.php'; 
    include 'lib/User.php'; 
    Session::checkLoggedUser();
?>
<?php
    $user =  new User();
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
        $userLogin = $user->userLogin($_POST);
    }
    
?>
<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
    <div class="container">
        <h1 class="display-4 text-center">User SignIn!</h1>
        <p class="text-center">Please login with your credentials to access all the functionalities of this system.</p>
    </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <div class="card p-2">
                    <div class="card-body">
                        <!-- Error Showing -->
                        <?php
                            if(isset($userLogin)){
                                echo "<p class='text-center'>".$userLogin."</p>";
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="email" class="form-control" name="email" value="<?php echo isset($_POST["email"]) ? htmlentities($_POST["email"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" value="<?php echo isset($_POST["password"]) ? htmlentities($_POST["password"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="login" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</main>
<?php include 'inc/footer.php'; ?>
        

    