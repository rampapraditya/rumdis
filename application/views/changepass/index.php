<script type="text/javascript">

    $(document).ready(function () {

    });
    
    function simpan(){
        var lama = document.getElementById('pass_lama').value;
        var baru = document.getElementById('pass_baru').value;
        
        if(lama === ""){
            iziToast.success({
                title: 'Info',
                message: 'Passsword lama tidak boleh kosong',
                position: 'topRight'
            });
            
        }else if(baru === ""){
            iziToast.success({
                title: 'Info',
                message: 'Passsword baru tidak boleh kosong',
                position: 'topRight'
            });
            
        }else{
            
            var form_data = new FormData();
            form_data.append('lama', lama);
            form_data.append('baru', baru);

            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled',true);
            $.ajax({
                url: "<?php echo base_url(); ?>changepass/proses",
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
                    
                    document.getElementById('pass_lama').value = "";
                    document.getElementById('pass_baru').value = "";
                    
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
            <h1>GANTI PASSWORD</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="form">
                                <div class="form-group">
                                    <label>PASSWORD LAMA</label>
                                    <input id="pass_lama" name="pass_lama" type="password" class="form-control" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>PASSWORD BARU</label>
                                    <input id="pass_baru" name="pass_baru" type="password" class="form-control" autocomplete="off">
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