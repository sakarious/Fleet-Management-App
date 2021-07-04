<?php
    include_once('includes/header.php');
    if(!$user->isLoggedIn()) { 
        Redirect::to('login.php');
    };

    $cars = new Fleet();

    $allCars = $cars->findAll();
?>

<main class="px-3">
    <h1>All Fleets</h1>
    <p class="lead">Manage your fleets here.</p>
    <?php if(Session::get('group') == 'Admin') {  ?>
    <a href="add.php" class="btn btn-primary">Add To Fleet</a>
    <?php } ?>
    <?php if(Session::exists('add')) { ?>
    <p class="lead"><?php echo Session::flash('add'); ?></p>
    <?php } ?>

    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Model</th>
                <th scope="col">Maker</th>
                <th scope="col">Type</th>
                <th scope="col">Color</th>
                <th scope="col">Year</th>
                <th scope="col">&nbsp;</th>
                <?php if(Session::get('group') == 'Admin' || Session::get('group') == 'Manager') {  ?>
                <th scope="col">&nbsp;</th>
                <?php } ?>
                <?php if(Session::get('group') == 'Admin') {  ?>
                <th scope="col">&nbsp;</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allCars as $cars) { ?>
            <tr>
                <th scope="row"><?php echo $cars->id ?></th>
                <td><?php echo $cars->name ?></td>
                <td><?php echo $cars->model ?></td>
                <td><?php echo $cars->maker ?></td>
                <td><?php echo $cars->type ?></td>
                <td><?php echo $cars->color ?></td>
                <td><?php echo $cars->year ?></td>
                <td><a class="btn btn-success" href="<?php echo urlFor('/view.php?id=' . $cars->id); ?>">View</a></td>
                <?php if(Session::get('group') == 'Admin' || Session::get('group') == 'Manager') {  ?>
                <td><a class="btn btn-primary" href="<?php echo urlFor('/edit.php?id=' . $cars->id); ?>">Edit</a></td>
                <?php } ?>
                <?php if(Session::get('group') == 'Admin') {  ?>
                <td><a class="btn btn-danger" href="<?php echo urlFor('/delete.php?id=' . $cars->id); ?>">Delete</a>
                </td>
                <?php } ?>

            </tr>
            <?php } ?>
        </tbody>
    </table>


</main>

<?php include_once('includes/footer.php'); ?>