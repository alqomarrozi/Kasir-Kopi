<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_m extends CI_Model
{
    public function get_stock($id = null)
    {
        $this->db->select('*');
        $this->db->from('t_stock');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('stock');
        $this->db->join('bahan', 'bahan.id_bahan=stock.bahan_id');
        if ($id != null) {
            $this->db->where('bahan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_in()
    {
        $this->db->select('*');
        $this->db->from('stock');
        $this->db->join('bahan', 'bahan.id_bahan=stock.bahan_id');
        $this->db->join('users', 'stock.user_id=users.id', 'left');
        // $this->db->join('supplier', 'supplier.supplier_id=t_stock.supplier_id', 'left');
        $this->db->where('type', 'in');
        $query = $this->db->get();
        return $query;
    } 


    public function get_stock_out()
    {
        $this->db->select('*');
        $this->db->from('stock');
        $this->db->join('bahan', 'bahan.id_bahan=stock.bahan_id');
        $this->db->join('users', 'stock.user_id=users.id', 'left');
        // $this->db->join('supplier', 'supplier.supplier_id=t_stock.supplier_id', 'left');
        $this->db->where('type', 'out');
        $query = $this->db->get();
        return $query;
    } 

    public function add_stock_in($post)
    {
        $data = [
            'bahan_id' => $post['bahan_id'],
            'type' => 'in', 
            'detail' => $post['detail'],
            // 'supplier_id' => $post['supplier'] == null ? null : $post['supplier'],
            'supplier_id' => 1,
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('id')
        ];
 
        $this->db->insert('stock', $data);
    }

    public function add_stock_out($post)
    {
        $data = [
            'bahan_id' => $post['bahan_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('id')
        ];

        $this->db->insert('stock', $data);
    }

    public function del($id)
    {
        $this->db->where('id_stock', $id);
        $this->db->delete('stock');
    }
}
