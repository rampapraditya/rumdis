<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pangkat
 */
class Pangkat extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('pangkat/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAll("pangkat");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nama_pangkat;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idpangkat."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idpangkat."'".','."'".$row->nama_pangkat."'".')"> Delete</a>'
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
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM pangkat where nama_pangkat = '".$this->input->post('nama')."';")->jml;
            if($jml > 0){
                $status = "Gunakan nama pangkat lain";
            }else{
                $data = array(
                    'idpangkat' => $this->Mglobals->autokode("P","idpangkat","pangkat", 2, 7),
                    'nama_pangkat' => $this->input->post('nama')
                );
                $simpan = $this->Mglobals->add("pangkat",$data);
                if($simpan == 1){
                    $status = "Pangkat tersimpan";
                }else{
                    $status = "Pangkat gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $kondisi['idpangkat'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("pangkat", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $data = array(
                'nama_pangkat' => $this->input->post('nama')
            );
            $kond['idpangkat'] = $this->input->post('kode');
            $update = $this->Mglobals->update("pangkat",$data, $kond);
            if($update == 1){
                $status = "Pangkat terupdate";
            }else{
                $status = "Pangkat gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $kondisi['idpangkat'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("pangkat",$kondisi);
            if($hapus == 1){
                $status = "Pangkat terhapus";
            }else{
                $status = "Pangkat gagal terhapus";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
}
