<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Changepassuser
 *
 * @author RAMPA
 */
class Changepassuser extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu_user');
            $this->load->view('changepass/user');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function proses(){
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $username = $ses['iduser'];
            
            $lama = $this->modul->enkrip_pass($this->input->post('lama'));
            $lama_db = $this->Mglobals->getAllQR("select pass from userslogin where iduserslogin = '".$username."';")->pass;
            if($lama == $lama_db){
                $data = array(
                    'pass' => $this->modul->enkrip_pass($this->input->post('baru'))
                );
                $kond['iduserslogin'] = $username;
                $update = $this->Mglobals->update("userslogin",$data, $kond);
                if($update == 1){
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                }
            }else{
                $status = "Password lama tidak sesuai";
            }
            echo json_encode(array("status" => $status));
        } else {
            $this->modul->halaman('login');
        }
    }
}
