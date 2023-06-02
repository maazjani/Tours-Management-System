<?php

include_once 'Session.php';
include_once 'Database.php';

class Tour{

    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getTourTypes()
    {
        $q = "SELECT * FROM `tour_types` ORDER BY `id` DESC";
        $stmt = $this->db->con->query($q);
        $row = $stmt->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    public function getTourTypeByID($data)
    {
        $q = "SELECT * FROM `tour_types` WHERE `id` = '$data' LIMIT 1";
        $stmt = $this->db->con->query($q);
        $row = $stmt->fetch_assoc();
        return $row;
    }

    public function insertTourType($data)
    {
        $type = $data['type'];

        $msg = '';

        if(empty($type)){
            $msg = "<p class='text-danger'>Field cannot br empty!</p>";
            return $msg;
        }

        $q = "INSERT INTO `tour_types`(`type`) VALUES ('$type')";
        $stmt = $this->db->con->query($q);
        if($stmt){ 
            $msg = "<p class='text-success'>New tour type is added successfully!</p>";
            return $msg;
        }
        else{
            $msg = "<p class='text-danger'>Something went wrong. Please try again later!</p>";
            return $msg;
        }
    }

    public function updateTourType($id, $data)
    {
        $type = $data['type'];

        $msg = '';

        if(empty($type)){
            $msg = "<p class='text-danger'>Field cannot br empty!</p>";
            return $msg;
        }

        $q = "UPDATE `tour_types` SET `type` = '$type' WHERE `id` = '$id'";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $msg = "<p class='text-success'>Tour type is successfully updated!</p>";
            return $msg;
        }
    }

    public function tourDelete($id)
    {
        $q = "DELETE FROM `tour_types` WHERE `id` = '$id'";
        $stmt = $this->db->con->query($q);
        if($stmt){
            $msg = "<p class='text-success'>Tour type is successfully deleted!</p>";
            return $msg;
        }
    }
}

?>