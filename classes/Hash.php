<?php
class Hash {
  //Hash User Password
  public static function make($string) {

    return password_hash($string, PASSWORD_DEFAULT);
  }
}