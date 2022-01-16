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
            
            $data['pangkat'] = $this->Mglobals->getAllQ("select * from pangkat where nama_pangkat <>  'ADMINISTRATOR';");
            $data['korps'] = $this->Mglobals->getAll("korps");
            $data['komplek'] = $this->Mglobals->getAll("komplek");
            
            // membaca profile
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM userslogin where iduserslogin = '".$ses['iduser']."';")->jml;
            if($jml > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM userslogin where iduserslogin = '".$ses['iduser']."';");
                $data['nm_personil'] = $tersimpan->nama;
                $data['pangkat_personil'] = $tersimpan->idpangkat;
                $data['korps_personil'] = $tersimpan->idkorps;
                $data['komplek_personil'] = $tersimpan->idkomplek;
                
            }else{
                $data['nm_personil'] = $ses['nama'];
                $data['pangkat_personil'] = "";
                $data['korps_personil'] = "";
                $data['komplek_personil'] = "";
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
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->update_dengan_foto($config);
                }
            }else{
                $status = $this->updatetanpafoto();
            }
            
            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }
    
    private function updatetanpafoto() {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
        
        $data = array(
            'nama' => $this->input->post('nama'),
            'idpangkat' => $this->input->post('pangkat'),
            'idkorps' => $this->input->post('korps'),
            'idkomplek' => $this->input->post('komplek')
        );
        $kond['iduserslogin'] = $iduser;
        $update = $this->Mglobals->update("userslogin",$data, $kond);
        if($update == 1){
            $status = "Profile terupdate";
        }else{
            $status = "Profile gagal terupdate";
        }
        return $status;
    }
    
    private function update_dengan_foto($config) {
        $ses = $this->session->userdata('loggeduser');
        $iduser = $ses['iduser'];
            
        $foto = $this->Mglobals->getAllQR("SELECT foto FROM userslogin where iduserslogin = '".$iduser."';")->foto;
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
                $data = array(
                    'nrp' => $this->input->post('nrp'),
                    'nama' => $this->input->post('nama'),
                    'idpangkat' => $this->input->post('pangkat'),
                    'idkorps' => $this->input->post('korps'),
                    'foto' => $newpath
                );
                $kond['iduserslogin'] = $iduser;
                $update = $this->Mglobals->update("userslogin",$data, $kond);
                if($update == 1){
                    unlink($path);
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
