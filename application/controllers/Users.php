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
            $data['komplek'] = $this->Mglobals->getAll("komplek");
            
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
                // mencari komplek
                if(strlen($row->idkomplek) > 0){
                    $val[] = $this->Mglobals->getAllQR("select nama_komplek from komplek where idkomplek = '".$row->idkomplek."';")->nama_komplek;
                }else{
                    $val[] = "";
                }
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
                    'idkorps' => $this->input->post('korps'),
                    'idkomplek' => $this->input->post('komplek')
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
            'idkorps' => $this->input->post('korps'),
            'idkomplek' => $this->input->post('komplek')
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
            $data = $this->Mglobals->getAllQR("SELECT iduserslogin, nrp, pass, nama, idpangkat, idkorps, idkomplek FROM userslogin where iduserslogin = '".$iduserslogin."';");
            echo json_encode(array(
                "kode" => $data->iduserslogin,
                "nrp" => $data->nrp,
                "nama" => $data->nama,
                "pass" => $this->modul->dekrip_pass($data->pass),
                "pangkat" => $data->idpangkat,
                "korps" => $data->idkorps,
                "komplek" => $data->idkomplek
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
                    'idkorps' => $this->input->post('korps'),
                    'idkomplek' => $this->input->post('komplek')
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
            'idkorps' => $this->input->post('korps'),
            'idkomplek' => $this->input->post('komplek')
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
                
                // membaca detil
                $cek_detil = $this->Mglobals->getAllQR("select count(*) as jml from detiluser where iduserslogin = '".$tersimpan->iduserslogin."';")->jml;
                if($cek_detil > 0){
                    $tersimpan_detil = $this->Mglobals->getAllQR("select * from detiluser where iduserslogin = '".$tersimpan->iduserslogin."';");
                    $data['rt'] = $tersimpan_detil->rt;
                    $data['rw'] = $tersimpan_detil->rw;
                    $data['jalan'] = $tersimpan_detil->jalan;
                    $data['no'] = $tersimpan_detil->no;
                    $data['bl'] = $tersimpan_detil->bl;
                    $data['th'] = $tersimpan_detil->th;
                    $data['blok'] = $tersimpan_detil->blok;
                    $data['kesatuan'] = $tersimpan_detil->kesatuan;
                    $data['th_penugasan'] = $tersimpan_detil->th_pem_penu;
                    $data['asal_usul'] = $tersimpan_detil->asal_usul;
                    $data['luas_bangunan'] = $tersimpan_detil->l_bangunan;
                    $data['luas_tanah'] = $tersimpan_detil->l_tanah;
                    $data['tipe'] = $tersimpan_detil->tipe;
                    $data['b_rr_rb'] = $tersimpan_detil->b_rr_rb;
                    $data['sewa'] = $tersimpan_detil->ketentuan_sewa;
                    $data['keterangan'] = $tersimpan_detil->keterangan;
                    
                }else{
                    $data['rt'] = "";
                    $data['rw'] = "";
                    $data['jalan'] = "";
                    $data['no'] = "";
                    $data['bl'] = "";
                    $data['th'] = "";
                    $data['blok'] = "";
                    $data['kesatuan'] = "";
                    $data['th_penugasan'] = "";
                    $data['asal_usul'] = "";
                    $data['luas_bangunan'] = 0;
                    $data['luas_tanah'] = 0;
                    $data['tipe'] = 0;
                    $data['b_rr_rb'] = "";
                    $data['sewa'] = "";
                    $data['keterangan'] = "";
                }
                
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
    
    public function prosesdetil() {
        if($this->session->userdata('logged')){
            $cek = $this->Mglobals->getAllQR("select count(*) as jml from detiluser where iduserslogin = '".$this->input->post('key')."';")->jml;
            if($cek > 0){
                $status = $this->update_detil();
            }else{
                $status = $this->simpan_detil();
            }
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_detil() {
        $data = array(
            'iddetiluser' => $this->Mglobals->autokode("D","iddetiluser","detiluser", 2, 7),
            'iduserslogin' => $this->input->post('key'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'jalan' => $this->input->post('jalan'),
            'no' => $this->input->post('no'),
            'bl' => $this->input->post('bl'),
            'th' => $this->input->post('th'),
            'blok' => $this->input->post('blok'),
            'kesatuan' => $this->input->post('kesatuan'),
            'th_pem_penu' => $this->input->post('th_penugasan'),
            'asal_usul' => $this->input->post('asal_usul'),
            'l_bangunan' => $this->input->post('l_bangunan'),
            'l_tanah' => $this->input->post('l_tanah'),
            'tipe' => $this->input->post('tipe'),
            'b_rr_rb' => $this->input->post('b_rr_rb'),
            'ketentuan_sewa' => $this->input->post('ketentuan_sewa'),
            'keterangan' => $this->input->post('keterangan')
        );
        $simpan = $this->Mglobals->add("detiluser",$data);
        if($simpan == 1){
            $status = "Data tersimpan";
        }else{
            $status = "Data gagal tersimpan";
        }
        return $status;
    }
    
    private function update_detil() {
        $data = array(
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'jalan' => $this->input->post('jalan'),
            'no' => $this->input->post('no'),
            'bl' => $this->input->post('bl'),
            'th' => $this->input->post('th'),
            'blok' => $this->input->post('blok'),
            'kesatuan' => $this->input->post('kesatuan'),
            'th_pem_penu' => $this->input->post('th_penugasan'),
            'asal_usul' => $this->input->post('asal_usul'),
            'l_bangunan' => $this->input->post('l_bangunan'),
            'l_tanah' => $this->input->post('l_tanah'),
            'tipe' => $this->input->post('tipe'),
            'b_rr_rb' => $this->input->post('b_rr_rb'),
            'ketentuan_sewa' => $this->input->post('ketentuan_sewa'),
            'keterangan' => $this->input->post('keterangan')
        );
        $kond['iduserslogin'] = $this->input->post('key');
        $update = $this->Mglobals->update("detiluser",$data, $kond);
        if($update == 1){
            $status = "Data terupdate";
        }else{
            $status = "Data gagal terupdate";
        }
        return $status;
    }
    
    public function ajaxkeluarga() {
        if($this->session->userdata('logged')){
            $data = array();
            $no = 1;
            $list = $this->Mglobals->getAllQ("SELECT *, date_format(tgl_lahir, '%d %M %Y') as tgl FROM keluarga where iduserslogin = '".$this->uri->segment(3)."';");
            foreach ($list->result() as $row) {
                $val = array();
                $val[] = $no;
                $val[] = $row->nama;
                $val[] = $row->jkel;
                $val[] = $row->tmp_lahir.', '.$row->tgl;
                $val[] = $row->hubungan;
                $val[] = '<div style="text-align: center;">'
                        . '<a class="btn btn-xs btn-outline-primary" href="javascript:void(0)" title="Edit" onclick="ganti('."'".$row->idkeluarga."'".')"> Edit</a>&nbsp;'
                        . '<a class="btn btn-xs btn-outline-danger" href="javascript:void(0)" title="Hapus" onclick="hapus('."'".$row->idkeluarga."'".','."'".$no."'".')"> Delete</a>'
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
                'idkeluarga' => $this->Mglobals->autokode("K","idkeluarga","keluarga", 2, 7),
                'nama' => $this->input->post('nama'),
                'jkel' => $this->input->post('jkel'),
                'tmp_lahir' => $this->input->post('tmp'),
                'tgl_lahir' => $this->input->post('tgl'),
                'hubungan' => $this->input->post('hubungan'),
                'iduserslogin' => $this->input->post('idusers')
            );
            $simpan = $this->Mglobals->add("keluarga",$data);
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
            $kondisi['idkeluarga'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("keluarga", $kondisi);
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
                'hubungan' => $this->input->post('hubungan')
            );
            $kond['idkeluarga'] = $this->input->post('kode');
            $update = $this->Mglobals->update("keluarga",$data,$kond);
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
            $kond['idkeluarga'] = $this->uri->segment(3);
            $hapus = $this->Mglobals->delete("keluarga",$kond);
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
