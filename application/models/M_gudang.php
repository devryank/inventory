<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_gudang extends CI_Model {

    public function read($tbl)
    {
        $query = $this->db->get($tbl);
        return $query;
    }

    public function read_join($tblUtama)
    {
        $this->db->select('*');
        $this->db->from('tbl_bulan a');
        $this->db->join($tblUtama.' b', 'a.id=b.bulan');
        $this->db->join('tbl_tahun c', 'c.id=b.tahun');
        $query = $this->db->get();
        return $query->result();
    }

    public function store_pic_data()
    {
        // SIAPKAN VARIABLE INPUT
        $id = uniqid();
        $upload_data = $this->upload->data();
        $nama_barang = $this->input->post('nama_barang');
        $produsen = $this->input->post('produsen');
        $penerima = $this->input->post('penerima');
        $unit = $this->input->post('unit');
        $modal = $this->input->post('modal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        // ARRAY INPUT KE DATABASE
        $data = array(
            'id_barang' => $id,
            'nama_barang' => $nama_barang,
            'foto_barang' => $upload_data['file_name'],
            'produsen' => $produsen,
            'penerima' => $penerima,
            'unit' => $unit,
            'modal' => $modal,
            'bulan' => $bulan,
            'tahun' => $tahun
        );

        // MENGECEK ADA ATAU TIDAK BARANG YANG SAMA DENGAN YANG
        // SUDAH ADA DI DATABASE
        $get_barang = $this->db->select('*')->from('tbl_gudang')->where('nama_barang', $nama_barang)->get();
        if($get_barang->num_rows() > 0){
            if($get_barang->row()->produsen == $produsen){
                if($get_barang->row()->bulan == $bulan AND $get_barang->row()->tahun == $tahun){
                    $get_id_barang = $get_barang->row()->id;
                    $unit_awal = $get_barang->row()->unit;
                    $hasil = $unit_awal + $unit;

                    $this->db->where('id_barang', $get_id_barang);
                    $this->db->update('tbl_gudang', array('unit' => $hasil));
                } else {
                    $query = $this->db->insert('tbl_gudang', $data);    
                }
            } else {
                $query = $this->db->insert('tbl_gudang', $data);    
            }
        } else {
        // JIKA TIDAK ADA
        $query = $this->db->insert('tbl_gudang', $data);    
        }
    }

    public function addYear()
    {
        $data = array(
            'nama_tahun' => $this->input->post('nama_tahun')
        );
        $this->db->insert('tbl_tahun', $data);
    }

    public function delete($id, $tbl, $idtbl)
    {
        $this->db->where($idtbl, $id);
        $this->db->delete($tbl);
    }

    public function delete_out($id)
    {
        $this->db->where('id_barang', $id);
        $this->db->delete('tbl_barangkeluar');
    }

    public function export_gudang()
    {
        $this->db->select('*');
        $this->db->from('tbl_bulan a');
        $this->db->join('tbl_gudang b', 'a.id=b.bulan');
        $this->db->join('tbl_tahun c', 'c.id=b.tahun');
        $query = $this->db->get();
        return $query->result();
    }

    public function export_penjualan()
    {
        $this->db->select('*');
        $this->db->from('tbl_bulan a');
        $this->db->join('tbl_gudang b', 'a.id=b.bulan');
        $this->db->join('tbl_tahun c', 'c.id=b.tahun');
        $this->db->join('tbl_barangkeluar d', 'b.id_barang=d.id_barang');
        $query = $this->db->get();
        return $query->result();
    }

    public function jual($id)
    {
        $this->db->where('id_barang', $id);
        $query = $this->db->get('tbl_gudang');
        return $query->result();
    }

    public function get_id($id, $tbl)
    {
        $this->db->where('id_barang', $id);
        $query = $this->db->get($tbl);
        return $query->result();
    }

    public function max_unit()
    {
        $this->db->select('*');
        $this->db->select_max('unit_jual');
        $this->db->from('tbl_bulan a');
        $this->db->join('tbl_barangkeluar b', 'a.id=b.bulan');
        $this->db->join('tbl_tahun c', 'b.tahun=c.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function barang_out($id)
    {
        $unit = $this->input->post('unit', true);
        $produsen = $this->input->post('produsen');
        $penjual = $this->input->post('penjual');
        $jual = $this->input->post('jual');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        // AMBIL DATA DARI INPUT JUAL BARANG
        $data = array(
            'id_barang' => $this->input->post($id),
            'unit' => $unit
        );

        // QUERY UNTUK MENGAMBIL DATA SUMBER
        $this->db->select('*');
        $this->db->from('tbl_gudang');
        $this->db->where('id_barang', $id);
        $query = $this->db->get();
        $row = $query->row();           // AMBIL 1 DATA BERDASARKAN ID
        $unit_awal = $row->unit;        // AMBIL UNIT AWAL DARI DATA TSB
        $hasil = $unit_awal - $unit;    // KURANGI UNIT AWAL DENGAN INPUTAN UNIT YANG DIJUAL
        $nama_barang = $row->nama_barang;

        
        // SIAPKAN ARRAY UNTUK 'INSERT' JUMLAH UNIT 
        $keluar = array(
            'id_barang' => $id,
            'unit_jual' => $unit,
            'nama_barang' => $nama_barang,
            'produsen' => $produsen,
            'penjual' => $penjual,
            'jual' => $jual,
            'bulan' => $bulan,
            'tahun' => $tahun
        );


        $this->db->where('id_barang', $id);
        $this->db->update('tbl_gudang', array('unit' => $hasil));
        
        // QUERY UNTUK MENGAMBIL DATA BARANG YANG TELAH DIJUAL
        $query_out = $this->db->select('*')->from('tbl_barangkeluar')->where('id_barang', $id)->get();

        // ARRAY UNTUK DATA YANG BELUM PERNAH ADA DI TBL_BARANGKELUAR
        $idBaru = uniqid();
        $inputBeda = array(
            'id_barang' => $idBaru,
            'unit_jual' => $unit,
            'nama_barang' => $nama_barang,
            'produsen' => $produsen,
            'penjual' => $penjual,
            'jual' => $jual,
            'bulan' => $bulan,
            'tahun' => $tahun
        );
        
        // JIKA BARANG YANG TERJUAL MEMILIKI DATA YANG SAMA DENGAN
        // BARANG YANG TELAH ADA DI TBL_BARANGKELUAR, MAKA TAMBAHKAN
        // JUMLAH UNIT YANG LAMA DENGAN YANG BARU
        // JIKA TIDAK ADA, BUAT DATA BARU DENGAN OTOMATIS MENGINPUT
        // ID BARU
        if($query_out->row()->nama_barang == $nama_barang)
        {
            if($query_out->row()->produsen == $produsen)
            {
                if($query_out->row()->penjual == $penjual)
                {
                    if($query_out->row()->bulan == $bulan AND $query_out->row()->tahun == $tahun){
                    $row_keluar = $query_out->row();
                    $hitung_keluar = $row_keluar->unit_jual;
                    $hasil_keluar = $hitung_keluar + $unit;
                    
                    $this->db->where('id_barang', $id);
                    $this->db->update('tbl_barangkeluar', array('unit_jual' => $hasil_keluar));
                    }else{
                        $this->db->insert('tbl_barangkeluar', $inputBeda);
                    }
                }else{
                    $this->db->insert('tbl_barangkeluar', $inputBeda);
                }
            }else{
                $this->db->insert('tbl_barangkeluar', $inputBeda);
            }
        }else{
            // JIKA TIDAK ADA YANG SAMA, LANGSUNG INSERT DATA
           $this->db->insert('tbl_barangkeluar', $keluar);            
        }
    }
}
