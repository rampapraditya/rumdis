<div class="main-content">

    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-wrap">
                        <div class="card-body">
                            <div class="card-icon shadow-primary bg-primary">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>DATA PENGHUNI</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $jml_penghuni; ?>
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
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>RUMDIS</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo $jml_rumdis; ?>
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
                            <div class="card-body">
                                <div id="map" style="width:100%; height:530px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script type="text/javascript">

        var map = L.map('map').setView([-1.3974306,117.8078094], 5);
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '© DISINFOLAHTA',
            maxZoom: 20
        }).addTo(map);

        var markers = [];
    
        $(document).ready(function () {
            
        });
        
        
        function reloaddata(){
            clearMarker1();
            reload();
        }

        function createMarker(coords, nama_marker, id, url_icon, w, h) {
            
            var busIcon = L.icon({
                iconUrl: url_icon,
                iconSize: [w, h] // size of the icon
            });

            var popupContent = '<a href="<?php echo base_url(); ?>users/index/'+id+'"><p style="text-align: center;">' + nama_marker + '</p></a>';

            myMarker = L.marker(coords, {
                draggable: false,
                icon: busIcon
            });
            myMarker._id = id;

            var myPopup = myMarker.bindPopup(popupContent,{
                closeButton: false
            });
            map.addLayer(myMarker);
            markers.push(myMarker);
        }

        function clearMarker(id) {
            var new_markers = [];
            markers.forEach(function(marker) {
                if (marker._id == id){
                    map.removeLayer(marker);
                }else{
                    new_markers.push(marker);
                }
            });
            markers = new_markers;
        }

        function clearMarker1() {
            var new_markers = [];
            markers.forEach(function(marker) {
                map.removeLayer(marker);
            });
            markers = new_markers;
        }
        
        <?php
        echo $display;
        ?>
    
    </script>
</div>