<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kerjasoal
 *
 * @author Rampa Praditya <https://pramediaenginering.com/>
 */
class Kerjasoal extends CI_Controller {
    
    public function index() {
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $data['golongan'] = $ses['grup'];
            $data['username'] = $ses['username'];
            $data['nama'] = $ses['nama'];
            
            $this->load->view('head', $data);
            $this->load->view('menu_siswa');
            
            // cek apakah ada soal untuk dia
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM soal_siswa where username = '".$ses['username']."';")->jml;
            if($jml > 0){
                $data['list_soal'] = $this->Mglobals->getAllQ("SELECT a.idsoal,b.namasoal, date_format(b.wkt_awal, '%d %M %Y') as tgl1, time(wkt_awal) as t1, date_format(wkt_akhir, '%d %M %Y') as tgl2, time(wkt_akhir) as t2 FROM soal_siswa a, soal b where a.username = '".$ses['username']."' and a.idsoal = b.idsoal;");
                $this->load->view('kerja_soal/index', $data);
            }else{
                $this->load->view('kerja_soal/tidak_ada_soal');
            }
            $this->load->view('foot');
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function proses() {
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $username = $ses['username'];
            $idsoal = $this->modul->dekrip_url($this->uri->segment(3));
            $tersimpan = $this->Mglobals->getAllQR("SELECT b.idsoal, b.wkt_awal, b.wkt_akhir, now() as skrng FROM soal_siswa a, soal b where a.username = '".$username."' and a.idsoal = '".$idsoal."' and a.idsoal = b.idsoal;");
            $w1 = strtotime($tersimpan->wkt_awal);
            $w2 = strtotime($tersimpan->wkt_akhir);
            $skrng = strtotime($tersimpan->skrng);

            if($w1 <= $skrng && $skrng <= $w2){
                $status = "ok";
            }else{
                $status = "Kurang atau melebihi batas waktu";
            }
        }else{
           $status = "Bukan hak akses anda";
        }
        echo json_encode(array("status" => $status));
    }
    
