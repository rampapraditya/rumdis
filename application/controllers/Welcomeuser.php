<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Welcomeuser
 */
class Welcomeuser extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $data['jml_penghuni'] = $this->Mglobals->getAllQR("select count(*) as jml from personil;")->jml;
            $data['jml_rumdis'] = $this->Mglobals->getAllQR("select count(*) as jml from rumah_dinas;")->jml;
            $data['jml_sip'] = $this->Mglobals->getAllQR("select count(*) as jml from sip;")->jml;
            
            $jml_identitas = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM identitas;")->jml;
            if($jml_identitas > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT * FROM identitas;");
                $data['alamat'] = $tersimpan->alamat;
                $data['tlp'] = $tersimpan->tlp;
                $data['fax'] = $tersimpan->fax;
                $data['website'] = $tersimpan->website;
                $deflogo = base_url().'assets/images/logo.png';
                if(strlen($tersimpan->logo) > 0){
                    if(file_exists($tersimpan->logo)){
                        $deflogo = base_url().substr($tersimpan->logo, 2);
                    }
                }
                $data['logo'] = $deflogo;
                
            }else{
                $data['alamat'] = "";
                $data['tlp'] = "";
                $data['fax'] = "";
                $data['website'] = "";
                $data['logo'] = base_url().'assets/images/logo.png';
            }
            
            $this->load->view('head', $data);
            $this->load->view('menu_user');
            $this->load->view('content');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
}
