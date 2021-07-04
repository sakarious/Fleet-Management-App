<?php
   include_once('includes/header.php');

  if(Input::exists('post')) {
    if(Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'email' => array('required' => true),
        'password' => array('required' => true)
      ));

      if($validation->passed()) {
        $login = $user->login(Input::get('email'), Input::get('password'));
        if($login) {
          Redirect::to('index.php');
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
    <h1>Login</h1>
    <form class="" action="" method="post">
        <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" name="email" placeholder="Email Address" class="form-control" id="inputEmail">
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" placeholder="Enter Your Password" class="form-control"
                    id="inputPassword">
            </div>
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="" value="Login" class="btn btn-primary">
    </form>

</main>

<?php include_once('includes/footer.php'); ?>