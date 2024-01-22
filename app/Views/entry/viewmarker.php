<?= $this->extend('layout')?>

<?= $this->section('head')?>
    <script src="http://localhost/tugasakhir/public/leaflet/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href = "http://localhost/tugasakhir/public/leaflet/leaflet.css">
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css">
    <style>
        #maps{
            height: 790px;
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
        var jumlahpenggarap = <?= json_encode($jumlahpenggarap) ?>;
        var luas = <?= json_encode($luas) ?>;
        var wilayah = <?= json_encode($wilayah) ?>;
        var tipe = <?= json_encode($tipe) ?>;
        var setoranpanen = <?= json_encode($setoranpanen) ?>;
        var mandor = <?= json_encode($mandor) ?>;
        var no = <?= json_encode($no) ?>;
        var googleearth = <?= json_encode($googleearth) ?>;
        console.log("Jumlah Penggarap", jumlahpenggarap);
        console.log("Koordinat:",latlng);
        // console.log(longitude);
        var marker = L.marker({lat: latlng.lat, lon: latlng.lng}).bindPopup(`
        <div>
        <ul class="list-group list-group-flush">
            
            <li class="list-group-item p-0 pl-1">Lokasi Tanah        : ${wilayah} (${no})</li>
            <li class="list-group-item p-0 pl-1">Lokasi Tanah        : ${tipe}</li>
            <li class="list-group-item p-0 pl-1">Mandor Tanah         : ${mandor}</li>
            <li class="list-group-item p-0 pl-1">Jumlah Penggarap/Penyewa   : ${jumlahpenggarap} Orang </li>
            <li class="list-group-item p-0 pl-1">Setoran Panen         : ${setoranpanen} </li>
            <li class="list-group-item p-0 pl-1">Luas Tanah    : ${luas} m²</li>
        </ul>
        <div class="card-body p-0 pl-1 ">
            <a href="${googleearth}" target="_blank" class="card-link">Cek Kondisi Sekarang</a>
        </div>
        </div> `).addTo(drawnItems);
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