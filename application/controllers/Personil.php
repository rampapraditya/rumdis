<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Personil
 */
class Personil extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            $data['pangkat'] = $this->Mglobals->getAll("pangkat");
            $data['korps'] = $this->Mglobals->getAll("korps");
            
            $this->load->view('head', $data);
            $this->load->view('menu');
            $this->load->view('personil/index');
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxlist() {
        if($this->session->userdata('logged')){
            $data = array();
            $no = 1;
            $list = $this->Mglobals->getAllQ("select a.idpersonil, a.nrp, a.nama, b.nama_pangkat, c.nama_korps, a.status from personil a, pangkat b, korps c where a.idpangkat = b.idpangkat and a.idkorps = c.idkorps;");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->nrp;
                $val[] = $row->nama;
                $val[] = $row->nama_pangkat;
                $val[] = $row->nama_korps;
                $val[] = $row->status;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-success" href="javascript:void(0)" title="Keluarga" onclick="keluarga('."'".$this->modul->enkrip_url($row->idpersonil)."'".')"> Keluarga</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idpersonil."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idpersonil."'".','."'".$no."'".')"> Delete</a>'
                        . '</div>';
                $data[] = $val;
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add() {
        if($this->session->userdata('logged')){
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM personil where nrp = '".$this->input->post('nrp')."';")->jml;
            if($jml > 0){
                $status = "Gunakan NRP pangkat lain";
            }else{
                $data = array(
                    'idpersonil' => $this->Mglobals->autokode("P","idpersonil","personil", 2, 7),
                    'nrp' => $this->input->post('nrp'),
                    'nama' => $this->input->post('nama'),
                    'idpangkat' => $this->input->post('pangkat'),
                    'idkorps' => $this->input->post('korps'),
                    'status' => $this->input->post('status')
                );
                $simpan = $this->Mglobals->add("personil",$data);
                if($simpan == 1){
                    $status = "Data tersimpan";
                }else{
                    $status = "Data gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ganti(){
        if($this->session->userdata('logged')){
            $kondisi['idpersonil'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("personil", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit() {
        if($this->session->userdata('logged')){
            $data = array(
                'nrp' => $this->input->post('nrp'),
                'nama' => $this->input->post('nama'),
                'idpangkat' => $this->input->post('pangkat'),
                'idkorps' => $this->input->post('korps'),
                'status' => $this->input->post('status')
            );
            $kond['idpersonil'] = $this->input->post('kode');
            $update = $this->Mglobals->update("personil",$data, $kond);
            if($update == 1){
                $status = "Data terupdate";
            }else{
                $status = "Data gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapus() {
        if($this->session->userdata('logged')){
            $kondisi['idpersonil'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("personil",$kondisi);
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
    
    public function detil() {
        if($this->session->userdata('logged')){
            $ses = $this->session->userdata('logged');
            $data['username'] = $ses['iduser'];
            $data['nrp'] = $ses['nrp'];
            $data['nama'] = $ses['nama'];
            
            $idpersonil = $this->modul->dekrip_url($this->uri->segment(3));
            $cek = $this->Mglobals->getAllQR("select count(*) as jml from personil where idpersonil = '".$idpersonil."';")->jml;
            if($cek > 0){
                $data['tersimpan'] = $this->Mglobals->getAllQR("select a.*, b.nama_pangkat from personil a, pangkat b where a.idpangkat = b.idpangkat and a.idpersonil = '".$idpersonil."';");
                $this->load->view('head', $data);
                $this->load->view('menu');
                $this->load->view('personil/keluarga');
                $this->load->view('foot');
            }else{
                $this->modul->halaman('personil');
            }
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function ajaxkeluarga() {
        if($this->session->userdata('logged')){
            $kode = $this->uri->segment(3);
            $data = array();
            $no = 1;
            $list = $this->Mglobals->getAllQ("SELECT *, date_format(tgl_lahir, '%d %M %Y') as tgl FROM personil_keluarga where idpersonil = '".$kode."';");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->nama;
                $val[] = $row->jkel;
                $val[] = $row->tmp_lahir.', '.$row->tgl;
                $val[] = $row->hubungan;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idpers_kel."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idpers_kel."'".','."'".$no."'".')"> Delete</a>'
                        . '</div>';
                $data[] = $val;
                $no++;
            }
            $output = array("data" => $data);
            echo json_encode($output);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_add_keluarga() {
        if($this->session->userdata('logged')){
            $data = array(
                'idpers_kel' => $this->Mglobals->autokode("K","idpers_kel","personil_keluarga", 2, 9),
                'nama' => $this->input->post('nama'),
                'jkel' => $this->input->post('jkel'),
                'tmp_lahir' => $this->input->post('tmp'),
                'tgl_lahir' => $this->input->post('tgl'),
                'hubungan' => $this->input->post('hubungan'),
                'idpersonil' => $this->input->post('idperonil')
            );
            $simpan = $this->Mglobals->add("personil_keluarga",$data);
            if($simpan == 1){
                $status = "Data tersimpan";
            }else{
                $status = "Data gagal tersimpan";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function gantikeluarga(){
        if($this->session->userdata('logged')){
            $kondisi['idpers_kel'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("personil_keluarga", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit_keluarga() {
        if($this->session->userdata('logged')){
            $data = array(
                'nama' => $this->input->post('nama'),
                'jkel' => $this->input->post('jkel'),
                'tmp_lahir' => $this->input->post('tmp'),
                'tgl_lahir' => $this->input->post('tgl'),
                'hubungan' => $this->input->post('hubungan'),
                'idpersonil' => $this->input->post('idperonil')
            );
            $kond['idpers_kel'] = $this->input->post('kode');
            $update = $this->Mglobals->update("personil_keluarga",$data,$kond);
            if($update == 1){
                $status = "Data terupdate";
            }else{
                $status = "Data gagal terupdate";
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function hapuskeluarga() {
        if($this->session->userdata('logged')){
            $kond['idpers_kel'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("personil_keluarga",$kond);
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
