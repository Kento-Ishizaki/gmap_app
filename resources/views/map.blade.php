@extends('layout')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<style>
#map {
    height: 500px;
}
</style>
@endsection
@section('content')
<div id="map"></div>
<div class="modal fade" id="form" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('map.store') }}" method="POST" name="mapForm">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="place">場所</label>
                        <input type="text" name="place" id="place" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="content">内容</label>
                        <textarea name="content" id="content" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">日付</label>
                        <input type="text" id="date" name="date" class="form-control bg-light">
                    </div>
                    <div class="form-group col-md-6 col-md-offset-6">
                        <label for="lat">緯度</label>
                        <input type="text" id="lat" name="lat" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lng">経度</label>
                        <input type="text" id="lng" name="lng" class="form-control" value="" disabled>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@php
$google_api_key = env('MIX_GOOGLE_MAP_API_KEY');
@endphp

@endsection
@section('scripts')
<script>
'use strict';
var form = document.forms.mapForm;
function initMap() {
    var target = document.getElementById('map');
    var park = {lat: 35.732013, lng: 139.674847};
    var map = new google.maps.Map(target, {
            zoom: 12,
            center: park,
            disableDoubleClickZoom: true});

    $.ajax({
        type: 'GET',
        url: '/api/map',
        dataType: 'json',
    })
    .done((data) => {
        // DBのmap情報を変数に代入
        var mapData = data;
        var locations = [
            mapData
        ];
        // ネストしてない連想配列を代入
        var locations = locations[0];
        var mcs = [];
    var infowindow = new google.maps.InfoWindow();
    for (var i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker( {
            position: new google.maps.LatLng( locations[i].lat, locations[i].lng),
            map: map,
            animation: google.maps.Animation.DROP,
            icon: {
                url: 'http://maps.google.com/mapfiles/ms/micons/purple-dot.png',
                scaledSize: new google.maps.Size(40, 40)
            },
        });

        // マーカークリックでモーダル出現
        google.maps.event.addListener( marker, 'click', (function(marker, i) {
            console.log('OK!!');
        }));

        // マーカーマウスホバーで簡易情報表示
        google.maps.event.addListener( marker, 'mouseover', (function(marker, i) {
            return function() {
                infowindow.setContent('<p>投稿者：' + locations[i].user_id + '</p><hr><p>場所：' + locations[i].place + '</p><hr><p>タイトル：' + locations[i].title + '</p>');
                infowindow.open(map, marker);
            }
        })( marker, i));

        // マーカーマウスアウトで簡易情報非表示
        google.maps.event.addListener( marker, 'mouseout', (function(marker, i) {
            infowindow.close(map, marker);
        }));
        mcs.push(marker);
    }
        // マーカーをクラスターにする　
        var markerCluster = new MarkerClusterer(
        map, mcs,
        { imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'}
    );

    })
    .fail((data) => {
        console.log(data.responseText);
    });

    // var locations = [
    //     {name: 'ggHouse', title: '飲みましょう', lat: 35.732013, lng: 139.674847},
    //     {name: 'クロス都立大学', lat: 35.6186511, lng: 139.6801052},
    //     {name: 'ランサーズ邸', lat: 35.322405, lng: 139.566374},
    //     {name: 'エドムインクリメント', title: '会社です', lat: 35.670576, lng: 139.7193},
    // ];

    // マップクリックイベント
    map.addListener('dblclick', function(e) {
        // フォームを表示
        $('#form').modal('toggle');
        // 緯度を取得
        var clickLat = e.latLng.lat();
        // クリックした地点の緯度をフォームにセット
        form.lat.value = clickLat;

        // // 経度を取得
        var clickLng = e.latLng.lng();
        // クリックした地点の経度をフォームにセット
        form.lng.value = clickLng;
    });
}
</script>
<!-- クラスターのライブラリ読込み -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<!-- google map API読込み -->
// <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAk5aRysZpoAKdXvPyPCWQFJWjCl7GcCXY&callback=initMap"
<script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&callback=initMap"
async defer></script>

<!-- flatpickrライブラリ読込み -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
flatpickr(document.getElementById('date'), {
    locale: 'ja',
    dateFormat: 'Y/m/d',
    minDate: new Date()
});
</script>
@endsection