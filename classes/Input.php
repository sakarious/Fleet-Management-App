<?php
class Input {
  //Check if an input exists aka isset
  public static function exists($type = 'post') {
    switch($type) {
      case 'post':
        return (!empty($_POST)) ? true : false;
      break;
      case 'get':
        return (!empty($_GET)) ? true : false;
      break;
      default:
        return false;
      break;
    }
  }

  //Get a particular input from POST or GET array
  public static function get($item) {
    if(isset($_POST[$item])) {
      return $_POST[$item];
    } else if(isset($_GET[$item])) {
      return $_GET[$item];
    }

    return '';
  }
}