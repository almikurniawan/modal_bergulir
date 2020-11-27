<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXlNOVAo51ZUTuOk5gI18eseezwHWh6hU&callback=initMap" type="text/javascript"></script>
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
        <textarea class="form-control" name="keterangan"><?= $peng_lokasi_keterangan?></textarea>
    </div>
</form>
<div class="row mt-2">
    <div class="col-sm-12">
        <button class="btn btn-success btn-primary btn-raised" onclick="get_location()">Simpan Lokasi</button>
    </div>
</div>
<script>
    let myMarker;

    function initMap() {
        const map = new google.maps.Map(document.getElementById('show_maps'), {
            center: {
                lat: -7.815476,
                lng: 112.019774
            },
            zoom: 12
        });

        myMarker = new google.maps.Marker({
            position: {
                lat: <?= $peng_lokasi_lat?>,
                lng: <?= $peng_lokasi_lon?>
            },
            map,
            title: "Lokasi Usaha",
            draggable: true,
        });
    }

    function get_location() {
        $('input[name=lat]').val(myMarker.getPosition().lat());
        $('input[name=lon]').val(myMarker.getPosition().lng());
        $('#form').submit();
    }
</script>