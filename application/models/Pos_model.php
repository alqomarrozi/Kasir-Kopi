<?php
class Pos_model extends CI_Model{
 
    function get_all_produk(){
        $hasil=$this->db->get('produk');
        return $hasil->result();
    }
     
}