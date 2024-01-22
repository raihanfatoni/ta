<?= $this->extend('layout')?>

<?= $this->section('head')?>
    <script src="http://localhost/tugasakhir/public/leaflet/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href = "http://localhost/tugasakhir/public/leaflet/leaflet.css">
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css">
    <style>
        #maps{
            height: 500px;
        }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }

        .legend {
            line-height: 18px;
            color: #555;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
        .textarea{
            margin-bottom: 8px;
            width: 1610px;
            height: 200px;
        }
    </style>
<?= $this->endSection()?>

<?= $this->section('content')?>
<div id="maps"></div>
<br>
<form action=<?= base_url("/wakaf/update") ?> method="post">
    <div class="box">
        <h3>Edit Marker</h3>
        <input type="hidden" name="no" value="<?= $wakaf->no; ?>">
        <div><label>Input Manual Titik Marker: </label><input type="text" value= <?= $wakaf->marker?> name="marker" class="form-control"></div>
        <input type="hidden" name="wilayah" value="<?= $wakaf->wilayah; ?>">
        <input type="hidden" name="tipe" value="<?= $wakaf->tipe; ?>">
        <input type="hidden" name="mandor" value="<?= $wakaf->mandor; ?>">
        <input type="hidden" name="jumlahpenggarap" value="<?= $wakaf->jumlahpenggarap; ?>">
        <input type="hidden" name="luas" value="<?= $wakaf->luas; ?>">
        <input type="hidden" name="setoranpanen" value="<?= $wakaf->setoranpanen; ?>">
        <input type="hidden" name="googleearth" value="<?= $wakaf->googleearth; ?>">
        <input type="hidden" name="id_polygonkecamatan" value="<?= $wakaf->id_polygonkecamatan; ?>">
        <textarea class="textarea" name="marker" placeholder =<?= $wakaf->marker?> ></textarea>
        <br>
        <button type="submit">Update</button>
        </div>
    </form>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
    var data = <?= json_encode($data) ?>;
    var data1 = <?= json_encode($data1) ?>;

    function style(feature){
        return{
            // weight : 2,
            // opacity : 1,
            // color : 'white',
            // dashArray : '3',
            // fillOpacity : 0.7,
            // fillColor : getColor(parseInt(feature.properties.nilai))
        };
    }

    function onEachFeature(feature,layer)
    {
        layer.on({
            // mouseover: highlightFeature,
            // mouseout: resetHighlight,
        });
    }

    var map = L.map('maps').setView({lat : -6.85861, lon : 107.91639}, 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    // L.marker({lat : -6.85861, lon : 107.91639}).bindPopup('This is Sumedang').addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    if($("[name=marker]").val() != ""){
        var latlng = <?= json_encode($markertanah) ?>;
        // var longitude =
        console.log("Koordinat:",latlng);
        // console.log(longitude);
        var marker = L.marker({lat: latlng.lat, lon: latlng.lng}).bindPopup('This is wakaf').addTo(drawnItems);
    }
    var drawControl = new L.Control.Draw({
        draw:{
            polygon:false,
            polyline:false,
            rectangle:false,
            circle:false,
            marker:false,
            polygon:false,
            circlemarker:false
        },
        edit: {
            featureGroup: drawnItems,
        }
    });
    map.addControl(drawControl);

    map.on('draw:created',function (e) {
        var type = e.layerType,
        layer = e.layer;
        console.log(layer)
        var latlng = layer.getLatLng()
        console.log(latlng)
        var latitude = latlng.lat;
        var longitude = latlng.lng;
        var marker = L.marker({lat :latitude, lon : longitude}).bindPopup('This is wakaf').addTo(map);
        console.log("Marker Created")
        $("[name=marker]").val(JSON.stringify(latlng));
    });

    map.on('draw:edited', function (e) {
        var layers = e.layers;
        console.log(layers);
        var latlng=layers.getLayers()[0].getLatLng();
        console.log(latlng);
        $("[name=marker]").val(JSON.stringify(latlng));
        console.log(layers.getLayers()[0].getLatLng());
        console.log('edited')
     });
     map.on('draw:deleted', function (e) {
         $("[name=marker]").val("");
         console.log('deleted');
     });
    var geojson = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    var geojson1 = L.geoJson(data1,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);
</script>
<?= $this->endSection()?>