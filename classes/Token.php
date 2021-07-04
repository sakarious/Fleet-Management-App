<?php
class Token {
  //For CSRF, geneteates token to check whenever form is submitted
  public static function generate() {
    return Session::put(Config::get('session/token_name'), md5(uniqid()));
  }

  //Checks if token passed in matches the token saved when created and deletes from session
  public static function check($token) {
    $tokenName = Config::get('session/token_name');

    if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
      Session::delete($tokenName);
      return true;
    }
    return false;
  }
}