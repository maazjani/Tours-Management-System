<?php include 'inc/header.php'; ?>
<?php include 'lib/TourPackage.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    $tourpkg = new TourPackage(); 
    $row = $tourpkg->showAllTourPackages();
    // echo "<pre>";
    // var_dump($row);
    if(isset($_GET['id']) && $_GET['action']=='delete'){
        $tourPkgId = (int)$_GET['id'];
        $tourPkgDel = $tourpkg->tourPkgDelete($tourPkgId);
    }
?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Tour Packages!</h1>
            <p>The types of land tours can vary depending on the country, but the majority of tours follow a certain format.</p>
            <p><a class="btn btn-primary btn-lg" href="add_tour_package.php" role="button">Add New Package</a></p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <?php
                if(isset($tourPkgDel)){
                    echo "<p class='text-center'>".$tourPkgDel."</p>";
                }
            ?>
            <table class="table table-striped">
                <thead>
                    <th>Sr.No.</th>
                    <th>Package Name</th>
                    <th>Brief</th>
                    <th>Price</th>
                    <th>Tour Type</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php $i = 0;
                        foreach($row as $data){
                            $i++;
                            ?>
                            <tr>
                                <td><?=$i;?></td>
                                <td><?=$data['name']?></td>
                                <td><?=$data['description']?></td>
                                <td><?=$data['price'].' PKR'?></td>
                                <td><?=$data['type']?></td>
                                <td><?=$data['created_at']?></td>
                                <td>
                                    <a href="edit_tour_package.php?id=<?=$data['id']?>" class="btn btn-info btn-sm">EDIT</a>
                                    <a href="tour_packages.php?id=<?=$data['id']?>&action=delete" class="btn btn-danger btn-sm">DELETE</a>
                                </td>
                            </tr>
                    <?php   
                        }
                    ?>
                </tbody>
            </table>
        </div>

    <hr>
    </div> <!-- /container -->

</main>
<?php include 'inc/footer.php'; ?>
        