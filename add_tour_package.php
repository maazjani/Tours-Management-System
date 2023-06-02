<?php include 'inc/header.php'; ?>
<?php include 'lib/TourPackage.php'; ?>
<?php include 'lib/Tour.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    $tourpkg = new TourPackage();
    $tour = new Tour(); 
    $tourRow = $tour->getTourTypes();
    // echo "<pre>";
    // var_dump($row);
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_tour_package'])){
        $tourPkg = $tourpkg->insertTourPackage($_POST);
    }
?>
<main role="main">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <h3>ADD NEW TOUR PACKAGE</h3>
                <a href="tour_packages.php" class="btn btn-info pull-right" role="button">Back</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="offset-md-3 col-md-6">
            <div class="card p-2">
                    <div class="card-body">
                        <!-- Error Showing -->
                        <?php
                            if(isset($tourPkg)){
                                echo "<p class='text-center'>".$tourPkg."</p>";
                            }
                        ?>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Tour Package Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo isset($_POST["name"]) ? htmlentities($_POST["name"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="4" class="form-control">

                                </textarea>
                                <!-- <input type="text" class="form-control" name="description" value="<?php echo isset($_POST["description"]) ? htmlentities($_POST["description"]) : ''; ?>"> -->
                            </div>
                            <div class="form-group">
                                <label for="">Tour type</label>
                                <select id="" class="form-control" name="type">
                                    <option value="">SELECT TOUR TYPE</option>
                                    <?php
                                        foreach($tourRow as $tr){
                                            ?>
                                            <option value="<?=$tr['id']?>"><?=$tr['type']?></option>
                                            <?php

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Package Price</label>
                                <input type="number" class="form-control" name="price" value="<?php echo isset($_POST["price"]) ? htmlentities($_POST["price"]) : ''; ?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="add_tour_package" value="Add Tour Package">
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
        