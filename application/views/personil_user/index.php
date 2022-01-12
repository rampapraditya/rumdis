<script type="text/javascript">

    $(document).ready(function () {
        
    });

    function simpan() {
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var status = document.getElementById('status').value;
        var foto = $('#foto').prop('files')[0];
        
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
            
            var form_data = new FormData();
            form_data.append('nrp', nrp);
            form_data.append('nama', nama);
            form_data.append('korps', korps);
            form_data.append('pangkat', pangkat);
            form_data.append('status', status);
            form_data.append('file', foto);
            
            $.ajax({
                url: "<?php echo base_url(); ?>profileuser/proses",
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
                    
                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled',false);

                },error: function (response) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled',false);
                }
            });
            
        }
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
                            <form id="form">
                                <div class="form-group">
                                    <label>NRP</label>
                                    <input id="nrp" name="nrp" class="form-control" type="text" autocomplete="off" readonly value="<?php echo $nrp; ?>">
                                </div>
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input id="nama" name="nama" class="form-control" type="text" autocomplete="off" value="<?php echo $nm_personil; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PANGKAT</label>
                                    <select id="pangkat" name="pangkat" class="form-control">
                                        <option value="-">- PILIH PANGKAT -</option>
                                        <?php
                                        foreach ($pangkat->result() as $row) {
                                            if($row->idpangkat == $pangkat_personil){
                                                ?>
                                        <option selected value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                                <?php
                                            }else{
                                                ?>
                                        <option value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>KORPS</label>
                                    <select id="korps" name="korps" class="form-control">
                                        <option value="-">- PILIH KORPS -</option>
                                        <?php
                                        foreach ($korps->result() as $row) {
                                            if($row->idkorps == $korps_personil){
                                                ?>
                                        <option selected value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                                <?php
                                            }else{
                                                ?>
                                        <option value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                                <?php
                                            }
                                            
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>STATUS</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="-">- PILIH STATUS -</option>
                                        <option <?php  if($status_personil == "AKTIF"){ echo "selected"; } ?> value="AKTIF">AKTIF</option>
                                        <option <?php  if($status_personil == "PURNAWIRAWAN"){ echo "selected"; } ?> value="PURNAWIRAWAN">PURNAWIRAWAN</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer with-border">
                            <button id="btnSave" type="button" onclick="simpan();" class="btn btn-block btn-primary"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>