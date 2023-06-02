<?php 
    include 'inc/header.php';
    include 'lib/User.php'; 
    include 'lib/TourPackage.php'; 
 ?>
<?php Session::checkSession(); ?>
<?php 

    if(isset($_GET['id'])){
        $tourPkgId = (int)$_GET['id'];
    }

    $tour_pkg = new TourPackage(); 
    $pkg = $tour_pkg->getTourPkgByID($tourPkgId);

    $user_id = Session::get('ID');

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['book_tour_package'])){
        $tour_booking = $tour_pkg->BookTour($tourPkgId, $user_id, $_POST);
    }
?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3"><?=$pkg['name']?></h1>
            <p><?=$pkg['description']?></p>
            <p class="badge badge-primary"><?=$pkg['price'].' PKR'?></p>
        </div>
    </div>

    <div class="container">
        <?php
            if(isset($tour_booking)){
                echo "<p class='text-center'>".$tour_booking."</p>";
            }
        ?>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Fullname</label>
                        <input type="text" class="form-control" name="name" value="<?php echo isset($_POST["name"]) ? htmlentities($_POST["name"]) : ''; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo isset($_POST["email"]) ? htmlentities($_POST["email"]) : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Number of passengers</label>
                        <input type="number" class="form-control" name="passengers" value="<?php echo isset($_POST["passengers"]) ? htmlentities($_POST["passengers"]) : ''; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Departure Date</label>
                        <input type="date" class="form-control" name="departure_date" value="<?php echo isset($_POST["departure_date"]) ? htmlentities($_POST["departure_date"]) : ''; ?>">
                    </div>
                </div>
            </div>
            <hr class="bg-warning" style="width:50%">
            <div class="row">
                <div class="offset-md-6 col-md-6">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" name="book_tour_package" value="BOOK NOW">
                    </div>
                </div>
            </div>
        </form>
    <hr>
    </div>

</main>
<?php include 'inc/footer.php'; ?>
        