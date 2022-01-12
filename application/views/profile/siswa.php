<script type="text/javascript">

    $(document).ready(function () {

    });
    
    function simpan(){
        var email = document.getElementById('email').value;
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var angkatan = document.getElementById('angkatan').value;
        var kelas = document.getElementById('kelas').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var alamat = document.getElementById('alamat').value;
        var tgllahir = document.getElementById('tgllahir').value;
        
        var jkel = "";
        if(document.getElementById('rbL').checked){
            jkel = "L";
        }else if(document.getElementById('rbP').checked){
            jkel = "P";
        }else{
            jkel = "L";
        }
        
        var tlp = document.getElementById('tlp').value;
        var agama = document.getElementById('agama').value;
        var foto = $('#foto').prop('files')[0];
        
        if(email === ""){
            iziToast.success({
                title: 'Info',
                message: 'Email tidak boleh kosong',
                position: 'topRight'
            });
        }else if(nrp === ""){
            iziToast.success({
                title: 'Info',
                message: 'NRP tidak boleh kosong',
                position: 'topRight'
            });
        }else if(nama === ""){
            iziToast.success({
                title: 'Info',
                message: 'Nama lengkap tidak boleh kosong',
                position: 'topRight'
            });
            
        }else{
            
            var form_data = new FormData();
            form_data.append('email', email);
            form_data.append('nrp', nrp);
            form_data.append('nama', nama);
            form_data.append('angkatan', angkatan);
            form_data.append('kelas', kelas);
            form_data.append('pangkat', pangkat);
            form_data.append('korps', korps);
            form_data.append('alamat', alamat);
            form_data.append('tgllahir', tgllahir);
            form_data.append('jkel', jkel);
            form_data.append('tgllahir', tgllahir);
            form_data.append('tlp', tlp);
            form_data.append('agama', agama);
            form_data.append('file', foto);

            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled',true);
            $.ajax({
                url: "<?php echo base_url(); ?>profilesiswa/proses",
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
                    iziToast.error({
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
            <h1>PROFILE PENGGUNA</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="form">
                                <div class="form-group">
                                    <label>NRP</label>
                                    <input id="nrp" name="nrp" type="text" class="form-control" autocomplete="off" value="<?php echo $tersimpan->nrp; ?>">
                                </div>
                                <div class="form-group">
                                    <label>NAMA PERSONIL</label>
                                    <input id="nama" name="nama" type="text" class="form-control" autocomplete="off" value="<?php echo $tersimpan->nama; ?>">
                                </div>
                                <div class="form-group">
                                    <label>PANGKAT</label>
                                    <select id="pangkat" name="pangkat" class="form-control">
                                        <option value="-">- Pilih Pangkat -</option>
                                        <?php
                                        foreach ($pangkat->result() as $row) {
                                            ?>
                                        <option <?php if($row->idpangkat == $tersimpan->idpangkat){ echo 'selected'; } ?>  value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>KORPS</label>
                                    <select id="korps" name="korps" class="form-control">
                                        <option value="-">- Pilih Korps -</option>
                                        <?php
                                        foreach ($korps->result() as $row) {
                                            ?>
                                        <option <?php if($row->idkorps == $tersimpan->idkorps){ echo 'selected'; } ?>  value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>FOTO PROFILE</label>
                                    <input id="foto" name="foto" type="file" class="form-control">
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