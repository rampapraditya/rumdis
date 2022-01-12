<script type="text/javascript">

    var save_method = "";
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>personiluser/ajaxkeluarga/<?php echo $id_personil; ?>",
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
        }else if(hubungan === "-"){
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
                url = "<?php echo base_url(); ?>personiluser/ajax_add_keluarga";
            } else {
                url = "<?php echo base_url(); ?>personiluser/ajax_edit_keluarga";
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
                url: "<?php echo base_url(); ?>personiluser/hapuskeluarga/" + id,
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
        $('.modal-title').text('Ganti korps');
        $.ajax({
            url: "<?php echo base_url(); ?>personiluser/gantikeluarga/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idpers_kel);
                $('[name="nama"]').val(data.nama);
                if(data.jkel === "Laki-laki"){
                    $('#rbLaki').prop("checked", true);
                    $('#rbPerempuan').prop("checked", false);
                }else if(data.jkel === "Perempuan"){
                    $('#rbLaki').prop("checked", false);
                    $('#rbPerempuan').prop("checked", true);
                }else{
                    $('#rbLaki').prop("checked", true);
                    $('#rbPerempuan').prop("checked", false);
                }
                $('[name="tmp"]').val(data.tmp_lahir);
                $('[name="tgl"]').val(data.tgl_lahir);
                $('[name="hubungan"]').val(data.hubungan);
            },error: function (jqXHR, textStatus, errorThrown) {
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }
    
</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>KELUARGA PERSONIL</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>NRP</label>
                                <input type="text" class="form-control" autocomplete="off" readonly value="<?php echo $nrp; ?>">
                            </div>
                            <div class="form-group">
                                <label>PERSONIL</label>
                                <input type="text" class="form-control" autocomplete="off" readonly value="<?php echo $pangkat_personil.' - '.$nm_personil; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <input type="hidden" name="idperonil" id="idperonil" value="<?php echo $id_personil; ?>">
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