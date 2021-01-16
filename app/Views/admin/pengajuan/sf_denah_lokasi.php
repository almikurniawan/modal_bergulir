<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<div class="row">
    <div class="col-sm-12">
        <div id="show_maps" style="width:100%;height:400px;"></div>
    </div>
</div>
<form method="post" action="" id="form">
    <input type="hidden" name="lat" />
    <input type="hidden" name="lon" />
    <div class="form-group mt-2">
        <label>Keterangan</label>
        <textarea class="form-control" name="keterangan"><?= $peng_lokasi_keterangan ?></textarea>
    </div>
</form>
<div class="row mt-2">
    <div class="col-sm-12">
        <button class="btn btn-success btn-primary btn-raised" onclick="get_location()">Simpan Lokasi</button>
    </div>
</div>
<script>
    // let myMarker;

    // function initMap() {
    //     const map = new google.maps.Map(document.getElementById('show_maps'), {
    //         center: {
    //             lat: -7.815476,
    //             lng: 112.019774
    //         },
    //         zoom: 12
    //     });

    //     myMarker = new google.maps.Marker({
    //         position: {
    //             lat: <?= $peng_lokasi_lat ?>,
    //             lng: <?= $peng_lokasi_lon ?>
    //         },
    //         map,
    //         title: "Lokasi Usaha",
    //         draggable: true,
    //     });
    // }

    var mymap = L.map('show_maps').setView([<?= $peng_lokasi_lat ?>, <?= $peng_lokasi_lon ?>], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYWxtaWt1ciIsImEiOiJja2pvMHAxaDIycHR6MnltcGk0c2c1eHIxIn0.ohQlx8xbetxw4Ig0Gd-CPg', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
    }).addTo(mymap);
    var marker = L.marker([<?= $peng_lokasi_lat ?>, <?= $peng_lokasi_lon ?>],{
        draggable : true
    }).addTo(mymap);

    function get_location() {
        var posisi = marker.getLatLng();
        $('input[name=lat]').val(posisi.lat);
        $('input[name=lon]').val(posisi.lng);
        $('#form').submit();
    }
</script>