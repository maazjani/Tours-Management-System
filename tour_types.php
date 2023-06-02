<?php include 'inc/header.php'; ?>
<?php include 'lib/Tour.php'; ?>
<?php Session::checkSession(); ?>
<?php 
    $tour = new Tour(); 
    $row = $tour->getTourTypes();
    // echo "<pre>";
    // var_dump($row);
    if(isset($_GET['id']) && $_GET['action']=='delete'){
        $tourId = (int)$_GET['id'];
        $tourDel = $tour->tourDelete($tourId);
    }
?>
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Tour Types!</h1>
            <p>The types of land tours can vary depending on the country, but the majority of tours follow a certain format.</p>
            <p><a class="btn btn-primary btn-lg" href="add_tour_type.php" role="button">Add New Type</a></p>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <?php
                if(isset($tourDel)){
                    echo "<p class='text-center'>".$tourDel."</p>";
                }
            ?>
            <table class="table table-striped">
                <thead>
                    <th>Sr.No.</th>
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
                                <td><?=$data['type']?></td>
                                <td><?=$data['created_at']?></td>
                                <td>
                                    <a href="edit_tour_type.php?id=<?=$data['id']?>" class="btn btn-info btn-sm">EDIT</a>
                                    <a href="tour_types.php?id=<?=$data['id']?>&action=delete" class="btn btn-danger btn-sm">DELETE</a>
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
        