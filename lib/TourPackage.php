<?php

include_once 'Session.php';
include_once 'Database.php';
include_once 'Email.php';

class TourPackage{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function showAllTourPackages()
    {
        $q = "SELECT `tour_packages`.*, `tour_types`.`type` FROM `tour_packages` JOIN `tour_types` ON `tour_packages`.`tour_type` = `tour_types`.`id` ORDER BY `id` ASC";
        $stmt = $this->db->con->query($q);
        $data = $stmt->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    public function insertTourPackage($data)
    {
        $name = $data['name'];
        $desc = $data['description'];
        $type = $data['type'];
        $price = $data['price'];

        $msg = '';

        if(empty($name) || empty($desc) || empty($type) || empty($price)){
            $msg = "<p class='text-danger'>Fields cannot be empty!</p>";
            return $msg;
        }

        if(preg_match('/[^0-9]+/i',$price)){
            $msg = "<p class='text-danger'>Price must only contains numeric values!</p>";
            return $msg;
        }

        $q = "INSERT INTO `tour_packages`(`name`, `description`, `price`, `tour_type`) VALUES ('$name','$desc','$price','$type')";
        $stmt = $this->db->con->query($q);
        if($stmt){ 
            $msg = "<p class='text-success'>New tour package is added successfully!</p>";
            return $msg;
        }
        else{
            $msg = "<p class='text-danger'>Something went wrong. Please try again later!</p>";
            return $msg;
        }
    }

    public function tourPkgDelete($id)
    {
        $q = "DELETE FROM `tour_packages` WHERE `id` = '$id'";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $msg = "<p class='text-success'>Tour package is successfully deleted!</p>";
            return $msg;
        }
    }

    public function getTourPkgByID($id)
    {
        $q = "SELECT * FROM `tour_packages` WHERE `id` = '$id' LIMIT 1";
        $stmt = $this->db->con->query($q);
        $row = $stmt->fetch_assoc();
        return $row;
    }

    public function updateTourPackage($id, $data)
    {
        $name = $data['name'];
        $desc = $data['description'];
        $type = $data['type'];
        $price = $data['price'];

        $msg = '';

        if(empty($name) || empty($desc) || empty($type) || empty($price)){
            $msg = "<p class='text-danger'>Fields cannot be empty!</p>";
            return $msg;
        }

        if(preg_match('/[^0-9]+/i',$price)){
            $msg = "<p class='text-danger'>Price must only contains numeric values!</p>";
            return $msg;
        }

        $q = "UPDATE `tour_packages` SET `name`='$name',`description`='$desc',`price`='$price',`tour_type`='$type' WHERE `id` = '$id'";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $msg = "<p class='text-success'>Tour package is successfully updated!</p>";
            return $msg;
        }
    }

    public function BookTour($pkgID, $uid, $data)
    {
        $fullname = $data['name'];
        $email = $data['email'];
        $passengers = $data['passengers'];
        $dep_date = $data['departure_date'];

        $msg = '';

        if(empty($fullname) || empty($email) || empty($passengers) || empty($dep_date)){
            $msg = "<p class='text-danger'>Fields cannot be empty!</p>";
            return $msg;
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false){
            $msg = "<p class='text-danger'>Please enter a valid email address!</p>";
            return $msg;
        }

        if(strlen($passengers) > 12){
            $msg = "<p class='text-danger'>Please enter passengers less than 12!</p>";
            return $msg;
        }

        $q = "INSERT INTO `book_packages`(`fullname`, `email`, `passengers`, `departure_date`, `package_id`, `user_id`) VALUES ('$fullname','$email','$passengers','$dep_date','$pkgID','$uid')";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $res = $this->bookingEmailTemplate($email, $uid, $pkgID);
            if($res){
                $msg = "<p class='text-success'>Tour booking is successfull! We have sent you email containing tour details. <a href='index.php'><strong>Click here</strong></a> to return to main page.</p>";
                return $msg;
            }
            
        }
        else{
            $msg = "<p class='text-danger'>Something went wrong. Please try again later!</p>";
            return $msg;
        }
    }

    private function bookingEmailTemplate($email, $uid, $pkgID){

        $q = "SELECT * FROM `book_packages` WHERE `user_id` = '$uid' AND `package_id` = '$pkgID' LIMIT 1";
        $stmt = $this->db->con->query($q);
        $row = $stmt->fetch_assoc();

        $mail = new Email();
            $subject = "Tour Booking confirmation for Tours Website.";
            $from = "maaz@tour.com";
            $body = '';
            $body .= "<h3>Thank you for booking the tour.</h3>";
            $body .= "<table border='1'>";
                $body .= "<thead>";
                    $body .= "<th>Name</th>";
                    $body .= "<th>Email Address</th>";
                    $body .= "<th>Number of passengers</th>";
                    $body .= "<th>Departure Date</th>";
                    $body .= "<th>Booking Date</th>";
                $body .= "</thead>";
                $body .= "<tbody>";
                    $body .= "<tr>";
                        $body .= "<td>".$row['fullname']."</td>";
                        $body .= "<td>".$row['email']."</td>";
                        $body .= "<td>".$row['passengers']."</td>";
                        $body .= "<td>".$row['departure_date']."</td>";
                        $body .= "<td>".$row['booked_on']."</td>";
                    $body .= "</tr>";
                $body .= "</tbody>";
            $body .= "</table>";
            $res = $mail->sendEmail($email, $subject, $body, $from, 'Tours');
            return $res;
    }
}

?>