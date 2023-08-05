<?php

    $submit = [
        'name'=>'submit',
        'id'=>'submit',
        'value'=>'Pilih Data',
        'class'=>'btn btn-primary',
        'type'=>'submit'
    ];
?>
<?= $this->extend('layout')?>

<?= $this->section('head')?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="http://localhost/tugasakhir/public/leaflet/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <link rel="stylesheet" href = "http://localhost/tugasakhir/public/leaflet/leaflet.css">
    <link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Entry Polygon</title>
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
            width: 1610px;
            height: 200px;
        }
    </style>
<?= $this->endSection()?>

<?= $this->section('content')?>
<div id="maps"></div>
<br>
<form action=<?= base_url("/polygonkecamatan/save") ?> method="post">
    <div class="box">
        <h3>Form Entry Data Polygon</h3>
        <div><label>Nomor Polygon : </label><input type="text" name="id_polygonkecamatan" class="form-control"></div>
        <div><label>Nama Kecamatan :</label><input type="text" name="nama" class="form-control"></div>
        <div><label>Luas Kecamatan :</label><input type="text" name="luas" class="form-control"></div>
        <div><label>Akumulasi Luas Tanah :</label><input type="text" name="akumulasiluastanah" class="form-control"></div>
        <div><label>Akumulasi Jumlah Penggarap :</label><input type="text" name="akumulasijumlahpenggarap" class="form-control"></div>
        <input type="hidden" name="polygon" class="form-control" >
        <button type="submit">Save</button>
        </div>
    </form>
<textarea class="textarea" name="polygon"></textarea>
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
    var markertanah = <?= json_encode($marker) ?>;
    var latlng = []; 
    var marker = [];
    var properties = [];
    var daerah = [];
    for (let i = 0; i < markertanah.length; i++ ){
        latlng[i] = markertanah[i].geometry.coordinates;
        properties[i] = markertanah[i].properties;
        
        marker = new L.marker([latlng[i][0],latlng[i][1]])
        .bindPopup(`
        <div>
        <ul class="list-group list-group-flush">
            
            <li class="list-group-item p-0 pl-1">Lokasi Tanah        : ${properties[i].wilayah} (${properties[i].no})</li>
            <li class="list-group-item p-0 pl-1">Mandor Tanah         : ${properties[i].mandor}</li>
            <li class="list-group-item p-0 pl-1">Jumlah Penggarap   : ${properties[i].jumlahpenggarap} Orang </li>
            <li class="list-group-item p-0 pl-1">Setoran Panen         : ${properties[i].setoranpanen} </li>
            <li class="list-group-item p-0 pl-1">Luas Tanah    : ${properties[i].luas} m²</li>
        </ul>
        <div class="card-body p-0 pl-1 ">
            <a href="${properties[i].googleearth}" target="_blank" class="card-link">Cek Kondisi Sekarang</a>
        </div>
        </div>`).addTo(drawnItems);
            };
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        draw:{
            polyline:false,
            rectangle:false,
            circle:false,
            circlemarker:false,
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
        if (type === 'marker'){
            console.log(layer)
            var latlng = layer.getLatLng()
            console.log(latlng)
            var latitude = latlng.lat;
            var longitude = latlng.lng;
            var marker = L.marker({lat :latitude, lon : longitude}).bindPopup('This is Sumedang').addTo(map);
            console.log("Marker Created")
            $("[name=marker]").val(JSON.stringify(latlng));
        } else if (type === 'polygon'){
            console.log(layer)
            var latlng=layer.getLatLngs()[0];
            console.log(latlng)
            console.log("Polygon Created")
            $("[name=polygon]").val(JSON.stringify(latlng));
            // Do whatever else you need to. (save to db; add to map etc)
            drawnItems.addLayer(layer);
        }
    });

    var geojson = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    var geojson2 = L.geoJson(data1,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

</script>
<?= $this->endSection()?>