<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Komplek
 *
 * @author RAMPA
 */
class Komplek extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('komplek/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAll("komplek");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nama_komplek;
                $val[] = $row->lat;
                $val[] = $row->lon;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idkomplek."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idkomplek."'".','."'".$row->nama_komplek."'".')"> Delete</a>'
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
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM komplek where nama_komplek = '".$this->input->post('nama')."';")->jml;
            if($jml > 0){
                $status = "Gunakan nama komplek lain";
            }else{
                $data = array(
                    'idkomplek' => $this->Mglobals->autokode("K","idkomplek","komplek", 2, 7),
                    'nama_komplek' => $this->input->post('nama'),
                    'lat' => $this->input->post('lat'),
                    'lon' => $this->input->post('lon')
                );
                $simpan = $this->Mglobals->add("komplek",$data);
                if($simpan == 1){
                    $status = "Komplek tersimpan";
                }else{
                    $status = "Komplek gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $kondisi['idkomplek'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("komplek", $kondisi);
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
