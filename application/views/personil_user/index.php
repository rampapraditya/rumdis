<script type="text/javascript">

    $(document).ready(function () {

    });

    function simpan() {
        var nrp = document.getElementById('nrp').value;
        var nama = document.getElementById('nama').value;
        var pangkat = document.getElementById('pangkat').value;
        var korps = document.getElementById('korps').value;
        var komplek = document.getElementById('komplek').value;
        var foto = $('#foto').prop('files')[0];

        if (nrp === "") {
            iziToast.warning({
                title: 'Info',
                message: 'NRP tidak boleh kosong',
                position: 'topRight'
            });
        } else if (nama === "") {
            iziToast.warning({
                title: 'Info',
                message: 'Nama tidak boleh kosong',
                position: 'topRight'
            });
        } else if (pangkat === "-") {
            iziToast.warning({
                title: 'Info',
                message: 'Pilih pangkat terlebih dahulu',
                position: 'topRight'
            });
        } else if (korps === "-") {
            iziToast.warning({
                title: 'Info',
                message: 'Pilih korps terlebih dahulu',
                position: 'topRight'
            });
        } else if (komplek === "-") {
            iziToast.warning({
                title: 'Info',
                message: 'Pilih komplek terlebih dahulu',
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
            form_data.append('komplek', komplek);
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
                    $('#btnSave').attr('disabled', false);

                }, error: function (response) {

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

</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>PROFILE</h1>
        </div>
        <div class="section-body">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav_tab_diri" data-toggle="tab" href="#nav_diri" role="tab" aria-controls="nav_diri" aria-selected="true">Identitas Diri</a>
                    <a class="nav-item nav-link" id="nav_tab_keluarga" data-toggle="tab" href="#nav_keluarga" role="tab" aria-controls="nav_keluarga" aria-selected="false">Keluarga</a>
                    <a class="nav-item nav-link" id="nav_tab_sip" data-toggle="tab" href="#nav_sip" role="tab" aria-controls="nav_sip" aria-selected="false">SIP</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent" style="background-color: white;">
                <div class="tab-pane fade show active" id="nav_diri" role="tabpanel" aria-labelledby="nav_diri" style="background-color: white;">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-horizontal" style="margin-top: 10px;">
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
                                            if ($row->idpangkat == $pangkat_personil) {
                                                ?>
                                                <option selected value="<?php echo $row->idpangkat; ?>"><?php echo $row->nama_pangkat; ?></option>
                                                <?php
                                            } else {
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
                                            if ($row->idkorps == $korps_personil) {
                                                ?>
                                                <option selected value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $row->idkorps; ?>"><?php echo $row->nama_korps; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>KOMPLEK</label>
                                    <select id="komplek" name="komplek" class="form-control">
                                        <option value="-">- PILIH KOMPLEK -</option>
                                        <?php
                                        foreach ($komplek->result() as $row) {
                                            if ($row->idkomplek == $komplek_personil) {
                                                ?>
                                                <option selected value="<?php echo $row->idkomplek; ?>"><?php echo $row->nama_komplek; ?></option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="<?php echo $row->idkomplek; ?>"><?php echo $row->nama_komplek; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>FOTO</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer with-border">
                            <button id="btnSave" type="button" onclick="simpan();" class="btn btn-block btn-primary"> Save </button>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="nav_keluarga" role="tabpanel" aria-labelledby="nav_keluarga">
                </div>
                <div class="tab-pane fade" id="nav_sip" role="tabpanel" aria-labelledby="nav_sip">

                </div>
            </div>
        </div>
    </section>
</div>