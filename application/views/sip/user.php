<script type="text/javascript">

    $(document).ready(function () {
        
    });

    function simpan() {
        var no_sip = document.getElementById('no_sip').value;
        var file = $('#doc_sip').prop('files')[0];
        
        if(no_sip === ""){
            iziToast.warning({
                title: 'Info',
                message: 'NO SIP tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...');
            $('#btnSave').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('no_sip', no_sip);
            form_data.append('file', file);
            
            $.ajax({
                url: "<?php echo base_url(); ?>sipuser/proses",
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

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }, error: function (jqXHR, textStatus, errorThrown) {
                    
                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save');
                    $('#btnSave').attr('disabled', false);
                }
            });
            
        }
    }

    function unduh(kode){
        window.location.href = "<?php echo base_url(); ?>sipuser/unduhfile/"+kode;
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
                            <form id="form">
                                <div class="form-group">
                                    <label>PERSONIL</label>
                                    <input id="nrp" name="nrp" class="form-control" type="text" autocomplete="off" readonly value="<?php echo $nrp.' - '.$nm_personil; ?>">
                                </div>
                                <div class="form-group">
                                    <label>RUMAH DINAS</label>
                                    <input id="rumahdinas" name="rumahdinas" class="form-control" type="text" autocomplete="off" readonly value="<?php echo $rumah_dinas; ?>">
                                </div>
                                <div class="form-group">
                                    <label>NO SIP</label>
                                    <input id="no_sip" name="no_sip" class="form-control" type="text" autocomplete="off" value="<?php echo $no_sip; ?>">
                                </div>
                                <div class="form-group">
                                    <label>DOKUMEN SIP</label>
                                    <input type="file" class="form-control" id="doc_sip" name="doc_sip">
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