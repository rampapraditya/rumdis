<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Welcome
 */
class Welcome extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            $data['jml_penghuni'] = 0;
            $data['jml_rumdis'] = $this->Mglobals->getAllQR("select count(*) as jml from komplek;")->jml;
            
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
            
            $data['display'] = $this->load_lokasi();
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('content_maps');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    private function load_lokasi() {
        $gambar = base_url().'assets/marker/marker.png';
        $string = '';
        $list = $this->Mglobals->getAll("komplek");
        foreach ($list->result() as $row) {
            $string .= 'createMarker(['.$row->lat.','.$row->lon.'], "'.$row->nama_komplek.'", "'.$row->idkomplek.'","'.$gambar.'", 20, 20);';
        }
        return $string;
    }
}
