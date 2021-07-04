<?php
  include_once('includes/header.php');
  if(!$user->isLoggedIn()) { 
    Redirect::to('login.php');
};

if(Session::get('group') == 'User') { 
    Redirect::to('errors/404.php');
};
    if(Input::get('id')) {
        $id = Input::get('id');
    } else {
        $id = '1';
    }


    $cars = new Fleet();

    $singleCar = $cars->find($id);

    if(Input::exists('post')) {
        if(Token::check(Input::get('token'))) {
          $validate = new Validate();
          $validation = $validate->check($_POST, array(
            'name' => array(
              'required' => true,
              'min'      => 2,
            ),
            'model' => array(
                'required' => true,
                'min'      => 2,
            ),
            'maker' => array(
                'required' => true,
                'min'      => 2,
            ),
            'type' => array(
                'required' => true,
                'min'      => 2,
            ),
            'color' => array(
                'required' => true,
                'min'      => 2,
            ),
            'year' => array(
                'required' => true
            )
          ));
    
          if($validation->passed()) {
            try {
              $cars->update($id, array(
                'name' => Input::get('name'),
                'model' => Input::get('model'),
                'maker' => Input::get('maker'),
                'type' => Input::get('type'),
                'color' => Input::get('color'),
                'year' => Input::get('year'),
              ));
    
              Session::flash('add', 'Car Updated successfully!');
              Redirect::to('fleet.php');
            } catch(Exception $e) {
              die($e->getMessage());
            }
    
          } else {
            foreach($validation->errors() as $error) {
              echo $error . '<br>';
            }
          }
        }
      }
 ?>

<main class="px-3">
    <h1>View Car</h1>
    <p><a href="fleet.php" class="btn btn-primary">
            <<<< Back To All Fleet</a>
    </p>
    <form class="" action="" method="post">
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Name of Car</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="Name of Car" class="form-control" id="inputName"
                    value="<?php echo $singleCar->name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Model</label>
            <div class="col-sm-10">
                <input type="text" name="model" placeholder="Car Model" class="form-control" id="inputEmail"
                    value="<?php echo $singleCar->model; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Maker</label>
            <div class="col-sm-10">
                <input type="text" name="maker" placeholder="Car Manufacturer" class="form-control" id="inputPassword"
                    value="<?php echo $singleCar->maker; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputCPassword" class="col-sm-2 col-form-label">Type of Car</label>
            <div class="col-sm-10">
                <input type="text" name="type" placeholder="Type e.g SUV, Race Car, Compact, Salon Car"
                    class="form-control" id="inputCPassword" value="<?php echo $singleCar->type; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputassword" class="col-sm-2 col-form-label">Color</label>
            <div class="col-sm-10">
                <input type="text" name="color" placeholder="Color of Car" class="form-control" id="inputassword"
                    value="<?php echo $singleCar->color; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputssword" class="col-sm-2 col-form-label">Year</label>
            <div class="col-sm-10">
                <input type="date" name="year" placeholder="Year Car was Manufactured" class="form-control"
                    id="inputssword" value="<?php echo $singleCar->year; ?>">
            </div>
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" value="Update Car Details">
    </form>


</main>


<?php include_once('includes/footer.php'); ?>