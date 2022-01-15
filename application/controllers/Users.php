<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Users
 */
class Users extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            $data['pangkat'] = $this->Mglobals->getAllQ("select * from pangkat where nama_pangkat <> 'ADMINISTRATOR';");
            $data['korps'] = $this->Mglobals->getAll("korps");
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('users/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAllQ("SELECT *, b.nama_pangkat, c.nama_korps FROM userslogin a, pangkat b, korps c where a.idpangkat = b.idpangkat and a.idkorps = c.idkorps and a.idrole = 'R2';");
            foreach ($list->result() as $row) {
                $val = array();
                $def = base_url().'assets/img/avatar.png';
                if(strlen($row->foto) > 0){
                    if(file_exists($row->foto)){
                        $def = base_url().substr($row->foto, 2);
                    }
                }
                $val[] = '<img src="'.$def.'" class="img-thumbnail" style="width: 50px; height: auto;">';
                $val[] = $row->nama_pangkat;
                $val[] = $row->nama_korps;
                $val[] = $row->nrp;
                $val[] = $row->nama;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->iduserslogin."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->iduserslogin."'".','."'".$row->nrp."'".')"> Delete</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-success" href="javascript:void(0)" title="Detil" onclick="detil('."'".$this->modul->enkrip_url($row->iduserslogin)."'".')"> Detil</a>'
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
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '3024'; //3 MB
            
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM userslogin where nrp = '".$this->input->post('nrp')."';")->jml;
            if($jml > 0){
                $status = "Gunakan NRP lain";
            }else{
                if (isset($_FILES['file']['name'])) {
                    if(0 < $_FILES['file']['error']) {
                        $status = "Error during file upload ".$_FILES['file']['error'];
                    }else{
                        $status = $this->simpan_dengan_foto($config);
                    }
                }else{
                    $status = $this->simpan_tanpa_foto();
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_dengan_foto($config) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data = array(
                    'iduserslogin' => $this->Mglobals->autokode("U","iduserslogin","userslogin", 2, 7),
                    'nrp' => $this->input->post('nrp'),
                    'pass' => $this->modul->enkrip_pass($this->input->post('pass')),
                    'nama' => $this->input->post('nama'),
                    'foto' => $newpath,
                    'idrole' => 'R2',
                    'idpangkat' => $this->input->post('pangkat'),
                    'idkorps' => $this->input->post('korps')
                );
                $simpan = $this->Mglobals->add("userslogin",$data);
                if($simpan == 1){
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
    
    private function simpan_tanpa_foto() {
        $data = array(
            'iduserslogin' => $this->Mglobals->autokode("U","iduserslogin","userslogin", 2, 7),
            'nrp' => $this->input->post('nrp'),
            'pass' => $this->modul->enkrip_pass($this->input->post('pass')),
            'nama' => $this->input->post('nama'),
            'foto' => '',
            'idrole' => 'R2',
            'idpangkat' => $this->input->post('pangkat'),
            'idkorps' => $this->input->post('korps')
        );
        $simpan = $this->Mglobals->add("userslogin",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $iduserslogin = $this->uri->segment(3);
            $data = $this->Mglobals->getAllQR("SELECT iduserslogin, nrp, pass, nama, idpangkat, idkorps FROM userslogin where iduserslogin = '".$iduserslogin."';");
            echo json_encode(array(
                "kode" => $data->iduserslogin,
                "nrp" => $data->nrp,
                "nama" => $data->nama,
                "pass" => $this->modul->dekrip_pass($data->pass),
                "pangkat" => $data->idpangkat,
                "korps" => $data->idkorps,
            ));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '3024'; //3 MB
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->update_dengan_gambar($config);
                }
            }else{
                $status = $this->update_tanpa_gambar();
            }
            
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function update_dengan_gambar($config) {
        $iduserslogin = $this->input->post('kode');   
        $lawas = $this->Mglobals->getAllQR("SELECT foto FROM userslogin where iduserslogin = '".$iduserslogin."';")->foto;
        if(strlen($lawas) > 0){
            if(file_exists($lawas)){
                unlink($lawas);
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
                    'nrp' => $this->input->post('nrp'),
                    'pass' => $this->modul->enkrip_pass($this->input->post('pass')),
                    'nama' => $this->input->post('nama'),
                    'foto' => $newpath,
                    'idrole' => 'R2',
                    'idpangkat' => $this->input->post('pangkat'),
                    'idkorps' => $this->input->post('korps')
                );
                $kond['iduserslogin'] = $iduserslogin;
                $update = $this->Mglobals->update("userslogin",$data,$kond);
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
    
    private function update_tanpa_gambar() {
        $data = array(
            'nrp' => $this->input->post('nrp'),
            'pass' => $this->modul->enkrip_pass($this->input->post('pass')),
            'nama' => $this->input->post('nama'),
            'idrole' => 'R2',
            'idpangkat' => $this->input->post('pangkat'),
            'idkorps' => $this->input->post('korps')
        );
        $kond['iduserslogin'] = $this->input->post('kode');
        $update = $this->Mglobals->update("userslogin",$data,$kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $iduserslogin = $this->uri->segment(3);
            
            $lawas = $this->Mglobals->getAllQR("SELECT foto FROM userslogin where iduserslogin = '".$iduserslogin."';")->foto;
            if(strlen($lawas) > 0){
                if(file_exists($lawas)){
                    unlink($lawas);
                }
            }
            
            $kondisi['iduserslogin'] = $iduserslogin;
            $hapus = $this->Mglobals->delete("userslogin",$kondisi);
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
    
    private function resizeImage($path, $newpath){
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $path,
            'new_image' => $newpath,
            'maintain_ratio' => TRUE,
            'width' => 150,
            'height' => 150
        );
        $this->load->library('image_lib', $config_manip);
        $hasil = $this->image_lib->resize();
        $this->image_lib->clear();
        return $hasil;
    }
    
    public function detil() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            $idusr = $this->modul->dekrip_url($this->uri->segment(3));
            $cek = $this->Mglobals->getAllQR("select count(*) as jml from userslogin where iduserslogin = '".$idusr."';")->jml;
            if($cek > 0){
                $tersimpan = $this->Mglobals->getAllQR("select a.iduserslogin, a.nrp, a.nama, b.nama_pangkat, c.nama_korps FROM userslogin a, pangkat b, korps c where a.idpangkat = b.idpangkat and a.idkorps = c.idkorps and a.iduserslogin = '".$idusr."';");
                $data['iduser'] = $tersimpan->iduserslogin;
                $data['nrp_user'] = $tersimpan->nrp;
                $data['nama_user'] = $tersimpan->nama;
                $data['pangkat_user'] = $tersimpan->nama_pangkat;
                $data['korps_user'] = $tersimpan->nama_korps;
                        
                $this->load->view('head', $data);
                $this->load->view('menu');
                $this->load->view('users/detil');
                $this->load->view('foot');
            }else{
                $this->modul->halaman('users');
            }
        }else{
           $this->modul->halaman('login');
        }
    }
}
