<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Korps
 */
class Korps extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('korps/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAll("korps");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nama_korps;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idkorps."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idkorps."'".','."'".$row->nama_korps."'".')"> Delete</a>'
                        . '</div>';
                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add() {
        if($this->session->userdata('logged')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM korps where nama_korps = '".$this->input->post('nama')."';")->jml;
            if($jml > 0){
                $status = "Gunakan nama korps lain";
            }else{
                $data = array(
                    'idkorps' => $this->Mglobals->autokode("K","idkorps","korps", 2, 7),
                    'nama_korps' => $this->input->post('nama')
                );
                $simpan = $this->Mglobals->add("korps",$data);
                if($simpan == 1){
                    $status = "Korps tersimpan";
                }else{
                    $status = "Korps gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $kondisi['idkorps'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("korps", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $data = array(
                'nama_korps' => $this->input->post('nama')
            );
            $kond['idkorps'] = $this->input->post('kode');
            $update = $this->Mglobals->update("korps",$data, $kond);
            if($update == 1){
                $status = "Korps terupdate";
            }else{
                $status = "Korps gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $kondisi['idkorps'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("korps",$kondisi);
            if($hapus == 1){
                $status = "Korps terhapus";
            }else{
                $status = "Korps gagal terhapus";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
}
