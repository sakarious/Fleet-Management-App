<?php
class Session {
  //hecks if seesion name exists
  public static function exists($name) {
    return (isset($_SESSION[$name])) ? true : false;
  }

  //Add a new item to session
  public static function put($name, $value) {
    return $_SESSION[$name] = $value;
  }

  //Gets item from seesion array
  public static function get($name) {
    return $_SESSION[$name];
  }

  //Delete item from session array
  public static function delete($name) {
    if(self::exists($name)) {
      unset($_SESSION[$name]);
    }
  }

  //Add item to session to display on page and delete so it doesnt show on next refresh
  public static function flash($name, $string = '') {
    if(self::exists($name)) {
      $session = self::get($name);
      self::delete($name);
      return $session;
    } else {
      self::put($name, $string);
    }

    return '';
  }
}