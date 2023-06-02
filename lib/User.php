<?php

include_once 'Session.php';
include 'Database.php';
include_once 'Email.php';

class User{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function userRegistration($data){
        $fullname = $data['fullname'];
        $username = $data['username'];
        $email = $data['email'];
        $password = md5($data['password']);
        $cpassword = md5($data['cpassword']);

        $checkEmail = $this->emailCheck($email);

        $token = bin2hex(random_bytes(16));

        $msg = '';

        if(empty($fullname) || empty($username) || empty($email) || empty($password)){
            $msg = "<p class='text-danger'>Fields cannot be empty!</p>";
            return $msg;
        }

        if(strlen($username) < 3){
            $msg = "<p class='text-danger'>Username is too short!</p>";
            return $msg;
        }
        else if(preg_match('/[^a-z0-9_-]+/i',$username)){
            $msg = "<p class='text-danger'>Username must only contains alphanumeric values, underscores and dashes!</p>";
            return $msg;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
            $msg = "<p class='text-danger'>Please enter a valid email address!</p>";
            return $msg;
        }

        if($checkEmail == true){
            $msg = "<p class='text-danger'>Your entered email address already exists!</p>";
            return $msg;
        }

        if(strlen($password) < 8){
            $msg = "<p class='text-danger'>Password is too short! Please choose a strong password more than 8 characters!</p>";
            return $msg;
        }
        else if($password!=$cpassword){
            $msg = "<p class='text-danger'>Password and confirm password donot match!</p>";
            return $msg;
        }

        $q = "INSERT INTO `users`(`fullname`, `username`, `email`, `password`, `token`) VALUES ('$fullname','$username','$email','$password','$token')";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $mail = new Email();
            $subject = "Email verification for Tours Website.";
            $from = "maaz@tour.com";
            $body = "Thank you for the registration. Please click on the link to activate your email address. <a href='http://localhost/tour/verify.php?email={$email}&token={$token}'>Verify</a>";
            $res = $mail->sendEmail($email, $subject, $body, $from, 'Tours');
            if($res){
                $msg = "<p class='text-success'>User registration is successfull! We have sent you email containing verification link.Please verify your email.</p>";
                return $msg;
            }
        }
        else{
            $msg = "<p class='text-danger'>Something went wrong. Please try again later!</p>";
            return $msg;
        }
    }

    public function emailCheck($email){
        $q = "SELECT `email` FROM `users` WHERE `email` = '$email'";
        $stmt = $this->db->con->query($q);
        //$row = $stmt->fetch_assoc();
        if($stmt->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function userLogin($data){
        $email = $data['email'];
        $password = md5($data['password']);

        $msg = '';

        if(empty($email) || empty($password)){
            $msg = "<p class='text-danger'>Please fill all fields!</p>";
            return $msg;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $msg = "<p class='text-danger'>Please enter a valid email address!</p>";
            return $msg;
        }

        $checkEmail = $this->emailCheck($email);
        if($checkEmail == false){
            $msg = "<p class='text-danger'>Your entered email address does not exists!</p>";
            return $msg;
        }

        $result = $this->getUserLogin($email, $password);
        if($result){
            if($result['is_verified'] == '1'){
                Session::init();
                Session::set('login', true);
                Session::set('ID', $result['id']);
                Session::set('NAME', $result['fullname']);
                Session::set('UNAME', $result['username']);
                header("Location: index.php");
            }
            else{
                $msg = "<p class='text-danger'>Please verify your email to access this website.</p>";
                return $msg;
            }
            
        }
        else{
            $msg = "<p class='text-danger'>Either your email or password is incorrect.</p>";
            return $msg;
        }
    }

    public function getUserLogin($email, $password){
        $q = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
        $stmt = $this->db->con->query($q);
        $row = $stmt->fetch_assoc();
        return $row;
    }

    public function userVerification($email, $token){
        $q = "SELECT * FROM `users` WHERE `email` = '$email' AND `token` = '$token' LIMIT 1";
        $stmt = $this->db->con->query($q);
        if($stmt){
            if($stmt->num_rows == 1){
                $row = $stmt->fetch_assoc();
                if($row['is_verified'] == '0'){
                    $q1 = "UPDATE `users` SET `is_verified` = '1' WHERE `email` = '$email'";
                    $stmt1 = $this->db->con->query($q1);
                    if($stmt1){
                        echo "<script>alert('Email verification is successfull!')</script>";
                        echo "<script>window.location.href='login.php';</script>"; 
                    }
                }
                else{
                    echo "<script>alert('Email is already verified!')</script>";
                    echo "<script>window.location.href='login.php';</script>";
                }
            }
        }
        else{
            return false;
        }
        
    }


}


?>