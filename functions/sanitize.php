<?php
//Function to sanities input
function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

//Function to make geting base url or easier
function urlFor($scriptPath) {
  if($scriptPath[0] != '/') {
      $scriptPath = '/' . $scriptPath;
  }
  return WEB_ROOT . $scriptPath;
}