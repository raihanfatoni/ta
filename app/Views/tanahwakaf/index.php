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
<textarea class="textarea" name="polygon"></textarea>
<?= $this->endSection()?>

<?= $this->section('script')?>
<script>
    var data = <?= json_encode($data) ?> 
    var data1 = <?= json_encode($data1) ?> 
    var nilaiMax = <?= $nilaiMax ?>

    function getColor(d) {
		return d > (nilaiMax/8)*7 ? '#800026' :
           d > (nilaiMax/8)*6  ? '#BD0026' :
           d > (nilaiMax/8)*5  ? '#E31A1C' :
           d > (nilaiMax/8)*4  ? '#FC4E2A' :
           d > (nilaiMax/8)*3   ? '#FD8D3C' :
           d > (nilaiMax/8)*2   ? '#FEB24C' :
           d > (nilaiMax/8)*1   ? '#FED976' :
                      '#FFEDA0';
    }

    function style(feature){
        return{
            weight : 2,
            opacity : 1,
            color : 'white',
            dashArray : '3',
            fillOpacity : 0.7,
            fillColor : getColor(parseInt(feature.properties.nilai))
        };
    }

    function onEachFeature(feature,layer)
    {
        layer.bindPopup("<h4>Jumlah Proyeksi Penduduk</h4> <br>"+feature.properties.Propinsi+": "+feature.properties.nilai+"000 Ribu Jiwa")
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
        });
    }

    var map = L.map('maps').setView({lat : -6.85861, lon : 107.91639}, 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    // L.marker({lat : -6.85861, lon : 107.91639}).bindPopup('This is Sumedang').addTo(map);


    var drawnItems = new L.FeatureGroup();
    // var latlngs = JSON.parse($("name=polygon").val());
    // var polygon = L.polygon(latlngs,{color:'red'}).addTo(drawnItems);
    map.addLayer(drawnItems);

    var drawControl = new L.Control.Draw({
        draw:{
            polyline:false,
            rectangle:false,
            circle:false,
            marker:false,
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
        var latlng=layer.getLatLngs()[0];
        console.log(latlng)
        console.log("created")
        $("[name=polygon]").val(JSON.stringify(latlng));
        // Do whatever else you need to. (save to db; add to map etc)
        drawnItems.addLayer(layer);
    });
    
    var geojson = L.geoJson(data1,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    var geojson2 = L.geoJson(data,{
        style : style,
        onEachFeature:onEachFeature,
    }).addTo(map);

    function highlightFeature(e){
        var layer = e.target;
        
        layer.setStyle({
            weight:2,
            color:'#ff0000',
            dashArray:'',
            fillOpacity:0.7
        });

        if (!L.Browser.ie && L.Browser.opera && L.Browser.edge){
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    function resetHighlight(e){
        geojson.resetStyle(e.target);
        info.update();
    }

    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        this._div.innerHTML = '<h4>Polygon Sumedang</h4>' +  (props ?
            '<b>' + props.Lokasi + '</b><br />' + props.jumlahtanahwakaf + 'Tanah Wakaf'
            : 'Hover over a state');
    };

    info.addTo(map);

    var legend = L.control({position: 'bottomright'});


</script>
<?= $this->endSection()?>