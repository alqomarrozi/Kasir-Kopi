<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_model {
function cek_login($username, $password)
{
  $this->db->select("*");
  $this->db->from("users");
  $this->db->where("username", $username);
  $query = $this->db->get();
  $user = $query->row();

  /**
   * Check password
   */
   if (!empty($user)) {

      if (password_verify($password, $user->password)) {

          return $query->result();

      } else {

          return FALSE;

      }

    } else {

       return FALSE;

    }
}
}
