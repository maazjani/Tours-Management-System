<?php 
    include 'lib/User.php'; 
?>
<?php
    $user = new User();
    if( isset($_GET['email']) && isset($_GET['token']) ){
        $userVerify = $user->userVerification($_GET['email'], $_GET['token']);
    }
    
?>