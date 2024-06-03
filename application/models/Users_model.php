<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Users_model extends CI_Model {
 
    var $table = 'users';
    var $column_order = array(null, 'nama','username','level','created_at','updated_at','status'); //set column field database for datatable orderable
    var $column_search = array('nama','username','level','created_at','updated_at'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        //add custom filter here
        if($this->input->post('nama'))
        {
            $this->db->where('nama', $this->input->post('nama'));
        }
        if($this->input->post('username'))
        {
            $this->db->like('username', $this->input->post('username'));
        }
        if($this->input->post('level'))
        {
            $this->db->like('level', $this->input->post('level'));
        }
 
        $this->db->from($this->table);
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

    public function get_list_levels()
    {
        $this->db->select('level');
        $this->db->from($this->table);
        $this->db->order_by('level','asc');
        $query = $this->db->get();
        $result = $query->result();
 
        $levels = array();
        foreach ($result as $row) 
        {
            $levels[] = $row->level;
        }
        return $levels;
    }

    
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
    function hapus_users($iduser){
        $hasil=$this->db->query("DELETE FROM users WHERE id='$iduser'");
        return $hasil;
    }
 
}