@extends('layout')

@section('styles')
<style>
#map {
    height: 600px;
}
</style>
@endsection
@section('content')
<div id="map"></div>
@endsection

@section('scripts')
<script>
function initMap() {
    var locations = [
        {lat: 35.732013, lng: 139.674847},
        {lat: 35.6186511, lng: 139.6801052},
        {lat: 35.322405, lng: 139.566374},
        {lat: 35.670576, lng: 139.7193},
    ];
    var titles = [
        'ggHouse',
        'クロス都立大学',
        'ランサーズ邸',
        'エドム'
    ];
    var target = document.getElementById('map');
    var myHouse = {lat: 35.732013, lng: 139.674847};
    var map = new google.maps.Map(target, {zoom: 12, center: myHouse});

    var markers = locations.map(function(location) {
        return new google.maps.Marker({
            position: location,
            animation: google.maps.Animation.DROP,
            icon: {
                url: 'http://maps.google.com/mapfiles/ms/micons/purple-dot.png',
                scaledSize: new google.maps.Size(40, 40)
            }
        });
    });

    // マーカーをクラスターにする　
    var markerCluster = new MarkerClusterer(
        map, markers,
        { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
    );

    // マップをダブルクリックした時、コンソールに緯度と経度表示
    map.addListener('dblclick', function(e) {
        console.log(e.latLng.toString());
    });

    // var marker = new google.maps.Marker({ position: myHouse, map: map, title: 'MyHouse'}); 
    // var infoWindow = new google.maps.InfoWindow({
    //     content: '<h1>ggHouse</h1>'
    // });
    // marker.addListener('mouseover', function() {
    //     infoWindow.open(map, marker);
    // });
    // marker.addListener('mouseout', function() {
    //     infoWindow.close(map, marker);
    // });
    // var markerCluster = new MarkerClusterer(map, marker,
    //     {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
    //     );
}
</script>
<!-- クラスターのライブラリ読込み -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<!-- google map API読込み -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAk5aRysZpoAKdXvPyPCWQFJWjCl7GcCXY&callback=initMap"
async defer></script>
@endsection