                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; <?php echo date('Y'); ?> <div class="bullet"></div> <a href="https://pramediaenginering.com/">Wahyu - SISTEM INFORMASI RUMAH DINAS</a>
                    </div>
                    <div class="footer-right">
                        1.0.0
                    </div>
                </footer>
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" ></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
        <!-- JS Libraies -->
        <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
        <!-- Template JS File -->
        <script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>        
        <!-- Toast -->
        <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
        
        <script type="text/javascript">
            
            function back(){
                window.history.back();
            }
            
            function hanyaAngka(e, decimal) {
                var key;
                var keychar;
                if (window.event) {
                    key = window.event.keyCode;
                } else if (e) {
                    key = e.which;
                } else {
                    return true;
                }
                keychar = String.fromCharCode(key);
                if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
                    return true;
                } else if ((("0123456789").indexOf(keychar) > -1)) {
                    return true;
                } else if (decimal && (keychar == ".")) {
                    return true;
                } else {
                    return false;
                }
            }
            
            function batas_angka(input) {
                if (input.value < 0){ input.value = 0;}
                if (input.value > 100) {input.value = 100;}
            }
        </script>
    </body>
</html>
