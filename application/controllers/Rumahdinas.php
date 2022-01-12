<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rumahdinas
 */
class Rumahdinas extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('rumah_dinas/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $no = 1;
            $list = $this->Mglobals->getAll("rumah_dinas");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->nama_rumdis;
                $val[] = $row->alamat;
                // mencari jumlah penghuni
                $jml_penghuni = 0;
                $cek_kepala = $this->Mglobals->getAllQR("select count(*) as jml from sip where idrumah_dinas = '".$row->idrumah_dinas."';")->jml;
                if($cek_kepala > 0){
                    $jml_kepala = 1;
                    $idpersonil = $this->Mglobals->getAllQR("select idpersonil from sip where idrumah_dinas = '".$row->idrumah_dinas."';")->idpersonil;
                    // mencari jumlah keluarga
                    $jml_keluarga = $this->Mglobals->getAllQR("select count(*) as jml from personil_keluarga where idpersonil = '".$idpersonil."';")->jml;
                    $jml_penghuni = $jml_kepala + $jml_keluarga;
                    $val[] = '<p style="text-align: center;">'.$jml_penghuni.'</p>';
                }else{
                    $val[] = '<p style="text-align: center;">'.$jml_penghuni.'</p>';
                }
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idrumah_dinas."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idrumah_dinas."'".','."'".$no."'".')"> Delete</a>'
                        . '</div>';
                $data[] = $val;
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add() {
        if($this->session->userdata('logged')){
            $data = array(
                'idrumah_dinas' => $this->Mglobals->autokode("R","idrumah_dinas","rumah_dinas", 2, 7),
                'nama_rumdis' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat')
            );
            $simpan = $this->Mglobals->add("rumah_dinas",$data);
            if($simpan == 1){
                $status = "Data tersimpan";
            }else{
                $status = "Data gagal tersimpan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $kondisi['idrumah_dinas'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("rumah_dinas", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $data = array(
                'nama_rumdis' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat')
            );
            $kond['idrumah_dinas'] = $this->input->post('kode');
            $update = $this->Mglobals->update("rumah_dinas",$data, $kond);
            if($update == 1){
                $status = "Data terupdate";
            }else{
                $status = "Data gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $kondisi['idrumah_dinas'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("rumah_dinas",$kondisi);
            if($hapus == 1){
                $status = "Data terhapus";
            }else{
                $status = "Data gagal terhapus";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
}
