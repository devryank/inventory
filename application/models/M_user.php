<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function read($tbl)
    {
        $query = $this->db->get($tbl);
        return $query->result();
    }

    public function activate($id)
    {
        $data = array(
            'is_active' => '1'
        );
        $this->db->where('id', $id);
        $this->db->update('tbl_user', $data);
    }

    public function registration()
    {
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'level' => $this->input->post('level')
          ];

        $this->db->insert('tbl_user', $data);
    }

    public function registrationFromUser()
    {
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'level' => $this->input->post('level'),
            'is_active' => '1'
          ];

        $this->db->insert('tbl_user', $data);
    }
    
    public function get_id($id, $tbl)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($tbl);
        return $query->result();
    }

    public function update($id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'level' => $this->input->post('level'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)            
        );

        $this->db->where('id', $id);
        $this->db->update('tbl_user', $data);
    }
    public function delete($id, $tbl)
    {
        $this->db->where('id', $id);
        $this->db->delete($tbl);
    }
}