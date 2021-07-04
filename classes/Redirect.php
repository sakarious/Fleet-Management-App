<?php
class Redirect {
  //Helper function for header()
  public static function to($location = null) {
    //Checks if location exists
    if($location) {
      //For 404 redirection
      if(is_numeric($location)) {
        switch($location) {
          case 404:
            header('HTTP/1.0 404 NOT Found');
            include 'includes/errors/404.php';
            exit();
          break;
        }
      }

      header('Location: '. $location);
      exit();
    }
  }
}