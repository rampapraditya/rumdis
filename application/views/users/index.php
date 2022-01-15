<script type="text/javascript">

    var save_method = "";
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>users/ajaxlist",
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
        $('.modal-title').text('Tambah users');
        $('[name="nrp"]').attr("readonly", false);
    }

    function save() {
        var kode = document.getElementById('kode').value;
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var pass = document.getElementById('pass').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var komplek = document.getElementById('komplek').value;
        var foto = $('#foto').prop('files')[0];
        
        if (nrp === '') {
            iziToast.warning({
                title: 'Info',
                message: 'NRP tidak boleh kosong',
                position: 'topRight'
            });
        }else if(nama === ""){
            iziToast.warning({
                title: 'Info',
                message: 'Nama tidak boleh kosong',
                position: 'topRight'
            });
        }else if(pass === ""){
            iziToast.warning({
                title: 'Info',
                message: 'Password tidak boleh kosong',
                position: 'topRight'
            });
        }else if(pangkat === "-"){
            iziToast.warning({
                title: 'Info',
                message: 'Pilih pangkat terlebih dahulu',
                position: 'topRight'
            });
        }else if(korps === "-"){
            iziToast.warning({
                title: 'Info',
                message: 'Pilih korps terlebih dahulu',
                position: 'topRight'
            });
        }else if(komplek === "-"){
            iziToast.warning({
                title: 'Info',
                message: 'Pilih komplek terlebih dahulu',
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>users/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>users/ajax_edit";
            }
            
            $('#btnSave').text('Loading...');
            $('#btnSave').attr('disabled',true);

            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nrp', nrp);            
            form_data.append('nama', nama);
            form_data.append('pass', pass);
            form_data.append('pangkat', pangkat);
            form_data.append('korps', korps);
            form_data.append('komplek', komplek);
            form_data.append('file', foto);
            
            $.ajax({
                url: url,
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
                    reload();
                    $('#modal_form').modal('hide');
                    
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);

                },error: function (response) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }
            });           
        }
    }

    function hapus(id, nrp) {
        if (confirm("Apakah anda yakin menghapus users " + nrp + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>users/hapus/" + id,
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
        $('.modal-title').text('Ganti users');
        $('[name="nrp"]').attr("readonly", true);
        $.ajax({
            url: "<?php echo base_url(); ?>users/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.kode);
                $('[name="nrp"]').val(data.nrp);
                $('[name="nama"]').val(data.nama);
                $('[name="pass"]').val(data.pass);
                $('[name="pangkat"]').val(data.pangkat);
                $('[name="korps"]').val(data.korps);
                $('[name="komplek"]').val(data.komplek);
            },error: function (jqXHR, textStatus, errorThrown) {
                
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }
    
    function detil(kode){
        window.location.href = "<?php echo base_url(); ?>users/detil/" + kode;
    }

</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>MASTER USERS</h1>
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
                                            <th style="text-align: center;">FOTO</th>
                                            <th style="text-align: center;">PANGKAT</th>
                                            <th style="text-align: center;">KORPS</th>
                                            <th style="text-align: center;">NRP</th>
                                            <th style="text-align: center;">NAMA</th>
                                            <th style="text-align: center;">KOMPLEK</th>
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
                            <label class="control-label col-md-12">FOTO</label>
                            <div class="col-md-12">
                                <input id="foto" name="foto" class="form-control" type="file" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">NRP</label>
                            <div class="col-md-12">
                                <input id="nrp" name="nrp" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">NAMA</label>
                            <div class="col-md-12">
                                <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">PASSWORD</label>
                            <div class="col-md-12">
                                <input id="pass" name="pass" class="form-control" type="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">PANGKAT</label>
                            <div class="col-md-12">
                                <select id="pangkat" name="pangkat" class="form-control">
                                    <option value="-">- PILIH PANGKAT -</option>
                                    <?php
                                    foreach ($pangkat->result() as $row) {
                                        ?>
                                    <option value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">KORPS</label>
                            <div class="col-md-12">
                                <select id="korps" name="korps" class="form-control">
                                    <option value="-">- PILIH KORPS -</option>
                                    <?php
                                    foreach ($korps->result() as $row) {
                                        ?>
                                    <option value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">KOMPLEK</label>
                            <div class="col-md-12">
                                <select id="komplek" name="komplek" class="form-control">
                                    <option value="-">- PILIH KOMPLEK -</option>
                                    <?php
                                    foreach ($komplek->result() as $row) {
                                        ?>
                                    <option value="<?php echo $row->idkomplek; ?>"><?php echo $row->nama_komplek; ?></option>
                                        <?php
                                    }
                                    ?>
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