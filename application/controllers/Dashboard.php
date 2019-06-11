<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_gudang');
        $this->load->model('m_user');
    }

    public function index()
    {
        $data['title'] = 'Welcome ' .$this->session->userdata['name'];
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['max'] = $this->m_gudang->max_unit();
        $this->load->view('partials/_header', $data);
        $this->load->view('index');        
    }

    public function gudang()
    {
        $tblUtama = 'tbl_gudang';
        $data['title'] = 'Gudang';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['gudang'] = $this->m_gudang->read_join($tblUtama);
        $this->load->view('partials/_header', $data);
        $this->load->view('gudang');   
    }

    // TAMBAH BARANG KE GUDANG
    public function add()
    {
        $data['title'] = 'Tambah Barang';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['bulan'] = $this->m_gudang->read('tbl_bulan')->result();
        $data['tahun'] = $this->m_gudang->read('tbl_tahun')->result();

        // VALIDATION RULES INPUT
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('produsen', 'Produsen', 'required');
        $this->form_validation->set_rules('penerima', 'Penerima', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('modal', 'Modal', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('partials/_header', $data);
            $this->load->view('add');  
        } else {

            // CONFIG UPLOAD
            $config['upload_path']          = './assets/upload/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            // LOAD LIBRARY UPLOAD
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('foto_barang'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('add', $error);
            } else {
                $this->m_gudang->store_pic_data();
                redirect('dashboard/gudang');   
            }
        }
    }

    // JUAL BARANG
    public function jual($id)
    {
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('produsen', 'Produsen', 'required');
        $this->form_validation->set_rules('penjual', 'penjual', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Jual Barang';
            $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['jual'] = $this->m_gudang->jual($id);
            $data['bulan'] = $this->m_gudang->read('tbl_bulan')->result();
            $data['tahun'] = $this->m_gudang->read('tbl_tahun')->result();
            $this->load->view('partials/_header', $data);
            $this->load->view('jual');  
        }else{
                $this->m_gudang->barang_out($id);
                redirect('dashboard/out');
        }
    }

    public function detail($id)
    {
        $tbl = 'tbl_gudang';
        $data['title'] = 'Detail';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['detail'] = $this->m_gudang->get_id($id, $tbl);
        $this->load->view('partials/_header', $data);
        $this->load->view('detail');   
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->m_gudang->delete($id, 'tbl_gudang', 'id_barang');

        redirect('dashboard/gudang');
    }

    public function delete_out()
    {
        $id = $this->uri->segment(3);
        $this->m_gudang->delete_out($id);

        redirect('dashboard/out');
    }

    public function out()
    {
        $tblUtama = 'tbl_barangkeluar';
        $data['title'] = 'Barang Keluar';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['keluar'] = $this->m_gudang->read_join($tblUtama);
        $this->load->view('partials/_header', $data);
        $this->load->view('barangkeluar');  
    }

    public function user()
    {
        if($this->session->userdata['level'] != 1){
          redirect('dashboard/index');
        }
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['row'] = $this->m_gudang->read('tbl_user')->result();   
        $this->load->view('partials/_header', $data);
        $this->load->view('user');  
    }

    public function add_user()
    {
        if($this->session->userdata['level'] != 1){
          redirect('dashboard/index');
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE)
        {
        $data['title'] = 'Tambah User';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('partials/_header', $data);
        $this->load->view('add_user');
        } else {
          $this->m_user->registrationFromUser();
          redirect('dashboard/user');
        }
    }

    public function edit_user($id)
    {
        if($this->session->userdata['level'] != 1){
          redirect('dashboard/index');
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->form_validation->run() == FALSE)
        {
          $data['title'] = 'Edit User';
          $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
          $data['edit'] = $this->m_user->get_id($id, 'tbl_user');
          $this->load->view('partials/_header', $data);
          $this->load->view('edit_user');
        } else {
            $this->m_user->update($id);
            redirect('dashboard/user');
        }
    }

    // ACTIVATE USER
    public function activate($id)
    {
        $this->m_user->activate($id);
        redirect('dashboard/user');
    }

    public function add_year()
    {
        if($this->session->userdata['level'] != 1){
          redirect('dashboard/index');
        }
        $this->form_validation->set_rules('nama_tahun', 'Nama Tahun', 'required');

        if($this->form_validation->run() == FALSE)
        {
        $data['title'] = 'Tambah User';
        $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('partials/_header', $data);
        $this->load->view('add_year');
        } else {
          $this->m_gudang->addYear();
          redirect('dashboard/tahun');
        }
    }

    public function delete_tahun()
    {
      $id = $this->uri->segment(3);
      $this->m_gudang->delete($id, 'tbl_tahun', 'id');

      redirect('dashboard/tahun');
    }

    public function tahun()
    {
      if($this->session->userdata['level'] != 1){
        redirect('dashboard/index');
      }
      $data['title'] = 'Tahun';
      $data['user'] = $this->db->get_where('tbl_user', ['email' => $this->session->userdata('email')])->row_array();
      $data['row'] = $this->m_gudang->read('tbl_tahun')->result();   
      $this->load->view('partials/_header', $data);
      $this->load->view('tahun');  
    }

    public function export_gudang(){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel.php';
        
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                     ->setLastModifiedBy('My Notes Code')
                     ->setTitle("Data Gudang")
                     ->setSubject("Gudang")
                     ->setDescription("Laporan Semua Barang yang Disimpan")
                     ->setKeywords("Data Gudang");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA GUDANG"); // Set kolom A1 dengan tulisan "DATA GUDANG"
        $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai G1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA BARANG"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "PRODUSEN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "PENERIMA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "UNIT GUDANG"); 
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "HARGA / UNIT"); 
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "BULAN TERIMA"); 
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        
        $query = $this->m_gudang->export_gudang();
        $barang = $query;
        
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($barang as $data){ // Lakukan looping pada variabel siswa
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_barang);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->produsen);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->penerima);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->unit);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, 'Rp '.$data->modal);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->nama_bulan.' '.$data->nama_tahun);
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          
          $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Laporan Data Gudang");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Rekap Gudang.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
        ob_end_clean();
      }

    public function export_penjualan(){
          // Load plugin PHPExcel nya
          include APPPATH.'third_party/PHPExcel.php';
          
          // Panggil class PHPExcel nya
          $excel = new PHPExcel();
          // Settingan awal fil excel
          $excel->getProperties()->setCreator('My Notes Code')
                       ->setLastModifiedBy('My Notes Code')
                       ->setTitle("Data Gudang")
                       ->setSubject("Gudang")
                       ->setDescription("Laporan Semua Barang yang Dijual")
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
          $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA GUDANG"); // Set kolom A1 dengan tulisan "DATA GUDANG"
          $excel->getActiveSheet()->mergeCells('A1:i1'); // Set Merge Cell pada kolom A1 sampai I1
          $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
          $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
          $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
          // Buat header tabel nya pada baris ke 3
          $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
          $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA BARANG"); 
          $excel->setActiveSheetIndex(0)->setCellValue('C3', "PRODUSEN"); 
          $excel->setActiveSheetIndex(0)->setCellValue('D3', "PENERIMA"); 
          $excel->setActiveSheetIndex(0)->setCellValue('E3', "UNIT GUDANG"); 
          $excel->setActiveSheetIndex(0)->setCellValue('F3', "UNIT TERJUAL"); 
          $excel->setActiveSheetIndex(0)->setCellValue('G3', "HARGA JUAL / UNIT"); 
          $excel->setActiveSheetIndex(0)->setCellValue('H3', "UNTUNG / UNIT"); 
          $excel->setActiveSheetIndex(0)->setCellValue('I3', "BULAN DIKIRIM"); 
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
          // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
          
          $query = $this->m_gudang->export_penjualan();
          $barang = $query;
          
          $no = 1; // Untuk penomoran tabel, di awal set dengan 1
          $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
          foreach($barang as $data){ // Lakukan looping pada variabel siswa
            $untung = $data->jual-$data->modal;
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_barang);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->produsen);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->penerima);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->unit);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->unit_jual);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, 'Rp '.$data->modal);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, 'Rp '.$data->jual);
            $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, 'Rp '. $untung);
            $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->nama_bulan.' '.$data->nama_tahun);
            
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
          // Set width kolom
          $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
          $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
          $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
          $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
          $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
          $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom F
          $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom G
          $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom G
          $excel->getActiveSheet()->getColumnDimension('I')->setWidth(30); // Set width kolom G
          
          // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
          $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
          // Set orientasi kertas jadi LANDSCAPE
          $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
          // Set judul file excel nya
          $excel->getActiveSheet(0)->setTitle("Laporan Data Penjualan");
          $excel->setActiveSheetIndex(0);
          // Proses file excel
          ob_end_clean();
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header('Content-Disposition: attachment; filename="Rekap Penjualan.xlsx"'); // Set nama file excel nya
          header('Cache-Control: max-age=0');
          $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
          $write->save('php://output');
          ob_end_clean();
        }
}
