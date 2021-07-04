<?php
  include_once('includes/header.php');
  if(Input::exists('post')) {
    if(Token::check(Input::get('token'))) {
      $validate = new Validate();
      $validation = $validate->check($_POST, array(
        'name' => array(
          'required' => true,
          'min'      => 2,
          'max'      => 20,
        ),
        'email' => array(
          'required' => true,
          'unique'   => 'users'
        ),
        'password' => array(
          'required' => true,
          'min'      => 6
        ),
        'password_again' => array(
          'required' => true,
          'matches'  => 'password',
        ),
        'accountType' => array(
          'required' => true
        )
      ));

      if($validation->passed()) {
        try {
          $user->create(array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'groups' => Input::get('accountType'),
          ));

          Session::flash('home', 'You registered successfully!');
          Redirect::to('index.php');
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
    <h1>Register</h1>
    <form class="" action="" method="post">
        <div class="row mb-3">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" placeholder="Your Name" class="form-control" id="inputName">
            </div>
        </div>
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
        <div class="row mb-3">
            <label for="inputCPassword" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" name="password_again" placeholder="Confirm Password" class="form-control"
                    id="inputCPassword">
            </div>
        </div>
        <div class="row mb-3">
            <label for="Account Type" class="col-sm-2 col-form-label">Account Type</label>
            <div class="col-sm-10">
                <select class="form-control" id="autoSizingSelect" name="accountType">
                    <option value="Admin">Administrator</option>
                    <option value="Manager">Manager</option>
                    <option value="User" selected>Standard User</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-primary" value="Register">
    </form>

</main>


<?php include_once('includes/footer.php'); ?>