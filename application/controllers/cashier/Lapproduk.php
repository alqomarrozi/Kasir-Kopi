<?php


class Lapproduk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert
			alert-primary" role="alert"><div class="alert-body">Login terlebih dahulu!</div></div>');
            $url=base_url('auth');
            redirect($url);
        };
        $this->load->model('Model_laporan');
    }  

    function index() 
    {
        if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                $tgl = $_GET['tanggal'];
                $label = 'Data Transaksi Tanggal '.date('d M Y', strtotime($tgl));
                $url_export = 'lapproduk/export?filter=1&tanggal='.$tgl;
                $transaksi = $this->Model_laporan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Model_laporan
            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun']; 
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
                $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_export = 'lapproduk/export?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $transaksi = $this->Model_laporan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Model_laporan
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $label = 'Data Transaksi Tahun '.$tahun;
                $url_export = 'lapproduk/export?filter=3&tahun='.$tahun;
                $transaksi = $this->Model_laporan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di Model_laporan
            } 
        }else{ // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Transaksi';
            $url_export = 'lapproduk/export';
            $transaksi = $this->Model_laporan->view_all(); // Panggil fungsi view_all yang ada di Model_laporan
        }
        $data['label'] = $label;
        $data['url_export'] = base_url('manager/'.$url_export);
        $data['transaksi'] = $transaksi;
        $data['option_tahun'] = $this->Model_laporan->option_tahun();
            $this->manager->display('manager/laporan/products',$data);
    }

    
  
  public function export(){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('PuttiRoofspace')
                 ->setLastModifiedBy('Putti Roofspace')
                 ->setTitle("Laporan Putti Roofspace")
                 ->setSubject("Penjualan Produk")
                 ->setDescription("Laporan Penjualan Seluruh Data Produk")
                 ->setKeywords("Data Penjualan");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user

        if($filter == '1'){ // Jika filter nya 1 (per tanggal)
            $tgl = $_GET['tanggal'];

            $label = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
            $transaksi = $this->Model_laporan->view_by_date($tgl); // Panggil fungsi view_by_date yang ada di Model_laporan
        }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

            $label = 'Data Transaksi Bulan '.$nama_bulan[$bulan].' '.$tahun;
            $transaksi = $this->Model_laporan->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di Model_laporan
        }else{ // Jika filter nya 3 (per tahun)
            $tahun = $_GET['tahun'];
            $label = 'Data Transaksi Tahun '.$tahun;
            $transaksi = $this->Model_laporan->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di Model_laporan
        }
    }else{ // Jika user tidak mengklik tombol tampilkan
        $label = 'Semua Data Transaksi';
        $transaksi = $this->Model_laporan->view_all(); // Panggil fungsi view_all yang ada di Model_laporan
    }
    $excel->setActiveSheetIndex(0);
    $excel->getActiveSheet()->setCellValue('A1', "Data Penjualan Putti Coffee"); 
    $excel->getActiveSheet()->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1

    $excel->getActiveSheet()->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
    $excel->getActiveSheet()->mergeCells('A2:I2'); // Set Merge Cell pada kolom A2 sampai E2

    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
  
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "TANGGAL"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "KODE TRANSAKSI"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA PRODUK"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "JUMLAH PRODUK"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "MODAL"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "PAJAK"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "PEMASUKAN"); // Set kolom E3 dengan tulisan "ALAMAT"
    $excel->setActiveSheetIndex(0)->setCellValue('I3', "LABA"); // Set kolom E3 dengan tulisan "ALAMAT"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    $i = 3;
    $total = 0;
    foreach($transaksi as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->tgl_trf);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->no_trf);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->produk_name);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->jumlah_stok);
      
      $grand_total = $data->grand_total;
      $pajak = $data->pajak_produk*$data->jumlah_stok;
      $modal = $data->modal_produk*$data->jumlah_stok;
      $laba = $grand_total-$pajak-$modal;
      
				$jumlah_produk[] = $data->jumlah_stok; $total_terjual = array_sum($jumlah_produk);
				$pajak_produk[] = $pajak; $total_pajak = array_sum($pajak_produk);
				$modal_produk[] = $modal; $total_modal = array_sum($modal_produk);
				$income[] = $grand_total; $total_pemasukan = array_sum($income);
				$keuntungan[] = $laba; $total_keuntungan = array_sum($keuntungan);

      $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $modal);
      $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $pajak);
      $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $grand_total);
      $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $laba);

      //   Menghitung Total
    $lastRow = $excel->setActiveSheetIndex(0)->getHighestDataRow();	
      $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $lastRow+1, $total_terjual);
      $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $lastRow+1, $total_modal);
      $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $lastRow+1, $total_pajak);
      $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $lastRow+1, $total_pemasukan);
      $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $lastRow+1, $total_keuntungan);
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
     
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
      
    }
    
    $lastRow = $excel->setActiveSheetIndex(0)->getHighestDataRow();	
    $excel->getActiveSheet()->mergeCellsByColumnAndRow(1, $lastRow, 3, $lastRow);
    $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $lastRow, 'JUMLAH');
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 8, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 7, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 6, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 5, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 4, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 3, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 2, $lastRow)->applyFromArray($style_row);
    $excel->getActiveSheet()->getStyleByColumnAndRow(0, $lastRow, 1, $lastRow)->applyFromArray($style_row);

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(20); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25); // Set width kolom E
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Set width kolom E

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan");
    $excel->setActiveSheetIndex(0);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="PuttiRoofspace '.$label.'.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }
    
}
