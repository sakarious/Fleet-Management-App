<?php
  include_once('includes/header.php');
  if(!$user->isLoggedIn()) { 
    Redirect::to('login.php');
};

if(Session::get('group') != 'Admin') { 
    Redirect::to('errors/404.php');
};
    if(Input::get('id')) {
        $id = Input::get('id');
    } else {
        $id = '1';
    }

    // echo $id;

    $cars = new Fleet();

    $singleCar = $cars->find($id);

    if(Input::exists('post')) {
         if(Token::check(Input::get('token'))) {

            try {
              $cars->delete($id);
              Session::flash('add', 'Car Deleted successfully!');
              Redirect::to('fleet.php');
            } catch(Exception $e) {
              die($e->getMessage());
                }
    
         }
      }
 ?>

<main class="px-3">
    <h1>Delete Car</h1>
    <p><a href="fleet.php" class="btn btn-primary">
            <<<< Back To All Fleet</a>
    </p>
    <p class="lead">Are you sure you want to delete this?</p>
    <div class="row mb-3">
        <label for="inputName" class="col-sm-2 col-form-label">Name of Car</label>
        <div class="col-sm-10">
            <input type="text" name="name" placeholder="Name of Car" class="form-control" id="inputName"
                value="<?php echo $singleCar->name; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputEmail" class="col-sm-2 col-form-label">Model</label>
        <div class="col-sm-10">
            <input type="text" name="model" placeholder="Car Model" class="form-control" id="inputEmail"
                value="<?php echo $singleCar->model; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputPassword" class="col-sm-2 col-form-label">Maker</label>
        <div class="col-sm-10">
            <input type="text" name="maker" placeholder="Car Manufacturer" class="form-control" id="inputPassword"
                value="<?php echo $singleCar->maker; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputCPassword" class="col-sm-2 col-form-label">Type of Car</label>
        <div class="col-sm-10">
            <input type="text" name="type" placeholder="Type e.g SUV, Race Car, Compact, Salon Car" class="form-control"
                id="inputCPassword" value="<?php echo $singleCar->type; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputassword" class="col-sm-2 col-form-label">Color</label>
        <div class="col-sm-10">
            <input type="text" name="color" placeholder="Color of Car" class="form-control" id="inputassword"
                value="<?php echo $singleCar->color; ?>" readonly>
        </div>
    </div>
    <div class="row mb-3">
        <label for="inputssword" class="col-sm-2 col-form-label">Year</label>
        <div class="col-sm-10">
            <input type="text" name="year" placeholder="Year Car was Manufactured" class="form-control" id="inputssword"
                value="<?php echo $singleCar->year; ?>" readonly>
        </div>
    </div>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $singleCar->id; ?>">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-danger" value="Delete Car">

    </form>

</main>


<?php include_once('includes/footer.php'); ?>