<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sipuser
 */
class Sipuser extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            // mencari nrp dan nama
            $jml_personil = $this->Mglobals->getAllQR("select count(*) as jml from personil where nrp = '".$ses['nrp']."';")->jml;
            if($jml_personil > 0){
                $personil = $this->Mglobals->getAllQR("select * from personil where nrp = '".$ses['nrp']."';");
                $data['nm_personil'] = $personil->nama;
                
                // mencari rumah dinas
                $jml_rumah = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM rumah_dinas where idpersonil = '".$ses['iduser']."';")->jml;
                if($jml_rumah > 0){
                    $rumah = $this->Mglobals->getAllQR("SELECT idrumah_dinas, nama_rumdis, alamat FROM rumah_dinas where idpersonil = '".$ses['iduser']."';");
                    $data['rumah_dinas'] = $rumah->nama_rumdis.' - '.$rumah->alamat;
                    
                    // mencari data sip
                    $jml_sip = $this->Mglobals->getAllQR("SELECT count(no_sip) as jml FROM sip where idpersonil = '".$personil->idpersonil."' and idrumah_dinas = '".$rumah->idrumah_dinas."';")->jml;
                    if($jml_sip > 0){
                        $sip = $this->Mglobals->getAllQR("SELECT no_sip FROM sip where idpersonil = '".$personil->idpersonil."' and idrumah_dinas = '".$rumah->idrumah_dinas."';");
                        $data['no_sip'] = $sip->no_sip;
                    }else{
                        $data['no_sip'] = "";
                    }
                }else{
                    $data['rumah_dinas'] = "";
                }
            
            }else{
                $data['nm_personil'] = "";
                $data['rumah_dinas'] = "";
                $data['no_sip'] = "";
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu_user');
            $this->load->view('sip/user');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function unduhfile() {
        if($this->session->userdata('loggeduser')){
            $this->load->helper('download');
            $idsip = $this->modul->dekrip_url($this->uri->segment(3));
            $cek = $this->Mglobals->getAllQR("select count(*) as jml from sip where idsip = '".$idsip."';")->jml;
            if($cek > 0){
                $berkas = $this->Mglobals->getAllQR("select berkas from sip where idsip = '".$idsip."';")->berkas;
                if(strlen($berkas) > 0){
                    if(file_exists($berkas)){
                        force_download($berkas, NULL);
                    }
                }
            }else{
                $this->modul->pesan_halaman("Dokumen tidak ditemukan","sip");
            }
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $idusers = $ses['iduser'];
            $nrp = $ses['nrp'];
            // mencari id personil
            $jml_personil = $this->Mglobals->getAllQR("select count(*) as jml from personil where nrp = '".$nrp."';")->jml;
            if($jml_personil > 0){
                $personil = $this->Mglobals->getAllQR("select * from personil where nrp = '".$nrp."';");
                // cek rumah dinas
                $jml_rumah = $this->Mglobals->getAllQR("select count(*) as jml from rumah_dinas where idpersonil = '".$idusers."';")->jml;
                if($jml_rumah > 0){
                    $status = $this->sub_proses($idusers, $personil->idpersonil);
                }else{
                    $status = "Silakan menginput data rumah anda pada menu rumah dinas";
                }
            }else{
                $status = "Silakan menginput data diri pada menu profile";
            }
            
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function sub_proses($idusers, $idpersonil) {
        $config['upload_path'] = './assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '8024'; //8 MB

        $mode = "simpan";
        $jml = $this->Mglobals->getAllQR("select count(*) as jml from sip where idpersonil = '".$idpersonil."';")->jml;
        if($jml > 0){
            $mode = "update";
        }

        if (isset($_FILES['file']['name'])) {
            if(0 < $_FILES['file']['error']) {
                $status = "Error during file upload ".$_FILES['file']['error'];
            }else{
                if($mode == "simpan"){
                    $status = $this->simpandenganfoto($config,$idusers, $idpersonil);
                }else if($mode == "update"){
                    $status = $this->updatedenganfoto($config, $idusers, $idpersonil);
                }
            }
        }else{
            if($mode == "simpan"){
                $status = "Dokumen SIP wajib disertakan";
            }else if($mode == "update"){
                $status = $this->update_tanpa_file($idusers, $idpersonil);
            }
        }
        return $status;
    }


    private function simpandenganfoto($config, $idusers, $idpersonil) {
        // mencari id rumah dinas berdasarkan id personil
        $idrumah_dinas = $this->Mglobals->getAllQR("select idrumah_dinas from rumah_dinas where idpersonil = '".$idusers."';")->idrumah_dinas;
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'idsip' => $this->Mglobals->autokode('S','idsip', 'sip', 2, 7),
                'idpersonil' => $idpersonil,
                'idrumah_dinas' => $idrumah_dinas,
                'no_sip' => $this->input->post('no_sip'),
                'berkas' => $path
            );
            $simpan = $this->Mglobals->add("sip",$data);
            if($simpan == 1){
                $status = "Data tersimpan";
            }else{
                $status = "Data gagal tersimpan";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function updatedenganfoto($config, $idusers, $idpersonil) {
        // mencari id rumah dinas berdasarkan id personil
        $idrumah_dinas = $this->Mglobals->getAllQR("select idrumah_dinas from rumah_dinas where idpersonil = '".$idusers."';")->idrumah_dinas;
        
        $lawas = $this->Mglobals->getAllQR("select berkas from sip where idpersonil = '".$idpersonil."' and idrumah_dinas = '".$idrumah_dinas."';")->berkas;
        if(strlen($lawas) > 0){
            if(file_exists($lawas)){
                unlink($lawas);
            }
        }
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'no_sip' => $this->input->post('no_sip'),
                'berkas' => $path
            );
            $kond['idpersonil'] = $idpersonil;
            $kond['idrumah_dinas'] = $idrumah_dinas;
            $update = $this->Mglobals->update("sip",$data, $kond);
            if($update == 1){
                $status = "Data terupdate";
            }else{
                $status = "Data gagal terupdate";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function update_tanpa_file($idusers, $idpersonil) {
        $idrumah_dinas = $this->Mglobals->getAllQR("select idrumah_dinas from rumah_dinas where idpersonil = '".$idusers."';")->idrumah_dinas;
        $data = array(
            'no_sip' => $this->input->post('no_sip')
        );
        $kond['idpersonil'] = $idpersonil;
        $kond['idrumah_dinas'] = $idrumah_dinas;
        $update = $this->Mglobals->update("sip",$data, $kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
}
