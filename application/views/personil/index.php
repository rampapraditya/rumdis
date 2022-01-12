<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>personil/ajaxlist",
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
        $('.modal-title').text('Tambah personil');
    }

    function save() {
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var status = document.getElementById('status').value;
        
        if (nrp === "") {
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
        }else if(status === "-"){
            iziToast.warning({
                title: 'Info',
                message: 'Pilih status terlebih dahulu',
                position: 'topRight'
            });
            
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>personil/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>personil/ajax_edit";
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

    function hapus(id, nrp) {
        if (confirm("Apakah anda yakin menghapus personil " + nrp + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>personil/hapus/" + id,
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
        $('.modal-title').text('Ganti personil');
        $.ajax({
            url: "<?php echo base_url(); ?>personil/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpersonil);
                $('[name="nrp"]').val(data.nrp);
                $('[name="nama"]').val(data.nama);
                $('[name="pangkat"]').val(data.idpangkat);
                $('[name="korps"]').val(data.idkorps);
                $('[name="status"]').val(data.status);
            },error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }
    
    function keluarga(kode){
        window.location.href = "<?php echo base_url(); ?>personil/detil/" + kode;
    }

</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>MASTER PERSONIL</h1>
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
                                            <th style="text-align: center;">#</th>
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
                            <label class="control-label col-md-12">STATUS</label>
                            <div class="col-md-12">
                                <select id="status" name="status" class="form-control">
                                    <option value="-">- PILIH STATUS -</option>
                                    <option value="AKTIF">AKTIF</option>
                                    <option value="PURNAWIRAWAN">PURNAWIRAWAN</option>
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