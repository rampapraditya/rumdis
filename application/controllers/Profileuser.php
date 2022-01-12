<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profileuser
 *
 * @author RAMPA
 */
class Profileuser extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $data['pangkat'] = $this->Mglobals->getAll("pangkat");
            $data['korps'] = $this->Mglobals->getAll("korps");
            
            // membaca profile
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM personil where nrp = '".$ses['nrp']."';")->jml;
            if($jml > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM personil where nrp = '".$ses['nrp']."';");
                $data['nm_personil'] = $tersimpan->nama;
                $data['pangkat_personil'] = $tersimpan->idpangkat;
                $data['korps_personil'] = $tersimpan->idkorps;
                $data['status_personil'] = $tersimpan->status;
            }else{
                $data['nm_personil'] = $ses['nama'];
                $data['pangkat_personil'] = "";
                $data['korps_personil'] = "";
                $data['status_personil'] = "";
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu_user');
            $this->load->view('personil_user/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function proses(){
        if($this->session->userdata('loggeduser')){
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            //$config['max_size'] = '3024'; //3 MB
            
            $mode = "simpan";
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM personil where nrp = '".$this->input->post('nrp')."';")->jml;
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
        } else {
            $this->modul->halaman('login');
        }
    }
    
    private function simpantanpafoto() {
        $data = array(
            'idpersonil' => $this->Mglobals->autokode('P','idpersonil', 'personil', 2, 7),
            'nrp' => $this->input->post('nrp'),
            'nama' => $this->input->post('nama'),
            'idpangkat' => $this->input->post('pangkat'),
            'idkorps' => $this->input->post('korps'),
            'status' => $this->input->post('status')
        );
        $simpan = $this->Mglobals->add("personil",$data);
        if($simpan == 1){
            
            $subdata = array(
                'nama' => $this->input->post('nama')
            );
            $kond['nrp'] = $this->input->post('nrp');
            $this->Mglobals->update("userslogin",$subdata, $kond);
        
            $status = "Profile tersimpan";
        }else{
            $status = "Profile gagal tersimpan";
        }
        return $status;
    }
    
    private function updatetanpafoto() {
        $data = array(
            'nama' => $this->input->post('nama'),
            'idpangkat' => $this->input->post('pangkat'),
            'idkorps' => $this->input->post('korps'),
            'status' => $this->input->post('status')
        );
        $kond1['nrp'] = $this->input->post('nrp');
        $simpan = $this->Mglobals->update("personil",$data, $kond1);
        if($simpan == 1){
            
            $subdata = array(
                'nama' => $this->input->post('nama')
            );
            $kond['nrp'] = $this->input->post('nrp');
            $this->Mglobals->update("userslogin",$subdata, $kond);
        
            $status = "Profile terupdate";
        }else{
            $status = "Profile gagal terupdate";
        }
        return $status;
    }
    
    private function updatedenganfoto($config) {
        $foto = $this->Mglobals->getAllQR("SELECT foto FROM userslogin where nrp = '".$this->input->post('nrp')."';")->foto;
        if(strlen($foto) > 0){
            if(file_exists($foto)){
                unlink($foto);
            }
        }
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data_users_login = array(
                    'nama' => $this->input->post('nama'),
                    'foto' => $newpath
                );
                $kond['nrp'] = $this->input->post('nrp');
                $update = $this->Mglobals->update("userslogin",$data_users_login, $kond);
                if($update == 1){
                    unlink($path);
                    
                    // update untuk data
                    $data = array(
                        'nama' => $this->input->post('nama'),
                        'idpangkat' => $this->input->post('pangkat'),
                        'idkorps' => $this->input->post('korps'),
                        'status' => $this->input->post('status')
                    );
                    $kond1['nrp'] = $this->input->post('nrp');
                    $this->Mglobals->update("personil",$data, $kond1);
        
                    $status = "Profile terupdate";
                }else{
                    $status = "Profile gagal terupdate";
                }
            }else{
                $status = "Resize foto gagal";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function simpandenganfoto($config) {
        $foto = $this->Mglobals->getAllQR("SELECT foto FROM userslogin where nrp = '".$this->input->post('nrp')."';")->foto;
        if(strlen($foto) > 0){
            if(file_exists($foto)){
                unlink($foto);
            }
        }
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data_users_login = array(
                    'nama' => $this->input->post('nama'),
                    'foto' => $newpath
                );
                $kond['nrp'] = $this->input->post('nrp');
                $update = $this->Mglobals->update("userslogin",$data_users_login, $kond);
                if($update == 1){
                    unlink($path);
                    
                    // simpan untuk data baru
                    $data = array(
                        'idpersonil' => $this->Mglobals->autokode('P','idpersonil', 'personil', 2, 7),
                        'nrp' => $this->input->post('nrp'),
                        'nama' => $this->input->post('nama'),
                        'idpangkat' => $this->input->post('pangkat'),
                        'idkorps' => $this->input->post('korps'),
                        'status' => $this->input->post('status')
                    );
                    $this->Mglobals->add("personil",$data);
        
                    $status = "Profile tersimpan";
                }else{
                    $status = "Profile gagal tersimpan";
                }
            }else{
                $status = "Resize foto gagal";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function resizeImage($path, $newpath){
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $path,
            'new_image' => $newpath,
            'maintain_ratio' => TRUE,
            'width' => 300,
            'height' => 300
        );
        $this->load->library('image_lib', $config_manip);
        $hasil = $this->image_lib->resize();
        $this->image_lib->clear();
        return $hasil;
    }
}
