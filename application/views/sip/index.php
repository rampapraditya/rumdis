<script type="text/javascript">

    var save_method = "";
    var table, tb_personil, tb_rumdis;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>sip/ajaxlist",
            ordering:false
        });
    });

    function reload() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah surat izin penghunian');
    }
    
    function show_personil(){
        $('#modal_personil').modal('show');
        tb_personil = $('#tb_personil').DataTable({
            ajax: "<?php echo base_url(); ?>sip/ajaxpersonil",
            ordering:false,
            retrieve:true
        });
        tb_personil.destroy();
        tb_personil = $('#tb_personil').DataTable({
            ajax: "<?php echo base_url(); ?>sip/ajaxpersonil",
            ordering:false,
            retrieve:true
        });
    }
    
    function pilih_personil(id, nrp, nama){
        $('[name="idpersonil"]').val(id);
        $('[name="nrp_nama"]').val(nrp + " - " + nama);
        $('#modal_personil').modal('hide');
    }
    
    function show_rumdis(){
        $('#modal_rumdis').modal('show');
        tb_rumdis = $('#tb_rumdis').DataTable({
            ajax: "<?php echo base_url(); ?>sip/ajaxrumdis",
            ordering:false,
            retrieve:true
        });
        tb_rumdis.destroy();
        tb_rumdis = $('#tb_rumdis').DataTable({
            ajax: "<?php echo base_url(); ?>sip/ajaxrumdis",
            ordering:false,
            retrieve:true
        });
    }
    
    function pilih_rumdis(id, nama, alamat){
        $('[name="idrumah_dinas"]').val(id);
        $('[name="nama_alamat"]').val(nama + " - " + alamat);
        $('#modal_rumdis').modal('hide');
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var idpersonil = document.getElementById('idpersonil').value;
        var idrumah_dinas = document.getElementById('idrumah_dinas').value;
        var no_sip = document.getElementById('no_sip').value;
        var file = $('#doc_sip').prop('files')[0];
        
        if (idpersonil === "") {
            iziToast.warning({
                title: 'Info',
                message: 'Pilih personil terlebih dahulu',
                position: 'topRight'
            });
        }else if(idrumah_dinas === ""){
            iziToast.warning({
                title: 'Info',
                message: 'Pilih rumah dinas terlebih dahulu',
                position: 'topRight'
            });
        }else if(no_sip === ""){
            iziToast.warning({
                title: 'Info',
                message: 'NO SIP tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>sip/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>sip/ajax_edit";
            }
            
            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('idpersonil', idpersonil);
            form_data.append('idrumah_dinas', idrumah_dinas);
            form_data.append('no_sip', no_sip);
            form_data.append('file', file);
            
            $.ajax({
                url: url,
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

    function hapus(id, no_sip) {
        if (confirm("Apakah anda yakin menghapus SIP dengan nomor " + no_sip + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>sip/hapus/" + id,
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
        $('.modal-title').text('Ganti surat izin penghunian');
        $.ajax({
            url: "<?php echo base_url(); ?>sip/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.kode);
                $('[name="idpersonil"]').val(data.idpersonil);
                $('[name="nrp_nama"]').val(data.nrp_nama);
                $('[name="idrumah_dinas"]').val(data.idrumah_dinas);
                $('[name="nama_alamat"]').val(data.nama_alamat);
                $('[name="no_sip"]').val(data.no_sip);
                
            },error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }
    
    function unduh(kode){
        window.location.href = "<?php echo base_url(); ?>sip/unduhfile/"+kode;
    }

</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>SURAT IZIN PENGHUNIAN</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn  btn-outline-success" onclick="add();">Add Data </button>
                            <button class="btn btn-outline-secondary" style="margin-left: 5px;" onclick="reload();">Reload</button>    
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table id="tb" class="table table-striped" style="width: 100%;">
                                    <thead>                                 
                                        <tr>
                                            <th style="text-align: center;">RUMDIS</th>
                                            <th style="text-align: center;">ALAMAT</th>
                                            <th style="text-align: center;">NRP</th>
                                            <th style="text-align: center;">NAMA</th>
                                            <th style="text-align: center;">NO SIP</th>
                                            <th style="text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Bootstrap modal -->
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
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">PERSONIL</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input id="idpersonil" name="idpersonil" type="hidden" readonly="">
                                    <input id="nrp_nama" name="nrp_nama" type="text" class="form-control" autocomplete="off" readonly="">
                                    <div class="input-group-append">
                                        <div class="input-group-text btn-primary" style="cursor: pointer;" onclick="show_personil();">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">RUMAH DINAS</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input id="idrumah_dinas" name="idrumah_dinas" type="hidden" readonly="">
                                    <input id="nama_alamat" name="nama_alamat" type="text" class="form-control" autocomplete="off" readonly="">
                                    <div class="input-group-append">
                                        <div class="input-group-text btn-primary" style="cursor: pointer;" onclick="show_rumdis();">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">NO SIP</label>
                            <div class="col-md-12">
                                <input id="no_sip" name="no_sip" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">DOKUMEN SIP</label>
                            <div class="col-md-12">
                                <input id="doc_sip" name="doc_sip" class="form-control" type="file" autocomplete="off">
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

<div class="modal fade" id="modal_personil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Data Personil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tb_personil" class="table table-striped" style="width: 100%;">
                    <thead>                                 
                        <tr>
                            <th style="text-align: center;">NRP</th>
                            <th style="text-align: center;">NAMA</th>
                            <th style="text-align: center;">PANGKAT</th>
                            <th style="text-align: center;">KORPS</th>
                            <th style="text-align: center;">STATUS</th>
                            <th style="text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_rumdis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Data Rumah Dinas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tb_rumdis" class="table table-striped" style="width: 100%;">
                    <thead>                                 
                        <tr>
                            <th style="text-align: center;">RUMDIS</th>
                            <th style="text-align: center;">ALAMAT</th>
                            <th style="text-align: center;">PENGHUNI</th>
                            <th style="text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>