<script type="text/javascript">

    $(document).ready(function () {

    });
    
    function simpan(){
        var ins = document.getElementById('ins').value;
        var tahun = document.getElementById('tahun').value;
        var pimpinan = document.getElementById('pimpinan').value;
        var alamat = document.getElementById('alamat').value;
        var kdpos = document.getElementById('kdpos').value;
        var tlp = document.getElementById('tlp').value;
        var fax = document.getElementById('fax').value;
        var web = document.getElementById('web').value;
        var foto = $('#logo').prop('files')[0];
        
        if(ins === ""){
            iziToast.success({
                title: 'Info',
                message: 'Instansi tidak boleh kosong',
                position: 'topRight'
            });
            
        }else if(alamat === ""){
            iziToast.success({
                title: 'Info',
                message: 'Alamat tidak boleh kosong"',
                position: 'topRight'
            });
            
        }else if(tlp === ""){
            iziToast.success({
                title: 'Info',
                message: 'Telepon tidak boleh kosong"',
                position: 'topRight'
            });
            
        }else{
            $('#btnSave').html('<i class="mdi mdi-content-save"></i> Proses... ');
            $('#btnSave').attr('disabled',true);

            var form_data = new FormData();
            form_data.append('nama', ins);
            form_data.append('tahun', tahun);
            form_data.append('pimpinan', pimpinan);
            form_data.append('alamat', alamat);
            form_data.append('kdpos', kdpos);
            form_data.append('tlp', tlp);
            form_data.append('fax', fax);
            form_data.append('web', web);
            form_data.append('file', foto);
            
            $.ajax({
                url: "<?php echo base_url(); ?>identitas/proses",
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
                    $('#btnSave').attr('disabled',false);

                },error: function (response) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });

                    $('#btnSave').html('<i class="mdi mdi-content-save"></i> Simpan ');
                    $('#btnSave').attr('disabled',false);
                }
            });
        }
    }
    
</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <label style="font-size: 16px;"><b><?php echo $pangkat_user.' '.$korps_user.' '.$nama_user.' - '.$nrp_user; ?></b></label>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label style="font-size: 14px;"><b>ALAMAT RUMDIS</b></label>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>RT</label>
                                        <input type="text" class="form-control" id="rt" name="rt" autofocus autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>RW</label>
                                        <input type="text" class="form-control" id="rw" name="rw" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jalan</label>
                                        <input type="text" class="form-control" id="jalan" name="jalan" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label style="font-size: 14px;"><b>SIP</b></label>
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>NO</label>
                                        <input type="text" class="form-control" id="no" name="no" autofocus autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>BL</label>
                                        <input type="text" class="form-control" id="bl" name="bl" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>TH</label>
                                        <input type="text" class="form-control" id="th" name="th" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>BLOK</label>
                                        <input type="text" class="form-control" id="blok" name="blok" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>