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
<form action=<?= base_url("/polygonkecamatan/update") ?> method="post">
    <div class="box">
        <h3>Edit Polygon</h3>
        <input type="hidden" name="id_polygonkecamatan" value="<?= $polygonkecamatan->id_polygonkecamatan; ?>">
        <div><label>Input Manual Titik Marker: </label><input type="text" value= <?= $polygonkecamatan->polygon?> name="polygon" class="form-control"></div>
        <input type="hidden" name="nama" value="<?= $polygonkecamatan->nama; ?>">
        <input type="hidden" name="luas" value="<?= $polygonkecamatan->luas; ?>">
        <input type="hidden" name="akumulasiluastanah" value="<?= $polygonkecamatan->akumulasiluastanah; ?>">
        <input type="hidden" name="akumulasijumlahpenggarap" value="<?= $polygonkecamatan->akumulasijumlahpenggarap; ?>">
        <input type="hidden" name="jumlahtanahwakaf" value="<?= $polygonkecamatan->jumlahtanahwakaf; ?>">
        <textarea class="textarea" name="polygon" placeholder =<?= $polygonkecamatan->polygon?> ></textarea>
        <br>
        <button type="submit">Update</button>
        </div>
    </form>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
    var data = <?= json_encode($data) ?>


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
    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    if($("[name=polygon]").val() != ""){
        var latlngs = <?= json_encode($polygontanah) ?>;
        var polygon = L.polygon(latlngs,{color:'red'}).addTo(drawnItems);
        console.log(latlngs);
    }
    var drawControl = new L.Control.Draw({
        draw:{
            polyline:false,
            rectangle:false,
            circle:false,
            circlemarker:false,
            polygon:false,
            marker:false
        },
        edit: {
            featureGroup: drawnItems,
        }
    });
    map.addControl(drawControl);

    map.on('draw:created',function (e) {
        var type = e.layerType,
        layer = e.layer;
        var latlng=layer.getLatLngs()[0];
        console.log(latlng)
        console.log(" Polygon Created")
        $("[name=polygon]").val(JSON.stringify(latlng));
        // Do whatever else you need to. (save to db; add to map etc)
        drawnItems.addLayer(layer);
    });

    map.on('draw:edited', function (e) {
        console.log('edited')
        var layers = e.layers;
        var latlng=layers.getLayers()[0].getLatLngs()[0];
        $("[name=polygon]").val(JSON.stringify(latlng));
        console.log(layers.getLayers()[0].getLatLngs()[0]);
     });
     map.on('draw:deleted', function (e) {
        console.log('deleted');
        $("[name=polygon]").val("");
     });
    var geojson = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    var geojson = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);
</script>
<?= $this->endSection()?>