<script type="text/javascript">

    var save_method = "";
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>users/ajaxkeluarga/<?php echo $iduser; ?>",
            ordering:false
        });
    });
    
    function simpan() {
        $('#btnSave').html('<i class="mdi mdi-content-save"></i> Proses... ');
        $('#btnSave').attr('disabled', true);

        var form_data = new FormData();
        form_data.append('key', $('#key').val());
        form_data.append('rt', $('#rt').val());
        form_data.append('rw', $('#rw').val());
        form_data.append('jalan', $('#jalan').val());
        form_data.append('no', $('#no').val());
        form_data.append('bl', $('#bl').val());
        form_data.append('th', $('#th').val());
        form_data.append('blok', $('#blok').val());
        form_data.append('kesatuan', $('#kesatuan').val());
        form_data.append('th_penugasan', $('#th_penugasan').val());
        form_data.append('asal_usul', $('#asal_usul').val());
        form_data.append('l_bangunan', $('#l_bangunan').val());
        form_data.append('l_tanah', $('#l_tanah').val());
        form_data.append('tipe', $('#tipe').val());
        form_data.append('b_rr_rb', $('#b_rr_rb').val());
        form_data.append('ketentuan_sewa', $('#ketentuan_sewa').val());
        form_data.append('keterangan', $('#keterangan').val());

        $.ajax({
            url: "<?php echo base_url(); ?>users/prosesdetil",
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'POST',
            success: function (response) {
                iziToast.success({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#btnSave').html('<i class="mdi mdi-content-save"></i> Simpan ');
                $('#btnSave').attr('disabled', false);

            }, error: function (response) {

                iziToast.success({
                    title: 'Info',
                    message: response.status,
                    position: 'topRight'
                });

                $('#btnSave').html('<i class="mdi mdi-content-save"></i> Simpan ');
                $('#btnSave').attr('disabled', false);
            }
        });
    }

    function reload() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah keluarga');
    }

    function save() {
        var nama = document.getElementById('nama').value;
        var hubungan = document.getElementById('hubungan').value;
        if (nama === '') {
            iziToast.warning({
                title: 'Info',
                message: 'Nama tidak boleh kosong',
                position: 'topRight'
            });
        } else if (hubungan === "-") {
            iziToast.warning({
                title: 'Info',
                message: 'Hubungan tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>users/ajax_add_keluarga";
            } else {
                url = "<?php echo base_url(); ?>users/ajax_edit_keluarga";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data) {

                    iziToast.success({
                        title: 'Info',
                        message: data.status,
                        position: 'topRight'
                    });

                    $('#modal_form').modal('hide');
                    reload();

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }, error: function (jqXHR, textStatus, errorThrown) {

                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }
            });

        }
    }

    function hapus(id, no) {
        if (confirm("Apakah anda yakin menghapus keluarga nomor " + no + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>users/hapuskeluarga/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    iziToast.success({
                        title: 'Info',
                        message: data.status,
                        position: 'topRight'
                    });

                    reload();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    iziToast.error({
                        title: 'Info',
                        message: "Error hapus data",
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function ganti(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Ganti keluarha');
        $.ajax({
            url: "<?php echo base_url(); ?>users/gantikeluarga/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idkeluarga);
                $('[name="nama"]').val(data.nama);
                if (data.jkel === "Laki-laki") {
                    $('#rbLaki').prop("checked", true);
                    $('#rbPerempuan').prop("checked", false);
                } else if (data.jkel === "Perempuan") {
                    $('#rbLaki').prop("checked", false);
                    $('#rbPerempuan').prop("checked", true);
                } else {
                    $('#rbLaki').prop("checked", true);
                    $('#rbPerempuan').prop("checked", false);
                }
                $('[name="tmp"]').val(data.tmp_lahir);
                $('[name="tgl"]').val(data.tgl_lahir);
                $('[name="hubungan"]').val(data.hubungan);
            }, error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }
    
    function simpan_sip(){
        var no_sip = document.getElementById('no_sip').value;
        var file = $('#doc_sip').prop('files')[0];
        
        if(no_sip === ""){
            iziToast.warning({
                title: 'Info',
                message: 'NO SIP tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            $('#btnSaveSIP').text('Saving...');
            $('#btnSaveSIP').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('iduserslogin', $('#key').val());
            form_data.append('no_sip', no_sip);
            form_data.append('file', file);
            
            $.ajax({
                url: "<?php echo base_url(); ?>users/prosessip",
                dataType: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (data) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: data.status,
                        position: 'topRight'
                    });

                    $('#btnSaveSIP').text('Save');
                    $('#btnSaveSIP').attr('disabled', false);
                }, error: function (jqXHR, textStatus, errorThrown) {
                    
                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSaveSIP').text('Save');
                    $('#btnSaveSIP').attr('disabled', false);
                }
            });
            
        }
    }
    
    function unduh(kode){
        window.location.href = "<?php echo base_url(); ?>users/unduhfile/"+kode;
    }

</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <input type="hidden" id="key" name="key" value="<?php echo $iduser; ?>">
            <label style="font-size: 16px;"><b><?php echo $pangkat_user . ' ' . $korps_user . ' ' . $nama_user . ' - ' . $nrp_user; ?></b></label>
        </div>
        <div class="section-body">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav_tab_diri" data-toggle="tab" href="#nav_diri" role="tab" aria-controls="nav_diri" aria-selected="true">Identitas Diri</a>
                    <a class="nav-item nav-link" id="nav_tab_keluarga" data-toggle="tab" href="#nav_keluarga" role="tab" aria-controls="nav_keluarga" aria-selected="false">Keluarga</a>
                    <a class="nav-item nav-link" id="nav_tab_sip" data-toggle="tab" href="#nav_sip" role="tab" aria-controls="nav_sip" aria-selected="false">SIP</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="background-color: white;">
                <div class="tab-pane fade show active" id="nav_diri" role="tabpanel" aria-labelledby="nav_diri" style="background-color: white;">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>RT</label>
                                        <input type="text" class="form-control" id="rt" name="rt" autofocus autocomplete="off" value="<?php echo $rt; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>RW</label>
                                        <input type="text" class="form-control" id="rw" name="rw" autocomplete="off" value="<?php echo $rw; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jalan</label>
                                        <input type="text" class="form-control" id="jalan" name="jalan" autocomplete="off" value="<?php echo $jalan; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>NO</label>
                                        <input type="text" class="form-control" id="no" name="no" autocomplete="off" value="<?php echo $no; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>BULAN</label>
                                        <input type="text" class="form-control" id="bl" name="bl" autocomplete="off" value="<?php echo $bl; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>TAHUN</label>
                                        <input type="text" class="form-control" id="th" name="th" autocomplete="off" value="<?php echo $th; ?>">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>BLOK</label>
                                        <input type="text" class="form-control" id="blok" name="blok" autocomplete="off" value="<?php echo $blok; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>KESATUAN</label>
                                        <input type="text" class="form-control" id="kesatuan" name="kesatuan" autocomplete="off" value="<?php echo $kesatuan; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TAHUN PEMBUATAN/PENGUASAAN</label>
                                        <input type="text" class="form-control" id="th_penugasan" name="th_penugasan" autocomplete="off" value="<?php echo $th_penugasan; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ASAL / USUL</label>
                                        <input type="text" class="form-control" id="asal_usul" name="asal_usul" autocomplete="off" value="<?php echo $asal_usul; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Luas Bangunan</label>
                                        <input type="text" class="form-control" id="l_bangunan" name="l_bangunan" autocomplete="off" value="<?php echo $luas_bangunan; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Luas Tanah</label>
                                        <input type="text" class="form-control" id="l_tanah" name="l_tanah" autocomplete="off" value="<?php echo $luas_tanah; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipe</label>
                                        <input type="text" class="form-control" id="tipe" name="tipe" autocomplete="off" value="<?php echo $tipe; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>B / RR / RB</label>
                                        <select id="b_rr_rb" name="b_rr_rb" class="form-control">
                                            <option value="" <?php if ($b_rr_rb == "") { echo 'selected'; } ?> >- PILIH -</option>
                                            <option value="B" <?php if ($b_rr_rb == "B") { echo 'selected'; } ?> >B</option>
                                            <option value="RR" <?php if ($b_rr_rb == "RR") { echo 'selected'; } ?> >RR</option>
                                            <option value="RB" <?php if ($b_rr_rb == "RB") { echo 'selected'; } ?> >RB</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ketentuan Sewa</label><br>
                                        <select id="ketentuan_sewa" name="ketentuan_sewa" class="form-control">
                                            <option value="" <?php if ($sewa == "") { echo 'selected'; } ?> >- PILIH -</option>
                                            <option value="tidak" <?php if ($sewa == "tidak") { echo 'selected';} ?> >Tidak Dikenakan</option>
                                            <option value="ya" <?php if ($sewa == "ya") { echo 'selected'; } ?> >Dikenakan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" autocomplete="off" value="<?php echo $keterangan; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="btnSave" type="button" onclick="simpan();" class="btn btn-block btn-primary"> Save </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav_keluarga" role="tabpanel" aria-labelledby="nav_keluarga">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn  btn-outline-success" onclick="add();">Tambah </button>
                            <button class="btn btn-outline-secondary" style="margin-left: 5px;" onclick="reload();">Reload</button>    
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table id="tb" class="table table-striped" style="width: 100%;">
                                    <thead>                                 
                                        <tr>
                                            <th style="text-align: center;">#</th>
                                            <th style="text-align: center;">NAMA</th>
                                            <th style="text-align: center;">JKEL</th>
                                            <th style="text-align: center;">TTL</th>
                                            <th style="text-align: center;">HUBUNGAN</th>
                                            <th style="text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav_sip" role="tabpanel" aria-labelledby="nav_sip">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>NO SIP</label>
                                <input id="no_sip" name="no_sip" class="form-control" type="text" autocomplete="off" value="<?php echo $no_sip; ?>">
                            </div>
                            <div class="form-group">
                                <label>DOKUMEN SIP</label>
                                <input type="file" class="form-control" id="doc_sip" name="doc_sip">
                            </div>
                            <?php
                            if($unduh == "ya"){
                                ?>
                            <div class="form-group">
                                <label>DOKUMEN SIP ( TERSIMPAN )</label><br>
                                <input type="button" value="Unduh" class="btn btn-xs btn-info" onclick="unduh('<?php echo $this->modul->enkrip_url($iduser); ?>');">
                            </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer with-border">
                            <button id="btnSaveSIP" type="button" onclick="simpan_sip();" class="btn btn-block btn-primary"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="form-horizontal">
                    <input type="hidden" name="kode" id="kode">
                    <input type="hidden" name="idusers" id="idusers" value="<?php echo $iduser; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">NAMA</label>
                            <div class="col-md-12">
                                <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">JKEL</label>
                            <div class="col-md-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rbLaki" value="Laki-laki" name="jkel" checked>
                                    <label class="form-check-label" for="rbLaki">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="rbPerempuan" value="Perempuan" name="jkel">
                                    <label class="form-check-label" for="rbPerempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">TEMPAT LAHIR</label>
                            <div class="col-md-12">
                                <input id="tmp" name="tmp" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">TANGGAL LAHIR</label>
                            <div class="col-md-12">
                                <input id="tgl" name="tgl" class="form-control" type="date" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">HUBUNGAN</label>
                            <div class="col-md-12">
                                <select id="hubungan" name="hubungan" class="form-control">
                                    <option value="-">- PILIH -</option>
                                    <option value="ISTRI">ISTRI</option>
                                    <option value="SUAMI">SUAMI</option>
                                    <option value="ANAK">ANAK</option>
                                    <option value="ORTU">ORTU</option>
                                    <option value="SAUDARA">SAUDARA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save();" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>