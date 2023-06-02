<?php include 'inc/header.php'; ?>
<?php include 'lib/TourPackage.php'; ?>
<?php include 'lib/Tour.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    if(isset($_GET['id'])){
        $tourPkgId = (int)$_GET['id'];
    }
    $tourpkg = new TourPackage();
    $getTourPkgData = $tourpkg->getTourPkgByID($tourPkgId);
    
    $tour = new Tour(); 
    $tourRow = $tour->getTourTypes();
    // echo "<pre>";
    // var_dump($row);
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update_tour_package'])){
        $tourPkg = $tourpkg->updateTourPackage($tourPkgId, $_POST);
    }
?>
<main role="main">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <h3>EDIT TOUR PACKAGE</h3>
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
                                <input type="text" class="form-control" name="name" value="<?=$getTourPkgData['name']?>">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" cols="30" rows="4" class="form-control"><?=$getTourPkgData['description']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tour type</label>
                                <select id="" class="form-control" name="type">
                                    <option value="">SELECT TOUR TYPE</option>
                                    <?php
                                        foreach($tourRow as $tr){
                                            ?>
                                            <option value="<?=$tr['id']?>" <?php if($getTourPkgData['tour_type']==$tr['id']){echo 'selected';} ?>><?=$tr['type']?></option>
                                            <?php

                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Package Price</label>
                                <input type="number" class="form-control" name="price" value="<?=$getTourPkgData['price']?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-block" name="update_tour_package" value="Update Tour Package">
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
        