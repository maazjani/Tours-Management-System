<?php include 'inc/header.php'; ?>
<?php include 'lib/Tour.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    if(isset($_GET['id'])){
        $tourId = (int)$_GET['id'];
    }
    $tour = new Tour(); 
    $tourType = $tour->getTourTypeByID($tourId);

    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update_tour_type'])){
        $updateTour = $tour->updateTourType($tourId, $_POST);
    }
?>
<main role="main">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <h3>ADD NEW TOUR TYPE</h3>
                <a href="tour_types.php" class="btn btn-info pull-right" role="button">Back</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="offset-md-3 col-md-6">
            <div class="card p-2">
                    <div class="card-body">
                        <?php
                            if(isset($updateTour)){
                                echo "<p class='text-center'>".$updateTour."</p>";
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Tour type</label>
                                <input type="text" class="form-control" name="type" value="<?php echo $tourType['type'] ; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="update_tour_type" value="Update Tour Type">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <hr>
    </div> <!-- /container -->

</main>
<?php include 'inc/footer.php'; ?>
        