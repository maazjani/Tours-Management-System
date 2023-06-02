<?php include 'inc/header.php'; ?>
<?php include 'lib/Tour.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    $tour = new Tour(); 
    $row = $tour->getTourTypes();
    // echo "<pre>";
    // var_dump($row);
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_tour_type'])){
        $tourType = $tour->insertTourType($_POST);
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
                        <!-- Error Showing -->
                        <?php
                            if(isset($tourType)){
                                echo "<p class='text-center'>".$tourType."</p>";
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Tour type</label>
                                <input type="text" class="form-control" name="type" value="<?php echo isset($_POST["type"]) ? htmlentities($_POST["type"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="add_tour_type" value="Add Tour Type">
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
        