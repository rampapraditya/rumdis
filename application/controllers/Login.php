<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 */
class Login extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $this->modul->halaman('welcome');
        }else{
            $jml_identitas = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM identitas;")->jml;
            if($jml_identitas > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM identitas;");
                $deflogo = base_url().'assets/images/noimage.png';
                if(strlen($tersimpan->logo) > 0){
                    if(file_exists($tersimpan->logo)){
                        $deflogo = base_url().substr($tersimpan->logo, 2);
                    }
                }
                $data['logo'] = $deflogo;
            }else{
                $data['logo'] = base_url().'assets/images/noimage.png';
            }
            $this->load->view('login', $data);
        }
    }
    
    public function proses() {
        $user = strtolower(trim($this->input->post('username')));
        $pass = trim($this->input->post('password'));
        
        $enkrip_pass = $this->modul->enkrip_pass($pass);
        $jml = $this->Mglobals->getAllQR("select count(*) as jml from userslogin where nrp = '".$user."';")->jml;
        if($jml > 0){
            $jml1 = $this->Mglobals->getAllQR("select count(*) as jml from userslogin where nrp = '".$user."' and pass = '".$enkrip_pass."';")->jml;
            if($jml1 > 0){
                $data = $this->Mglobals->getAllQR("select iduserslogin, nrp, nama, idrole from userslogin where nrp = '".$user."';");
                if($data->idrole == "R1"){
                    $sess_array = array(
                        'iduser' => $data->iduserslogin,
                        'nrp' => $data->nrp,
                        'nama' => $data->nama
                    );
                    $this->session->set_userdata('logged', $sess_array);
                    $status = "ok";
                }else if($data->idrole == "R2"){
                    $sess_array = array(
                        'iduser' => $data->iduserslogin,
                        'nrp' => $data->nrp,
                        'nama' => $data->nama
                    );
                    $this->session->set_userdata('loggeduser', $sess_array);
                    $status = "okuser";
                }
            }else{
                $status = "Anda tidak berhak mengakses !";
            }
        }else{
            $status = "Maaf, user tidak ditemukan !";
        }
        
        echo json_encode(array("status" => $status));   
    }
    
    public function logout(){
        if($this->session->userdata('logged')){
            $this->session->unset_userdata('logged');
        }
        
        if($this->session->userdata('loggeduser')){
            $this->session->unset_userdata('loggeduser');
        }
        
        $this->modul->halaman('login');
    }
}
