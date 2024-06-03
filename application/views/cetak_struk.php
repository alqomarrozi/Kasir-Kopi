
<meta http-equiv="refresh" content="5; url=<?php echo base_url('transaksi/struk/'.$this->uri->segment(3));?>">

<?php

$this->session->set_flashdata('success', 'Berhasil dicetak');
function rupiah($nominal)
{
    $rp = number_format($nominal, 0, ',', '.');
    return $rp;
}; ?>
<?php
 
$this->load->library('escpos'); 
 
// membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
$connector = new Escpos\PrintConnectors\WindowsPrintConnector("smb://DESKTOP-DQBQIAU/POS58 Printer");

// membuat objek $printer agar dapat di lakukan fungsinya
$printer = new Escpos\Printer($connector);

// membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
    // Mengatur lebar setiap kolom (dalam satuan karakter)
    $lebar_kolom_1 = 9;
    $lebar_kolom_2 = 3;
    $lebar_kolom_3 = 7;
    $lebar_kolom_4 = 8;

    // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
    $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
    $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
    $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
    $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

    // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
    $kolom1Array = explode("\n", $kolom1);
    $kolom2Array = explode("\n", $kolom2);
    $kolom3Array = explode("\n", $kolom3);
    $kolom4Array = explode("\n", $kolom4);

    // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
    $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

    // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
    $hasilBaris = array();

    // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
    for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

        // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
        $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
        $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

        // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
        $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
        $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

        // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
        $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
    }

    // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
    return implode($hasilBaris, "\n") . "\n";
}   


// GET DATA STRUK 

$cek = $this->Model_penjualan->cek_transaksi($this->uri->segment(3));
$data = array(
    'tanggal' => $cek[0]->tgl_trf, 
    'jam' => $cek[0]->jam_trf,
    'nota' => $cek[0]->no_trf,
    'operator' => $cek[0]->operator,
    'pelanggan' => $cek[0]->nama_pelanggan,
    'total' => $cek[0]->totalpure,
    'diskon' => $cek[0]->diskon,
    'grand_total' => $cek[0]->grand_total,
    'result' => $cek,
    'metode' => $cek[0]->metode,
    'bayar' => $cek[0]->bayar,
    'kembalian' => $cek[0]->kembalian,
    'rekening' => $cek[0]->no_rek,
    'bank' => $cek[0]->nama_bank,
    'atasnama' => $cek[0]->atas_nama,
    'catatan' => $cek[0]->catatan,
);

// Membuat judul
$printer->initialize();
$printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
$printer->text("Putti Roofspace\n");
$printer->text("\n");

// Data transaksi
$printer->initialize();
$printer->text("Atas Nama : ".$data['pelanggan']."\n");
$printer->text("Kasir : ".$data['operator']. "\n");
$printer->text("Waktu : ".$data['tanggal'].' '.$data['jam']."\n"); 

// Membuat tabel
$printer->initialize(); // Reset bentuk/jenis teks 
$printer->text("--------------------------------\n");
$printer->text(buatBaris4Kolom("Items", "Qty", "Price", "Subtotal"));
$printer->text("--------------------------------\n");
foreach ($data['result'] as $row) {
$printer->text(buatBaris4Kolom("$row->produk_name", " $row->jumlah_stok ", rupiah($row->harga_produk), rupiah($row->sub_total)));
}
$printer->text("--------------------------------\n");
$printer->text(buatBaris4Kolom('Total', '', "", rupiah($data['total'])));
$printer->text(buatBaris4Kolom('Diskon', '', "", $data['diskon'].'%'));
$printer->text(buatBaris4Kolom('Grand Total', '', "", rupiah($data['grand_total'])));
$printer->text(buatBaris4Kolom('Diterima', '', "", rupiah($data['bayar'])));
$printer->text(buatBaris4Kolom('Kembali', '', "", rupiah($data['kembalian'])));
$printer->text("\n");

 // Pesan penutup
$printer->initialize();
$printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
$printer->text("Thanks for order\n");
$printer->text("Regards, Putti Roofspace\n");

$printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
$printer->close();


?>
