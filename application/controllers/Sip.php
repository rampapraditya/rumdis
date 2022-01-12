<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Penghuni
 */
class Sip extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('sip/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAllQ("SELECT a.idsip, a.idrumah_dinas, b.nama_rumdis, b.alamat, c.nrp, c.nama, a.no_sip FROM sip a, rumah_dinas b, personil c where a.idrumah_dinas = b.idrumah_dinas and a.idpersonil = c.idpersonil;");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nama_rumdis;
                $val[] = $row->alamat;
                $val[] = $row->nrp;
                $val[] = $row->nama;
                $val[] = $row->no_sip;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-success" href="javascript:void(0)" title="Download" onclick="unduh('."'".$this->modul->enkrip_url($row->idsip)."'".')"> Download</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idsip."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idsip."'".','."'".$row->no_sip."'".')"> Delete</a>'
                        . '</div>';
                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function unduhfile() {
        if($this->session->userdata('logged')){
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
    
    public function ajaxpersonil() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAllQ("select a.idpersonil, a.nrp, a.nama, b.nama_pangkat, c.nama_korps, a.status from personil a, pangkat b, korps c where a.idpangkat = b.idpangkat and a.idkorps = c.idkorps and idpersonil not in(select idpersonil from sip);");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nrp;
                $val[] = $row->nama;
                $val[] = $row->nama_pangkat;
                $val[] = $row->nama_korps;
                $val[] = $row->status;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Pilih Personil" onclick="pilih_personil('."'".$row->idpersonil."'".','."'".$row->nrp."'".','."'".$row->nama."'".')"> Pilih</a>'
                        . '</div>';
                $data[] = $val;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajaxrumdis() {
        if($this->session->userdata('logged')){
            $data = array();
            $list = $this->Mglobals->getAllQ("select * from rumah_dinas where idrumah_dinas not in(select idrumah_dinas from sip);");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $row->nama_rumdis;
                $val[] = $row->alamat;
                // mencari jumlah penghuni
                $jml_penghuni = 0;
                $cek_kepala = $this->Mglobals->getAllQR("select count(*) as jml from sip where idrumah_dinas = '".$row->idrumah_dinas."';")->jml;
                if($cek_kepala > 0){
                    $jml_kepala = 1;
                    $idpersonil = $this->Mglobals->getAllQR("select idpersonil from sip where idrumah_dinas = '".$row->idrumah_dinas."';")->idpersonil;
                    // mencari jumlah keluarga
                    $jml_keluarga = $this->Mglobals->getAllQR("select count(*) as jml from personil_keluarga where idpersonil = '".$idpersonil."';")->jml;
                    $jml_penghuni = $jml_kepala + $jml_keluarga;
                    $val[] = '<p style="text-align: center;">'.$jml_penghuni.'</p>';
                }else{
                    $val[] = '<p style="text-align: center;">'.$jml_penghuni.'</p>';
                }
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Pilih Rumah Dinas" onclick="pilih_rumdis('."'".$row->idrumah_dinas."'".','."'".$row->nama_rumdis."'".','."'".$row->alamat."'".')"> Pilih</a>'
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
            $config['upload_path'] = './assets/file/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '8024'; //8 MB
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->simpan($config);
                }
            }else{
                $status = "File dokumen tidak ditemukan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan($config) {
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'idsip' => $this->Mglobals->autokode('S','idsip', 'sip', 2, 7),
                'idpersonil' => $this->input->post('idpersonil'),
                'idrumah_dinas' => $this->input->post('idrumah_dinas'),
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
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $config['upload_path'] = './assets/file/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '8024'; //8 MB
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    $status = $this->update_dengan_file($config);
                }
            }else{
                $status = $this->update_tanpa_file();
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function update_dengan_file($config) {
        $berkas = $this->Mglobals->getAllQR("select berkas from sip where idsip = '".$this->input->post('kode')."';")->berkas;
        if(strlen($berkas) > 0){
            if(file_exists($berkas)){
                unlink($berkas);
            }
        }
            
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'idpersonil' => $this->input->post('idpersonil'),
                'idrumah_dinas' => $this->input->post('idrumah_dinas'),
                'no_sip' => $this->input->post('no_sip'),
                'berkas' => $path
            );
            $kond['idsip'] = $this->input->post('kode');
            $update = $this->Mglobals->update("sip",$data,$kond);
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
    
    private function update_tanpa_file() {
        $data = array(
            'idpersonil' => $this->input->post('idpersonil'),
            'idrumah_dinas' => $this->input->post('idrumah_dinas'),
            'no_sip' => $this->input->post('no_sip')
        );
        $kond['idsip'] = $this->input->post('kode');
        $update = $this->Mglobals->update("sip",$data,$kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $idsip = $this->uri->segment(3);
            $data = $this->Mglobals->getAllQR("select a.idsip, a.idpersonil, b.nrp, b.nama, a.idrumah_dinas, c.nama_rumdis, c.alamat, a.no_sip from sip a, personil b, rumah_dinas c where a.idpersonil = b.idpersonil and a.idrumah_dinas = c.idrumah_dinas and a.idsip = '".$idsip."';");
            
            echo json_encode(array(
                "kode" => $data->idsip,
                "idpersonil" => $data->idpersonil,
                "nrp_nama" => $data->nrp.' - '.$data->nama,
                "idrumah_dinas" => $data->idrumah_dinas,
                "nama_alamat" => $data->nama_rumdis.' - '.$data->alamat,
                "no_sip" => $data->no_sip
            ));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $idsip = $this->uri->segment(3);
            $berkas = $this->Mglobals->getAllQR("select berkas from sip where idsip = '".$idsip."';")->berkas;
            if(strlen($berkas) > 0){
                if(file_exists($berkas)){
                    unlink($berkas);
                }
            }
            $kond['idsip'] = $idsip;
            $hapus = $this->Mglobals->delete("sip",$kond);
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
}
