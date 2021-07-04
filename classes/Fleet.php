<?php
class Fleet {
    //Declare private property
  private $_db,
          $_data;

  public function __construct() {
      //Connect to db, if not already connected
    $this->_db = DB::getInstance();
  }

  public function create($fields = array()) {
      //Insert into db
    if(!$this->_db->insert('fleet', $fields)) {
        //throw error if any
      throw new Exception('There was a problem creating an account.');
    }
  }

  public function findAll() {
      //Return all data in table
    $result = $this->_db->query("SELECT * FROM fleet");
    if($result->count()) {
        //Assign to data property
        $this->_data = $result->results();
        //Return data
        return $this->data();
      }
  }

  public function find($id = null) {
      //Get Id to find with
    if($id) {
      $field = 'id';
      //Find in fleet table with specified id
      $data = $this->_db->get('fleet', array($field, '=', $id));

      if($data->count()) {
          //Return first match
        $this->_data = $data->first();
        return $this->data();
      }
    }
  }

  public function update($id, $fields = array()){
      //Update existing item in db
      if(!$this->_db->update('fleet', $id, $fields)){
          //Throw error if any
          throw new Exception('There was a problem updating field');
      }
  }

  public function delete($id){
      //Delete Existing record in db
      //Specify where field
      $field = 'id';
      //Check if operation was successful
      if(!$this->_db->delete('fleet', array($field, '=', $id))){
        //Throw error if any
        throw new Exception('Cant Delete now');
      }
  }



  public function data() {
      //Return query result
    return $this->_data;
  }

}