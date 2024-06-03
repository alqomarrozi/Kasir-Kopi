<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pengeluaran_model extends CI_Model {
    function get_pengeluaran(){ //ambil data kategori dari table kategori
        $hsl=$this->db->get('pengeluaran');
        return $hsl;
      }
      function get_all_pengeluaran() { //ambil data barang dari table barang yang akan di generate ke datatable
            $this->datatables->select('id_pengeluaran,tanggal,catatan,total,created_by_name');
            $this->datatables->from('pengeluaran');
            $this->db->order_by('tanggal', 'DESC');
            $this->datatables->join('users', 'users.id=created_by');
            // if()
            $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-id_pengeluaran="$1" data-tanggal="$2" data-catatan="$3" data-total="$4">Edit</a> <a href="javascript:void(0);" class="hapus_record btn btn-danger btn-sm" data-id_pengeluaran="$1">Hapus</a>',
            'id_pengeluaran,tanggal,catatan,total,created_by_name');
            return $this->datatables->generate();
      }

      function get_all_kasir() { //ambil data barang dari table barang yang akan di generate ke datatable
            $this->datatables->select('id_pengeluaran,tanggal,catatan,total,created_by_name');
            $this->datatables->from('pengeluaran');
            $this->db->order_by('tanggal', 'DESC');
            $this->datatables->join('users', 'users.id=created_by');
            $sessionuser = $this->session->userdata('id');
            $this->db->where('created_by', $sessionuser);
            $this->datatables->add_column('view', '<a href="javascript:void(0);" class="edit_record btn btn-info btn-sm" data-id_pengeluaran="$1" data-tanggal="$2" data-catatan="$3" data-total="$4">Edit</a> <a href="javascript:void(0);" class="hapus_record btn btn-danger btn-sm" data-id_pengeluaran="$1">Hapus</a>',
            'id_pengeluaran,tanggal,catatan,total,created_by_name');
            return $this->datatables->generate();
      }
      
}