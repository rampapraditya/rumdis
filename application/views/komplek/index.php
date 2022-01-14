<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function () {
        table = $('#tb').DataTable({
            ajax: "<?php echo base_url(); ?>komplek/ajaxlist",
            ordering:false
        });
    });

    function reload() {
        table.ajax.reload(null, false); //reload datatable ajax
    }

    function add() {
        save_method = 'add';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Tambah komplek');
    }

    function save() {
        var nama = document.getElementById('nama').value;
        var lat = document.getElementById('lat').value;
        var lon = document.getElementById('lon').value;
        
        if (nama === '') {
            iziToast.warning({
                title: 'Info',
                message: 'Nama komplek tidak boleh kosong',
                position: 'topRight'
            });
        }else if(lat === ""){
            iziToast.warning({
                title: 'Info',
                message: 'Lintang tidak boleh kosong',
                position: 'topRight'
            });
        }else if(lon === ""){
            iziToast.warning({
                title: 'Info',
                message: 'Bujur tidak boleh kosong',
                position: 'topRight'
            });
        } else {
            $('#btnSave').text('Saving...'); //change button text
            $('#btnSave').attr('disabled', true); //set button disable 

            var url = "";
            if (save_method === 'add') {
                url = "<?php echo base_url(); ?>komplek/ajax_add";
            } else {
                url = "<?php echo base_url(); ?>komplek/ajax_edit";
            }
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function (data) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: data.status,
                        position: 'topRight'
                    });
                    
                    $('#modal_form').modal('hide');
                    reload();

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }, error: function (jqXHR, textStatus, errorThrown) {
                    
                    iziToast.error({
                        title: 'Error',
                        message: "Error json " + errorThrown,
                        position: 'topRight'
                    });

                    $('#btnSave').text('Save'); //change button text
                    $('#btnSave').attr('disabled', false); //set button enable 
                }
            });
            
        }
    }

    function hapus(id, nama) {
        if (confirm("Apakah anda yakin menghapus komplek " + nama + " ?")) {
            $.ajax({
                url: "<?php echo base_url(); ?>komplek/hapus/" + id,
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    
                    iziToast.success({
                        title: 'Info',
                        message: data.status,
                        position: 'topRight'
                    });
                    
                    reload();
                }, error: function (jqXHR, textStatus, errorThrown) {
                    iziToast.error({
                        title: 'Info',
                        message: "Error hapus data",
                        position: 'topRight'
                    });
                }
            });
        }
    }

    function ganti(id) {
        save_method = 'update';
        $('#form')[0].reset();
        $('#modal_form').modal('show');
        $('.modal-title').text('Ganti komplek');
        $.ajax({
            url: "<?php echo base_url(); ?>komplek/ganti/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                $('[name="kode"]').val(data.idkomplek);
                $('[name="nama"]').val(data.nama_komplek);
                $('[name="lat"]').val(data.lat);
                $('[name="lon"]').val(data.lon);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                
                iziToast.error({
                    title: 'Error',
                    message: "Error get data",
                    position: 'topRight'
                });
            }
        });
    }

</script>
<style>
    .map {
        height: 400px;
        z-index: 1;
    }

    .address { cursor:pointer }
    .address:hover { color:#AA0000;text-decoration:underline }

</style>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>MASTER KOMPLEK</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn  btn-outline-success" onclick="add();">Add Data </button>
                            <button class="btn btn-outline-secondary" style="margin-left: 5px;" onclick="reload();">Reload</button>    
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table id="tb" class="table table-striped" style="width: 100%;">
                                    <thead>                                 
                                        <tr>
                                            <th style="text-align: center;">NAMA KOMPLEK</th>
                                            <th style="text-align: center;">LINTANG</th>
                                            <th style="text-align: center;">BUJUR</th>
                                            <th style="text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form" class="form-horizontal">
                    <input type="hidden" name="kode" id="kode">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">NAMA KOMPLEK</label>
                            <div class="col-md-12">
                                <input id="nama" name="nama" class="form-control" type="text" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">LINTANG</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input id="lat" name="lat" type="text" class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event,true);">
                                    <div class="input-group-append">
                                        <div class="input-group-text btn-primary" style="cursor: pointer;" onclick="show_maps();">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">BUJUR</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input id="lon" name="lon" type="text" class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event,true);">
                                    <div class="input-group-append">
                                        <div class="input-group-text btn-primary" style="cursor: pointer;" onclick="show_maps();">
                                            <i class="fas fa-fill-drip"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save();" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_maps" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MAPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <input id="addr" name="addr" type="text" class="form-control" autocomplete="off" placeholder="Ketik Alamat">
                            <div class="input-group-append">
                                <div class="input-group-text btn-primary" style="cursor: pointer;" onclick="addr_search();">
                                    Proses
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="margin-top: 10px;" id="results"></div>
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
    
    function show_maps(){
        $('#modal_maps').modal('show');
        setTimeout(function() {
            map.invalidateSize();
        }, 10);
        
    }
    
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