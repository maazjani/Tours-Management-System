<?php 
    include 'inc/header.php';
    include 'lib/User.php'; 
    include 'lib/TourPackage.php'; 
 ?>
<?php Session::checkSession(); ?>
<?php 
    $user = new User(); 

    $tour_pkg = new TourPackage(); 
    $pkgs = $tour_pkg->showAllTourPackages();
?>
<main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
    <div class="container">
        <h1 class="display-3">Hello, <?php $name = Session::get('UNAME'); if(isset($name)){echo $name;}?>!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
    </div>
    </div>

    <div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <?php
            if($pkgs){
                foreach($pkgs as $pkg){
                    ?>
                    <div class="col-md-4">
                        <h2><?=$pkg['name']?></h2>
                        <p><?=$pkg['description']?></p>
                        <p class="badge badge-dark"><?=$pkg['type']?></p>
                        <p><a class="btn btn-success" href="book_package.php?id=<?=$pkg['id']?>" role="button">Book Now <span class="badge badge-light"><?=$pkg['price'].' PKR'?></span> &raquo;</a></p>
                        </div>
                    <?php
                }
            }
        ?>
        
    </div>

    <hr>

    </div> <!-- /container -->

</main>
<?php include 'inc/footer.php'; ?>
        