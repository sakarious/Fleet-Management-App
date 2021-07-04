<?php
class User {
  private $_db, //Holds connection yo db
          $_data, //Holds sql result
          $_sessionName, //Holds session name
          $_isLoggedIn = false; //Checks if user is logged in

  public function __construct($user = null) {
    //Create connection to database
    $this->_db = DB::getInstance();
    $this->_sessionName = Config::get('session/session_name');
    //Check if user does not exist
    if(!$user) {
      //Check if session exist
      if(Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);
        //Get user data, 
        if($this->find($user)) {
          $this->_isLoggedIn = true;
        } else {
          //Logout
          $this->logout();
        }
      } else {
        //Find user
        $this->find($user);
      }
    }
  }

     //Create/Insert new user to db
  public function create($fields = array()) {
    if(!$this->_db->insert('users', $fields)) {
      //If there was a problem,throw error
      throw new Exception('There was a problem creating an account.');
    }
  }

  //Find user
  public function find($user = null) {
    if($user) {
      //Check if user is a number
      $field = (is_numeric($user)) ? 'id' : 'email';
      //Get data from db
      $data = $this->_db->get('users', array($field, '=', $user));

      //Check if data exists
      if($data->count()) {
        //Store to data property
        $this->_data = $data->first();
        return true;
      }
    }

    return false;
  }

  //Login in user
  public function login($email = null, $password = null) {
    //Check if user exists in databse
    $user = $this->find($email);
    if($user) {
      //If user exists, verify user password
      if(password_verify($password, $this->data()->password)) {
        //If password match, add user data to db
        Session::put($this->_sessionName, $this->data()->id);
        Session::put('group', $this->data()->groups);
        return true;
      } else {
        //If theres an error
        echo "Your credential is wrong";
      }
    }
    return false;
  }

  //Logout function
  public function logout() {
    //Delete user session
    Session::delete($this->_sessionName);
  }

  //Get data
  public function data() {
    return $this->_data;
  }

  //Return isloggedin property
  public function isLoggedIn() {
    return $this->_isLoggedIn;
  }
}