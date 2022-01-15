<script type="text/javascript">

    $(document).ready(function () {

    });

</script>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-wrap">
                        <div class="card-body">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>KOMPLEK</h4>
                                </div>
                                <div class="card-body">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-wrap">
                        <div class="card-body">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>PENGGUNA</h4>
                                </div>
                                <div class="card-body">
                                    0
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-body" style="text-align: center;">
                                <h3>SISTEM INFORMASI RUMAH DINAS</h3>
                                <img src="<?php echo $logo; ?>" style="width: 150px; height: auto; margin-top: 20px;">
                                <p style="margin-top: 50px;"><?php echo $alamat . ' - '; ?><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></p>
                                <p style="margin-top: 5px;"><?php echo "Telp : " . $tlp; if(strlen($fax) > 0){ echo ', Fax : ' . $fax; } ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
</div>