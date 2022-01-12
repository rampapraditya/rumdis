<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Identitas
 *
 * @author Rampa Praditya <https://pramediaenginering.com/>
 */
class Identitas extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM identitas;")->jml;
            if($jml > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM identitas;");
                $data['instansi'] = $tersimpan->instansi;
                $data['tahun'] = $tersimpan->tahun;
                $data['pimpinan'] = $tersimpan->pimpinan;
                $data['alamat'] = $tersimpan->alamat;
                $data['kdpos'] = $tersimpan->kdpos;
                $data['tlp'] = $tersimpan->tlp;
                $data['fax'] = $tersimpan->fax;
                $data['website'] = $tersimpan->website;
                $deflogo = base_url().'assets/images/noimage.jpg';
                if(strlen($tersimpan->logo) > 0){
                    if(file_exists($tersimpan->logo)){
                        $deflogo = base_url().substr($tersimpan->logo, 2);
                    }
                }
                $data['logo'] = $deflogo;
                
            }else{
                $data['instansi'] = "";
                $data['tahun'] = "";
                $data['pimpinan'] = "";
                $data['alamat'] = "";
                $data['tlp'] = "";
                $data['fax'] = "";
                $data['website'] = "";
                $data['logo'] = base_url().'assets/images/no_image.png';
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('identitas/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if($this->session->userdata('logged')){
            $config['upload_path'] = './assets/temp/';
            $config['upload_newpath'] = './assets/img/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '3024'; //3 MB
            
            $mode = "simpan";
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM identitas;")->jml;
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
    
    private function simpandenganfoto($config) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];
            $newpath = $config['upload_newpath'].$datafile['file_name'];

            $resize_foto = $this->resizeImage($path, $newpath);
            if($resize_foto){
                $data = array(
                    'kode' => $this->Mglobals->autokode('I','kode', 'identitas', 2, 7),
                    'instansi' => $this->input->post('nama'),
                    'tahun' => $this->input->post('tahun'),
                    'pimpinan' => $this->input->post('pimpinan'),
                    'alamat' => $this->input->post('alamat'),
                    'kdpos' => $this->input->post('kdpos'),
                    'tlp' => $this->input->post('tlp'),
                    'fax' => $this->input->post('fax'),
                    'website' => $this->input->post('web'),
                    'logo' => $newpath
                );
                $simpan = $this->Mglobals->add("identitas",$data);
                if($simpan == 1){
                    unlink($path);
                    $status = "Identitas tersimpan";
                }else{
                    $status = "Identitas gagal tersimpan";
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
        $logo = $this->Mglobals->getAllQR("SELECT logo FROM identitas;")->logo;
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
                    'instansi' => $this->input->post('nama'),
                    'tahun' => $this->input->post('tahun'),
                    'pimpinan' => $this->input->post('pimpinan'),
                    'alamat' => $this->input->post('alamat'),
                    'kdpos' => $this->input->post('kdpos'),
                    'tlp' => $this->input->post('tlp'),
                    'fax' => $this->input->post('fax'),
                    'website' => $this->input->post('web'),
                    'logo' => $newpath
                );
                $update = $this->Mglobals->updateNK("identitas",$data);
                if($update == 1){
                    unlink($path);
                    $status = "Identitas terupdate";
                }else{
                    $status = "Identitas gagal terupdate";
                }
            }else{
                $status = "Resize foto gagal";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function simpantanpafoto() {
        $data = array(
            'kode' => $this->Mglobals->autokode('I','kode', 'identitas', 2, 7),
            'instansi' => $this->input->post('nama'),
            'tahun' => $this->input->post('tahun'),
            'pimpinan' => $this->input->post('pimpinan'),
            'alamat' => $this->input->post('alamat'),
            'kdpos' => $this->input->post('kdpos'),
            'tlp' => $this->input->post('tlp'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('web'),
            'logo' => ''
        );
        $simpan = $this->Mglobals->add("identitas",$data);
        if($simpan == 1){
            $status = "Identitas tersimpan";
        }else{
            $status = "Identitas gagal tersimpan";
        }
        return $status;
    }
    
    private function updatetanpafoto() {
        $data = array(
            'instansi' => $this->input->post('nama'),
            'tahun' => $this->input->post('tahun'),
            'pimpinan' => $this->input->post('pimpinan'),
            'alamat' => $this->input->post('alamat'),
            'kdpos' => $this->input->post('kdpos'),
            'tlp' => $this->input->post('tlp'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('web')
        );
        $update = $this->Mglobals->updateNK("identitas",$data);
        if($update == 1){
            $status = "Identitas terupdate";
        }else{
            $status = "Identitas gagal terupdate";
        }
        return $status;
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
}
