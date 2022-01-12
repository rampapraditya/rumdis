<script type="text/javascript">

    var save_method = "";
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>korps/ajaxlist",
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
        $('.modal-title').text('Tambah korps');
    }

    function save() {
        var nama = document.getElementById('nama').value;
        if (nama === '') {
            iziToast.warning({
                title: 'Info',
                message: 'Nama korps tidak boleh kosong',
                position: 'topRight'
            });
            
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>korps/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>korps/ajax_edit";
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

    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus korps " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>korps/hapus/" + id,
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
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Ganti korps'); // Set title to Bootstrap modal title        
        $.ajax({
            url: "<?php echo base_url(); ?>korps/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idkorps);
                $('[name="nama"]').val(data.nama_korps);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                
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
            <h1>MASTER KORPS</h1>
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
                                            <th style="text-align: center;">NAMA KORPS</th>
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
                            <label class="control-label col-md-12">NAMA KORPS</label>
                            <div class="col-md-12">
                                <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
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