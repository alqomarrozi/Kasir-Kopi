<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }
 
 
    public function registerData($user_id = NULL) {
        if (!$user_id) {
            $user_id = $this->session->userdata('id');
        }
        // if (!$kode_register) {
        $kode_register = $this->session->userdata('kode_register');
        // }
        $q = $this->db->get_where('registers', array('user_id' => $user_id, 'status_shift' => 'open', 'kode_register' => $kode_register), 1);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
    }

    public function registerDataBefore($shift_name = NULL, $kode_register = NULL) {
        $shift_name = $this->session->userdata('shift_name');
        $kode_register = $this->session->userdata('kode_register');
        $q = $this->db->get_where('registers', array('shift_name' => $shift_name, 'status_shift' => 'open', 'kode_register' => $kode_register), 1);
        if ($q->num_rows() > 0) {
            return $q->row(); 
        }
        return FALSE;
    }

    public function openRegister($data) {
        if ($this->db->insert('registers', $data)) {
            return true;
        }
        return FALSE; 
    }
 
 
    public function getRegisterCashSales($date = NULL, $username = NULL) {
        if (!$date) {
            $date = $this->session->userdata('register_open_time');
            // echo $date;
        }
        if (!$username) {
            $username = $this->session->userdata('username');
        }
        $date = $this->session->userdata('register_open_time');
        $this->db->select('COUNT(' . $this->db->dbprefix('detail_penjualan') . '.id) as total_cc_slips, SUM( COALESCE( detail_penjualan.grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid',  FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left')
            ->where('CONCAT(detail_penjualan.tgl_trf, detail_penjualan.jam_trf) >', $date)
            ->where("{$this->db->dbprefix('detail_penjualan')}.id_pembayaran", '1');
        $this->db->where('detail_penjualan.operator', $username);

        $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
    public function getRegisterCashSalesBefore($date = NULL, $username = NULL) {
        if (!$date) {
            $date = $this->session->userdata('register_open_time');
        }
        if (!$username) {
            $username = $this->session->userdata('shift_name');
        }
        $date = $this->session->userdata('register_open_time');
        $this->db->select('COUNT(' . $this->db->dbprefix('detail_penjualan') . '.id) as total_cc_slips, SUM( COALESCE( detail_penjualan.grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid', FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left')
            ->where('CONCAT(detail_penjualan.tgl_trf, detail_penjualan.jam_trf) >', $date)->where("{$this->db->dbprefix('detail_penjualan')}.id_pembayaran", '1');
        $this->db->where('detail_penjualan.operator', $username);

        $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

    
    public function getRegisterSales($kode_register = NULL) {
        // if (!$date) {
        //     $date = $this->session->userdata('register_open_time');
        // }
        if (!$kode_register) {
            $kode_register = $this->session->userdata('kode_register');
        }
        // if (!$register_id) {
        //     $register_id = $this->session->userdata('register_id');
        // }
        $datenow = date('Y-m-d H:i:s');
        $this->db->select('SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid, tgl_trf', FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left');
            // ->where('penjualan.created_penjualan >', $date);
            $this->db->where('detail_penjualan.kode_register', $kode_register);

            $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
    public function getRegisterSalesBefore($kode_register = NULL) {
        // if (!$date) {
        //     $date = $this->session->userdata('register_open_time');
        //     $datenow = date('Y-m-d H:i:s');
        // }
        if (!$kode_register) {
            $kode_register = $this->session->userdata('kode_register');
        }
        // if (!$register_id) {
        //     $register_id = $this->session->userdata('register_id');
        // }
        $this->db->select('SUM( COALESCE( grand_total, 0 ) ) AS total, SUM( COALESCE( bayar, 0 ) ) AS paid, tgl_trf', FALSE)
            ->join('penjualan', 'penjualan.id_dtlpen=detail_penjualan.id', 'left');
            // ->where('CONCAT(detail_penjualan.tgl_trf, detail_penjualan.jam_trf) >', $date);
            $this->db->where('detail_penjualan.kode_register', $kode_register);
            $q = $this->db->get('detail_penjualan');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }

     
    public function getRegisterExpenses($kode_register = NULL) {
        // if (!$date) {
        //     $date = $this->session->userdata('register_open_time');
        // }
        if (!$kode_register) {
            $kode_register = $this->session->userdata('kode_register');
        }
        $this->db->select('SUM( COALESCE( total, 0 ) ) AS total', FALSE);
            // ->where('tanggal >', $date);
        $this->db->where('kode_register', $kode_register);

        $q = $this->db->get('pengeluaran');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
   
    public function getRegisterExpensesBefore($kode_register = NULL) {
        // if (!$date) {
        //     $date = $this->session->userdata('register_open_time');
        // }
        if (!$kode_register) {
            $kode_register = $this->session->userdata('kode_register');
        }
        $this->db->select('SUM( COALESCE( total, 0 ) ) AS total', FALSE);
            // ->where('tanggal >', $date);
        $this->db->where('kode_register', $kode_register);

        $q = $this->db->get('pengeluaran');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return false;
    }
 
    function close_register($total_cash, $pendapatan, $pengeluaran, $note){
        $data = array(
	        // 'id' => $this->session->userdata('register_id'),
	        'date' => $this->session->userdata('register_open_time'),
			'closed_by' => $this->session->userdata('id'),
			'closed_at' => date('Y-m-d H:i:s'),
			'status_shift' => 'close',
            'total_cash' => $total_cash,
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran, 
            'note' => $note 
		);
		$this->db->where('kode_register', $this->session->userdata('kode_register'));
		$this->db->update('registers', $data);
	}
	
    function kode_register(){
		$this->db->select('RIGHT(registers.kode_register,2) as kode_register', FALSE);
			  $this->db->order_by('kode_register','DESC');    
			  $this->db->limit(1);    
			  $query = $this->db->get('registers');  //cek dulu apakah ada sudah ada kode di tabel.    
			  if($query->num_rows() <> 0){      
				   //cek kode jika telah tersedia    
				   $data = $query->row();      
				   $kode = intval($data->kode_register) + 1; 
			  }
			  else{      
				   $kode = 1;  //cek jika kode belum terdapat pada table
			  }
				  $tgl=date('dmY'); 
				  $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);    
				  $kodetampil = 'REG'.$batas;  //format kode
				  return $kodetampil;  
        }

}