<script type="text/javascript">

    $(document).ready(function () {

    });

    function simpan() {
        var kode = document.getElementById('kode').value;
        var nama = document.getElementById('nama_rumah').value;
        var alamat = document.getElementById('alamat').value;
        var lat = document.getElementById('lat').value;
        var lon = document.getElementById('lon').value;
        var foto = $('#foto').prop('files')[0];

        if (kode === "") {
            iziToast.success({
                title: 'Info',
                message: 'Kode tidak boleh kosong',
                position: 'topRight'
            });

        } else if (nama === "") {
            iziToast.success({
                title: 'Info',
                message: 'Nama rumah tidak boleh kosong"',
                position: 'topRight'
            });

        } else if (alamat === "") {
            iziToast.success({
                title: 'Info',
                message: 'Alamat tidak boleh kosong"',
                position: 'topRight'
            });

        } else {
            $('#btnSave').html('<i class="mdi mdi-content-save"></i> Proses... ');
            $('#btnSave').attr('disabled', true);

            var form_data = new FormData();
            form_data.append('kode', kode);
            form_data.append('nama', nama);
            form_data.append('alamat', alamat);
            form_data.append('lat', lat);
            form_data.append('lon', lon);
            form_data.append('file', foto);

            $.ajax({
                url: "<?php echo base_url(); ?>rumahdinasuser/proses",
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
                    $('#btnSave').attr('disabled', false);

                }, error: function (response) {

                    iziToast.success({
                        title: 'Info',
                        message: response.status,
                        position: 'topRight'
                    });

                    $('#btnSave').html('<i class="mdi mdi-content-save"></i> Simpan ');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }
    }


</script>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>RUMAH PERSONIL</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form id="form">
                                <input type="hidden" id="kode" name="kode" readonly value="<?php echo $idrumah_dinas; ?>">
                                <div class="form-group">
                                    <label>NAMA RUMAH DINAS</label>
                                    <input type="text" class="form-control" id="nama_rumah" name="nama_rumah" autofocus autocomplete="off" value="<?php echo $nama_rumah; ?>">
                                </div>
                                <div class="form-group">
                                    <label>ALAMAT RUMAH DINAS</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" value="<?php echo $alamat_rumah; ?>">
                                </div>
                                <div class="form-group">
                                    <img src="<?php echo $foto_rumah; ?>" class="img-thumbnail" style="width: 120px; height: auto;">
                                </div>
                                <div class="form-group">
                                    <label>FOTO RUMAH</label>
                                    <input type="file" class="form-control" id="foto" name="foto" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>LINTANG</label>
                                    <input id="lat" name="lat" type="text" class="form-control" autocomplete="off" value="<?php echo $lat; ?>">
                                </div>
                                <div class="form-group">
                                    <label>BUJUR</label>
                                    <input id="lon" name="lon" type="text" class="form-control" autocomplete="off" value="<?php echo $lon; ?>">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer with-border">
                            <button id="btnSave" type="button" onclick="simpan();" class="btn btn-block btn-primary"> Save </button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <b>Ketik Alamat</b>
                                    <div id="search" style="margin-top: 10px;">
                                        <input type="text" name="addr" value="" id="addr" class="form-control" />
                                        <button id="btnCari" style="margin-top: 10px;" class="btn btn-sm btn-primary" type="button" onclick="addr_search();">Cari Alamat</button>
                                        <div style="margin-top: 10px;" id="results"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div class="map-container">
                                        <div class="map-marker-centered"></div>
                                        <div id="map" class="map" style="width: 100%;"></div>
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

<style>
    .map {
        height: 400px;
        z-index: 1;
    }

/*  
    ini untuk yang geser mapsnya
    .map-container {
        position: relative;
        width: 100%;
        height: 400px;
    }

    .map-marker-centered {
        background-image: url("<?php //echo base_url() ?>assets/marker/marker.png");
        width: 50px;
        height: 48px;
        position: absolute;
        z-index: 2;
        left: calc(50% - 25px);
        top: calc(50% - 50px);
        transition: all 0.4s ease;
    }*/

    .address { cursor:pointer }
    .address:hover { color:#AA0000;text-decoration:underline }

</style>
<script type="text/javascript">


    var startlat = <?php echo $lat; ?>;
    var startlon = <?php echo $lon; ?>;

    var options = {
     center: [startlat, startlon],
     zoom: 4
    };

    document.getElementById('lat').value = startlat;
    document.getElementById('lon').value = startlon;

    var map = L.map('map', options);
    var nzoom = 12;

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'DISINFOLAHTA'}).addTo(map);

    var myMarker = L.marker([startlat, startlon], {title: "Coordinates", alt: "Coordinates", draggable: true}).addTo(map).on('dragend', function () {
        var lat = myMarker.getLatLng().lat.toFixed(8);
        var lon = myMarker.getLatLng().lng.toFixed(8);
        var czoom = map.getZoom();
        if (czoom < 18) {
            nzoom = czoom + 2;
        }
        if (nzoom > 18) {
            nzoom = 18;
        }
        if (czoom != 18) {
            map.setView([lat, lon], nzoom);
        } else {
            map.setView([lat, lon]);
        }
        document.getElementById('lat').value = lat;
        document.getElementById('lon').value = lon;
        myMarker.bindPopup("Lintang " + lat + "<br/> Bujur " + lon).openPopup();
    });

// untuk pointer diam yang di geser mapsnya
//    map.on("moveend", function () {
//        var center = map.getCenter();
//                var { lat, lng } = center;
//                $('#lat').val(lat);
//        $('#lon').val(lng);
//    });

    function chooseAddr(lat1, lng1)
    {
        myMarker.closePopup();
        map.setView([lat1, lng1], 18);
        myMarker.setLatLng([lat1, lng1]);
        lat = lat1.toFixed(8);
        lon = lng1.toFixed(8);
        document.getElementById('lat').value = lat;
        document.getElementById('lon').value = lon;
        myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
    }

    function myFunction(arr)
    {
        var out = "<br />";
        var i;

        if (arr.length > 0)
        {
            for (i = 0; i < arr.length; i++)
            {
                out += "<div class='address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
            }
            document.getElementById('results').innerHTML = out;
        } else
        {
            document.getElementById('results').innerHTML = "Sorry, no results...";
        }

    }

    function addr_search()
    {
        $('#btnCari').text('Loading...');
        $('#btnCari').attr('disabled',true);
            
        var inp = document.getElementById("addr");
        var xmlhttp = new XMLHttpRequest();
        var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
        xmlhttp.onreadystatechange = function ()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                var myArr = JSON.parse(this.responseText);
                myFunction(myArr);
            }
            
            $('#btnCari').text('Cari Alamat');
            $('#btnCari').attr('disabled',false);
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

</script>