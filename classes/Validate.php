<?php
class Validate {
  private $_passed = false, //Hold Validation result
          $_errors = array(), //Holds errors from validation
          $_db     = null; //Connection to database

  public function __construct() {
    $this->_db = DB::getInstance(); //On initialization, check if connection as been make to db, else create one
  }

  //Validation
  public function check($source, $items = array()) {
    //Loop through rules defined
    foreach($items as $item => $rules) {
      $item = escape($item);
      $value = $source[$item];
      foreach($rules as $rule => $rule_value) {
        //Check each rule and see if they pass. If they dont, add error to the errors array.
        if($rule === 'required' && empty($value)) {
          $this->addError("{$item} is required");
        } else if(!empty($value)) {
          switch($rule) {
            case 'min':
              if(strlen($value) < $rule_value) {
                $this->addError("{$item} must be minimum of {$rule_value} characters");
              }
            break;
            case 'max':
              if(strlen($value) > $rule_value) {
                $this->addError("{$item} must be maximum of {$rule_value} characters");
              }
            break;
            case 'matches':
              if($value != $source[$rule_value]) {
                $this->addError("{$item} value must match {$rule_value}");
              }
            break;
            case 'unique':
              $check = $this->_db->get($rule_value, array($item, '=', $value));
              if($check->count()) {
                $this->addError("{$item} already exists");
              }
            break;
          }
        }
      }
    }

    if(!$this->errors()) {
      //Checks if theres no error and changes passed to true
      $this->_passed = true;
    }

    return $this;
  }

  //Adds error to private error property
  private function addError($error) {
    $this->_errors[] = $error;
  }

  //Returns value of passed property
  public function passed() {
    return $this->_passed;
  }

  //Returns error array
  public function errors() {
    return $this->_errors;
  }
}