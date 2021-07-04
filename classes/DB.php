<?php
class DB {
  private static $_instance = null; // Store instance of Database
  private $_pdo, //holds instatiated PDO Object
          $_query, //Holds last query executed
          $_error = false, //Error for latest query
          $_results, //Holds Result Set
          $_count = 0; //Result Set count

  final private function __construct() {
    try {
      //Create a connection to database
      $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host').';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }


  public static function getInstance() {
    //Checks if a connection to database already exists, if not, it creates a new connection
    if(!isset(self::$_instance)) {
      self::$_instance = new DB();
    }
    return self::$_instance;
  }

  // Method For Quering database
  public function query($sql, $params = array()) {
    $this->_error = false; // Reset Error Message
    if($this->_query = $this->_pdo->prepare($sql)) { // Checks if query was prepared successfully
      $x = 1;
      //Checks if any item has been added to params, if any item exists, bind to preoared statement
      if(count($params)) {
        foreach ($params as $param) {
          $this->_query->bindValue($x, $param);
          $x++;
        }
      }
      
      //Execute query
      if($this->_query->execute()) {
        //Store result set and fetch object 
        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
        //Update count
        $this->_count = $this->_query->rowCount();
      } else {
        //Set error
        $this->_error = true;
      }
    }
    //Return current object
    return $this;
  }


  //To perform specific action, e.g get, read, update delete
  private function action($action, $table, $where = array()) {
    if(count($where) === 3) {
      //operator array
      $operators = array('=', '>', '<', '>=', '<=');

      //Assign items in where array to variables
      $field = $where[0];
      $operator = $where[1];
      $value = $where[2];

      //Check if operator is in the defined operatior array
      if(in_array($operator, $operators)) {
        //Query
        $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
        //If there not an error, return current object
        if(!$this->query($sql, array($value))->error()) {
          return $this;
        }
      }
    }
    //Return false
    return false;
  }


  //INSERT
  public function insert($table, $fields = array()) {
    //Check if fields has any data
    if(count($fields)) {
      //Get the keys from field array
      $keys = array_keys($fields);
      $values = null;
      $x = 1;

      //Loop through fields. 
      foreach($fields as $field) {
        $values .= '?';
        //check if x is less than count of field and append ','
        if($x < count($fields)) {
          $values .= ', ';
        }
        $x++;
      }
      //Sql Query for insert
      $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

      //If there not an error, return true
      if(!$this->query($sql, $fields)->error()) {
        return true;
      }
    }
    //Else return false
    return false;
  }

  //Update Data
  public function update($table, $id, $fields = array()) {
    $set = ""; //FOr Update Query
    $x = 1; //Counter

    //Loop through fiels
    foreach($fields as $name => $value) {
      //Bind
      $set .= "{$name} = ?";

      //check if x is less than count of field and append ','
      if($x < count($fields)) {
        $set .= ", ";
      }
      $x++;
    }

    //Update SQL query
    $sql = "UPDATE {$table} SET {$set} where id = {$id}";

    //If there not an error, return true
    if(!$this->query($sql, $fields)->error()) {
      return true;
    }

    return false;
  }


  //Returns error
  public function error() {
    return $this->_error;
  }

  //GET
  public function get($table, $where = array()) {
    //Calls action method and SELECT * as sql action
    return $this->action('SELECT *', $table, $where);
  }

  //DELETE
  public function delete($table, $where = array()) {
    return $this->action('DELETE', $table, $where);
  }

  //Retrieve results from result property
  public function results() {
    return $this->_results;
  }
  //Return first result from resutk set
  public function first() {
    return $this->results()[0];
  }

  //Reurrns count property
  public function count() {
    return $this->_count;
  }
}