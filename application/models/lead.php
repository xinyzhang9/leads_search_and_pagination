<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lead extends CI_Model {
  public function all()
  {
    return $this->db->query("SELECT * FROM leads")->result_array();
  }

  public function pagination_all($info){
    $query = "SELECT * FROM leads
              LIMIT ?,?";
    $values = array($info['start'],$info['num_each_page']);
    return $this->db->query($query,$values)->result_array();

  }

  public function pagination($info){
    $query = "SELECT * FROM leads 
              WHERE  first_name = ? AND last_name = ?
              AND registered_datetime >= ? AND registered_datetime <=?
              LIMIT ?,?";
    $values = array($info['first_name'],$info['last_name'],
                    $info['date_from'],$info['date_to'],
                    $info['start'],$info['num_each_page']);
    return $this->db->query($query,$values)->result_array();
  }

  public function pagination_date($info){
    $query = "SELECT * FROM leads 
              WHERE registered_datetime >= ? AND registered_datetime <=?
              LIMIT ?,?";
    $values = array(
                    $info['date_from'],$info['date_to'],
                    $info['start'],$info['num_each_page']);
    return $this->db->query($query,$values)->result_array();
  }


  public function search($info){
    $query = "SELECT * FROM leads 
              WHERE  first_name = ? AND last_name = ?
              AND registered_datetime >= ? AND registered_datetime <=?";
    $values = array($info['first_name'],$info['last_name'],
                    $info['date_from'],$info['date_to']);
    return $this->db->query($query,$values)->result_array();
  }

  public function search_date($info){
    $query = "SELECT * FROM leads 
              WHERE registered_datetime >= ? AND registered_datetime <=?";
    $values = array(
                    $info['date_from'],$info['date_to']
                    );
    return $this->db->query($query,$values)->result_array();
  }

}
?>