    public function detil() {
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $data['golongan'] = $ses['grup'];
            $data['username'] = $ses['username'];
            $data['nama'] = $ses['nama'];

            $idusers = $ses['username'];
            
            $jml = $this->Mglobals->getAllQR("SELECT count(*) as jml FROM soal_siswa where username = '".$ses['username']."';")->jml;
            if($jml > 0){
                $tersimpan = $this->Mglobals->getAllQR("SELECT b.idsoal, b.namasoal, b.wkt_awal, b.wkt_akhir, now() as skrng FROM soal_siswa a, soal b where a.username = '".$ses['username']."' and a.idsoal = b.idsoal;");
                
                $w1 = strtotime($tersimpan->wkt_awal);
                $w2 = strtotime($tersimpan->wkt_akhir);
                $skrng = strtotime($tersimpan->skrng);
                
                if($w1 <= $skrng && $skrng <= $w2){
                    $data['idsoal'] = $this->uri->segment(3);
                    $data['namapaket'] = $tersimpan->namasoal;
                    $idsoal_dekrip = $this->modul->dekrip_url($this->uri->segment(3));

                    // menampilkan semua soal dengan kode tersebut
                    $idsoal_arr = array();
                    $kodesoal_detil = array();
                    $no_soal = array();
                    $pertanyaan = array();
                    $idhead_jawaban = array();

                    $list_all_soal = $this->Mglobals->getAllQ("select * from soal_detil where idsoal = '".$idsoal_dekrip."';");
                    foreach($list_all_soal->result() as $row){
                        array_push($idsoal_arr, $row->idsoal);
                        array_push($kodesoal_detil, $row->iddetil);
                        array_push($no_soal, $row->no);
                        array_push($pertanyaan, $row->soal);
                        array_push($idhead_jawaban, $row->idhead_jawaban);
                    }
                    $data['idsoal_arr'] = $idsoal_arr;
                    $data['kode_soal_detil'] = $kodesoal_detil;
                    $data['no_soal'] = $no_soal;
                    $data['pertanyaan'] = $pertanyaan;
                    $data['idhead_jawaban'] = $idhead_jawaban;
                    
                    $this->load->view('head', $data);
                    $this->load->view('menu_siswa');
                    $this->load->view('kerja_soal/detil');
                    $this->load->view('foot');
                }else{
                    $pesan = "Kurang atau melebihi batas waktu";
                    $this->modul->pesan_halaman($pesan, 'kerjasoal');
                }
            }else{
                $pesan = "Tidak ada ploting soal untuk anda";
                $this->modul->pesan_halaman($pesan, 'kerjasoal');
            }
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function load_list_soal() {
        if($this->nativesession->get('logged_siswa')){
            $str = '';
            $idsoal = $this->modul->dekrip_url($this->uri->segment(3));
            
            $list = $this->Mglobals->getAllQ("select a.iddetil, b.nama_jenis_soal, no from soal_detil a, jenissoal b where a.idsoal = '".$idsoal."' and a.idjenissoal = b.idjenissoal;");
            foreach ($list->result() as $row) {
                $str .= '<a href="javascript:void(0)" class="list-group-item" style="color: black; text-align: center;" onclick="load_soal_berikutnya('."'".$row->iddetil."'".','."'".$row->no."'".')"><strong># '.$row->no.'</strong></a>';
            }
            echo $str;
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function load_soal() {
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $idusers = $ses['username'];
            
            $idsoal = $this->modul->dekrip_url($this->uri->segment(3));
            $soal_pertama = $this->Mglobals->getAllQR("SELECT idsoal, iddetil, soal, idjenissoal, idhead_jawaban, no FROM soal_detil where idsoal = '".$idsoal."' limit 1;");
            // mencari jawaban soal pertama
            $str_jawaban = '<ul class="list-group list-group-horizontal">';
            $counter = 1;
            $list_jawaban = $this->Mglobals->getAllQ("SELECT id_detil, text, nilai, keterangan FROM jawaban_detil where idhead_jawaban = '".$soal_pertama->idhead_jawaban."';");
            foreach ($list_jawaban->result() as $row) {
                $jml_jawab = $this->Mglobals->getAllQR("select count(*) as jml from jawab_siswa where iddetil = '".$soal_pertama->iddetil."' and username = '".$idusers."' and id_detil = '".$row->id_detil."';")->jml;
                if($jml_jawab > 0){
                    $str_jawaban .= '<li id="_'.$counter.'" style="cursor: pointer;" class="list-group-item active" onclick="simpan('."'".$soal_pertama->idsoal."'".','."'".$soal_pertama->iddetil."'".','."'".$soal_pertama->idhead_jawaban."'".','."'".$row->id_detil."'".','."'".$counter."'".')">'.$row->text.'</li>';
                }else{
                    $str_jawaban .= '<li id="_'.$counter.'" style="cursor: pointer;" class="list-group-item" onclick="simpan('."'".$soal_pertama->idsoal."'".','."'".$soal_pertama->iddetil."'".','."'".$soal_pertama->idhead_jawaban."'".','."'".$row->id_detil."'".','."'".$counter."'".')">'.$row->text.'</li>';
                }
                $counter++;
            }
            $str_jawaban .= '</ul>';
            
            $no = $soal_pertama->no;
            $soal = $soal_pertama->soal;
            echo json_encode(array("no" => $no, "soal" => $soal, "jawaban" => $str_jawaban));
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function load_jawaban_saja(){
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $idusers = $ses['username'];
            
            $iddetil = $this->uri->segment(3);
            $idhead_jawaban = $this->uri->segment(4);
            $idsoal = $this->uri->segment(5);

            // mencari jawaban soal pertama
            $str_jawaban = '<ul class="list-group list-group-horizontal">';
            $counter = 1;
            $list_jawaban = $this->Mglobals->getAllQ("SELECT id_detil, text, nilai, keterangan FROM jawaban_detil where idhead_jawaban = '".$idhead_jawaban."';");
            foreach ($list_jawaban->result() as $row) {
                $jml_jawab = $this->Mglobals->getAllQR("select count(*) as jml from jawab_siswa where iddetil = '".$iddetil."' and username = '".$idusers."' and id_detil = '".$row->id_detil."';")->jml;
                if($jml_jawab > 0){
                    $str_jawaban .= '<li id="_'.$counter.'" style="cursor: pointer;" class="list-group-item active" onclick="simpan('."'".$idsoal."'".','."'".$iddetil."'".','."'".$idhead_jawaban."'".','."'".$row->id_detil."'".','."'".$counter."'".')">'.$row->text.'</li>';
                }else{
                    $str_jawaban .= '<li id="_'.$counter.'" style="cursor: pointer;" class="list-group-item" onclick="simpan('."'".$idsoal."'".','."'".$iddetil."'".','."'".$idhead_jawaban."'".','."'".$row->id_detil."'".','."'".$counter."'".')">'.$row->text.'</li>';
                }
                $counter++;
            }
            $str_jawaban .= '</ul>';
            
            echo json_encode(array("jawaban" => $str_jawaban));
        }else{
           $this->modul->halaman('login');
        }
    }
    
    public function prosesdata() {
        if($this->nativesession->get('logged_siswa')){
            $ses = $this->nativesession->get('logged_siswa');
            $idusers = $ses['username'];
            
            $jml = $this->Mglobals->getAllQR("select count(*) as jml from jawab_siswa where iddetil = '".$this->input->post('iddetil')."' and username = '".$idusers."';")->jml;
            if($jml > 0){
                $data = array(
                    'idhead_jawaban' => $this->input->post('jawab_head'),
                    'id_detil' => $this->input->post('jawab_detil')
                );
                $kond['idsoal'] = $this->input->post('idsoal');
                $kond['iddetil'] = $this->input->post('iddetil');
                $kond['username'] = $idusers;
                $simpan = $this->Mglobals->update("jawab_siswa",$data, $kond);
                if($simpan == 1){
                    $status = "Jawaban tersimpan";
                }else{
                    $status = "Jawaban gagal tersimpan";
                }
            }else{
                $data = array(
                    'idjawab_siswa' => $this->Mglobals->autokode("J","idjawab_siswa","jawab_siswa", 2, 7),
                    'idsoal' => $this->input->post('idsoal'),
                    'iddetil' => $this->input->post('iddetil'),
                    'idhead_jawaban' => $this->input->post('jawab_head'),
                    'id_detil' => $this->input->post('jawab_detil'),
                    'username' => $idusers
                );
                $simpan = $this->Mglobals->add("jawab_siswa",$data);
                if($simpan == 1){
                    $status = "Jawaban tersimpan";
                }else{
                    $status = "Jawaban gagal tersimpan";
                }
            }
            echo json_encode(array("status" => $status));
        }else{
           $this->modul->halaman('login');
        }
    }


    public function halamanjitsi() {
        if($this->nativesession->get('logged_siswa')){
			$ses = $this->nativesession->get('logged_siswa');
            $data['username'] = $ses['username'];
            $data['nama'] = $ses['nama'];
			$data['idsoal'] = $this->uri->segment(3);
			
			$this->load->view('kerja_soal/jitsi',$data);
        }else{
           $this->modul->halaman('login');
        }
    }

}
