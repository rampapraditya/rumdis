<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rumahdinasuser
 */
class Rumahdinasuser extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            // mendapatkan rumah dinas untuk dirinya sndiri
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM rumah_dinas WHERE idpersonil = '".$ses['iduser']."';")->jml;
            if($jml > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM rumah_dinas WHERE idpersonil = '".$ses['iduser']."';");
                $data['idrumah_dinas'] = $tersimpan->idrumah_dinas;
                $data['nama_rumah'] = $tersimpan->nama_rumdis;
                $data['alamat_rumah'] = $tersimpan->alamat;
                $deffoto = base_url().'assets/img/noimage.jpg';
                if(strlen($tersimpan->foto) > 0){
                    if(file_exists($tersimpan->foto)){
                        $deffoto = base_url().substr($tersimpan->foto, 2);
                    }
                }
                $data['lat'] = $tersimpan->lat;
                $data['lon'] = $tersimpan->lon;
                $data['foto_rumah'] = $deffoto;
                
            }else{
                $data['idrumah_dinas'] = $this->Mglobals->autokode("R","idrumah_dinas","rumah_dinas",2,7);
                $data['nama_rumah'] = "";
                $data['alamat_rumah'] = "";
                $data['lat'] = "-1.845383988573187";
                $data['lon'] = "121.79800978057857";
                $data['foto_rumah'] = base_url().'assets/img/noimage.jpg';
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu_user');
            $this->load->view('rumah_dinas/single_user');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $iduser = $ses['iduser'];
        
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            //$config['max_size'] = '5024'; //5 MB
            
            $mode = "simpan";
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM rumah_dinas WHERE idpersonil = '".$iduser."';")->jml;
            if($jml > 0){
                $mode = "update";
            }
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    if($mode == "simpan"){
                        $status = $this->simpandenganfoto($config);
                    }else if($mode == "update"){
                        $status = $this->updatedenganfoto($config);
                    }
                }
            }else{
                if($mode == "simpan"){
                    $status = $this->simpantanpafoto();
                }else if($mode == "update"){
                    $status = $this->updatetanpafoto();
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpantanpafoto() {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
        
        $data = array(
            'idrumah_dinas' => $this->Mglobals->autokode("R","idrumah_dinas","rumah_dinas", 2, 7),
            'nama_rumdis' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'lat' => $this->input->post('lat'),
            'lon' => $this->input->post('lon'),
            'idpersonil' => $iduser
        );
        $simpan = $this->Mglobals->add("rumah_dinas",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    private function simpandenganfoto($config) {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
               $data = array(
                    'idrumah_dinas' => $this->Mglobals->autokode("R","idrumah_dinas","rumah_dinas", 2, 7),
                    'nama_rumdis' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'lat' => $this->input->post('lat'),
                    'lon' => $this->input->post('lon'),
                    'idpersonil' => $iduser,
                    'foto' => $newpath
                );
                $update = $this->Mglobals->add("rumah_dinas",$data);
                if($update == 1){
                    unlink($path);
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                } 
            }else{
                $status = "Resize foto gagal";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function updatedenganfoto($config) {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
        
        $logo = $this->Mglobals->getAllQR("SELECT foto FROM rumah_dinas where idpersonil = '".$iduser."';")->foto;
        if(strlen($logo) > 0){
            if(file_exists($logo)){
                unlink($logo);
            }
        }
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data = array(
                    'nama_rumdis' => $this->input->post('nama'),
                    'alamat' => $this->input->post('alamat'),
                    'lat' => $this->input->post('lat'),
                    'lon' => $this->input->post('lon'),
                    'idpersonil' => $iduser,
                    'foto' => $newpath
                );
                $kond['idrumah_dinas'] = $this->input->post('kode');
                $update = $this->Mglobals->update("rumah_dinas",$data, $kond);
                if($update == 1){
                    unlink($path);
                    $status = "Data terupdate";
                }else{
                    $status = "Data gagal terupdate";
                }
            }else{
                $status = "Resize foto gagal";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function updatetanpafoto() {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
        
        $data = array(
            'nama_rumdis' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'lat' => $this->input->post('lat'),
            'lon' => $this->input->post('lon'),
            'idpersonil' => $iduser
        );
        $kond['idrumah_dinas'] = $this->input->post('kode');
        $update = $this->Mglobals->update("rumah_dinas",$data, $kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    private function resizeImage($path, $newpath){
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $path,
            'new_image' => $newpath,
            'maintain_ratio' => TRUE,
            'width' => 350,
            'height' => 350
        );
        $this->load->library('image_lib', $config_manip);
        $hasil = $this->image_lib->resize();
        $this->image_lib->clear();
        return $hasil;
    }
    
}
