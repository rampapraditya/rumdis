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
            $tersimpan = $this->Mglobals->getAllQR("select a.iduserslogin, a.nrp, a.nama, a.idpangkat, b.nama_pangkat, a.idkorps, c.nama_korps, a.idkomplek FROM userslogin a, pangkat b, korps c where a.idpangkat = b.idpangkat and a.idkorps = c.idkorps and a.iduserslogin = '".$ses['iduser']."';");
            $data['iduser'] = $tersimpan->iduserslogin;
            $data['nrp_user'] = $tersimpan->nrp;
            $data['nama_user'] = $tersimpan->nama;
            $data['idpangkat_user'] = $tersimpan->idpangkat;
            $data['pangkat_user'] = $tersimpan->nama_pangkat;
            $data['idkorps_user'] = $tersimpan->idkorps;
            $data['korps_user'] = $tersimpan->nama_korps;
            $data['idkomplek'] = $tersimpan->idkomplek;
            
            // membaca detil
            $cek_detil = $this->Mglobals->getAllQR("select count(*) as jml from detiluser where iduserslogin = '".$ses['iduser']."';")->jml;
            if($cek_detil > 0){
                $tersimpan_detil = $this->Mglobals->getAllQR("select * from detiluser where iduserslogin = '".$ses['iduser']."';");
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

            // membaca SIP
            $cek_sip = $this->Mglobals->getAllQR("select count(*) as jml from sip where iduserslogin = '".$ses['iduser']."';")->jml;
            if($cek_sip > 0){
                $sip = $this->Mglobals->getAllQR("select * from sip where iduserslogin = '".$ses['iduser']."';");
                $data['no_sip'] = $sip->no_sip;
                if(strlen($sip->dok_sip) > 0){
                    if(file_exists($sip->dok_sip)){
                        $data['unduh'] = "ya";
                    }else{
                        $data['unduh'] = "tidak";
                    }
                }else{
                    $data['unduh'] = "tidak";
                }
            }else{
                $data['no_sip'] = "";
                $data['unduh'] = "tidak";
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
                    'idkomplek' => $this->input->post('komplek'),
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
    
    public function prosesdetil() {
        if($this->session->userdata('loggeduser')){
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
        if($this->session->userdata('loggeduser')){
            $ses = $this->session->userdata('loggeduser');
            $iduser = $ses['iduser'];
            // load data
            $data = array();
            $no = 1;
            $list = $this->Mglobals->getAllQ("SELECT *, date_format(tgl_lahir, '%d %M %Y') as tgl FROM keluarga where iduserslogin = '".$iduser."';");
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
        if($this->session->userdata('loggeduser')){
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
        if($this->session->userdata('loggeduser')){
            $kondisi['idkeluarga'] = $this->uri->segment(3);
            $data = $this->Mglobals->get_by_id("keluarga", $kondisi);
            echo json_encode($data);
        }else{
            $this->modul->halaman('login');
        }
    }
    
    public function ajax_edit_keluarga() {
        if($this->session->userdata('loggeduser')){
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
        if($this->session->userdata('loggeduser')){
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
    
    public function prosessip() {
        if($this->session->userdata('loggeduser')){
            $iduserslogin = $this->input->post('iduserslogin');
            
            $jml_personil = $this->Mglobals->getAllQR("select count(*) as jml from sip where iduserslogin = '".$iduserslogin."';")->jml;
            if($jml_personil > 0){
                $mode = "update";
            }else{
                $mode = "simpan";
            }
            
            if (isset($_FILES['file']['name'])) {
                if(0 < $_FILES['file']['error']) {
                    $status = "Error during file upload ".$_FILES['file']['error'];
                }else{
                    if($mode == "simpan"){
                        $status = $this->simpan_dengan_foto_sip();
                    }else if($mode == "update"){
                        $status = $this->update_dengan_foto_sip();
                    }
                }
            }else{
                if($mode == "simpan"){
                    $status = "Dokumen SIP wajib disertakan";
                }else if($mode == "update"){
                    $status = $this->update_tanpa_foto_sip();
                }
            }
            
            echo json_encode(array("status" => $status));
        }else{
            $this->modul->halaman('login');
        }
    }
    
    private function simpan_dengan_foto_sip() {
        $config['upload_path'] = './assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        //$config['max_size'] = '8024'; //8 MB
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'idsip' => $this->Mglobals->autokode('S','idsip', 'sip', 2, 7),
                'iduserslogin' => $this->input->post('iduserslogin'),
                'no_sip' => $this->input->post('no_sip'),
                'dok_sip' => $path
            );
            $simpan = $this->Mglobals->add("sip",$data);
            if($simpan == 1){
                $status = "SIP tersimpan";
            }else{
                $status = "SIP gagal tersimpan";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function update_dengan_foto_sip() {
        $config['upload_path'] = './assets/file/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = TRUE;
        //$config['max_size'] = '8024'; //8 MB
        
        $lawas = $this->Mglobals->getAllQR("SELECT dok_sip FROM sip where iduserslogin = '".$this->input->post('iduserslogin')."';")->dok_sip;
        if(strlen($lawas) > 0){
            if(file_exists($lawas)){
                unlink($lawas);
            }
        }
        
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {
            $datafile = $this->upload->data();
            $path = $config['upload_path'].$datafile['file_name'];

            $data = array(
                'no_sip' => $this->input->post('no_sip'),
                'dok_sip' => $path
            );
            $kond['iduserslogin'] = $this->input->post('iduserslogin');
            $update = $this->Mglobals->update("sip",$data, $kond);
            if($update == 1){
                $status = "SIP terupdate";
            }else{
                $status = "SIP gagal terupdate";
            }
        } else {
            $status = $this->upload->display_errors();
        }
        return $status;
    }
    
    private function update_tanpa_foto_sip() {
        $data = array(
            'no_sip' => $this->input->post('no_sip')
        );
        $kond['iduserslogin'] = $this->input->post('iduserslogin');
        $update = $this->Mglobals->update("sip",$data, $kond);
        if($update == 1){
            $status = "SIP terupdate";
        }else{
            $status = "SIP gagal terupdate";
        }
        return $status;
    }
    
    public function unduhfile() {
        if($this->session->userdata('loggeduser')){
            $this->load->helper('download');
            $iduserslogin = $this->modul->dekrip_url($this->uri->segment(3));
            $cek = $this->Mglobals->getAllQR("select count(*) as jml from sip where iduserslogin = '".$iduserslogin."';")->jml;
            if($cek > 0){
                $berkas = $this->Mglobals->getAllQR("select dok_sip, iduserslogin from sip where iduserslogin = '".$iduserslogin."';");
                if(strlen($berkas->dok_sip) > 0){
                    if(file_exists($berkas->dok_sip)){
                        force_download($berkas->dok_sip, NULL);
                    }
                }
            }else{
                $this->modul->pesan_halaman("Dokumen tidak ditemukan","users/detil/".$this->modul->enkrip_url($berkas->iduserslogin));
            }
        }else{
            $this->modul->halaman('login');
        }
    }
}
