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
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('map.search') }}" method="POST">
@csrf
    <input type="text" name="search" class="py-2 date" placeholder="日付で絞り込み">
    <button type="submit" class="py-2 btn btn-warning" id="dateSearch">日付で検索</button>
</form>
<div id="map"></div>
<div style="text-align: center;">
    <input id="address" type="textbox" value="東京駅" class="py-2">
    <button id="search" class="py-2 btn btn-warning">検索</button>
    <button id="here" class="py-2 btn btn-primary">現在地</button>
</div>
<!-- 新規用モーダル -->
<div class="modal fade" id="form-new" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('map.store') }}" method="POST" name="newForm">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="place">場所</label>
                        <input type="text" name="place" id="place" class="form-control" required>
                        @if($errors->first('place'))
                            <p class="text-danger">{{ $errors->first('place') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="content">内容</label>
                        <textarea name="content" id="content" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date">日付</label>
                        <input type="text" id="date" name="date" class="form-control bg-light date">
                    </div>
                    <input type="hidden" id="lat" name="lat" class="form-control">
                    <input type="hidden" id="lng" name="lng" class="form-control">
                    <button type="submit" class="btn btn-outline-primary" id="submit">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END 新規用モーダル -->

@php
$google_api_key = env('MIX_GOOGLE_MAP_API_KEY');
@endphp

@if(Auth::check())
    @php
        $auth = 'true';
    @endphp
@else
    @php
        $auth = 'false';
    @endphp
@endif

@endsection
@section('scripts')
<script>
'use strict';
/*
===================
マップ関連
===================
*/
// 新規投稿用フォーム
var newForm = document.forms.newForm;

function initMap() {
    // マップ表示ターゲット
    var target = document.getElementById('map');
    // デフォルト中心位置
    var park = {lat: 35.732013, lng: 139.674847};
    var map = new google.maps.Map(target, {
            zoom: 11,
            center: park,
            // デフォルトのコントローラーを無効
            disableDefaultUI: true,
            // ズームコントローラーのみ有効
            zoomControl: true,
            // ダブルクリックでのズームを無効
            disableDoubleClickZoom: true});
    // 検索機能
    var geocoder = new google.maps.Geocoder();

    // 検索ボタンのクリックイベント
    document.getElementById('search').addEventListener('click', function() {
       geocodeAddress(geocoder, map); 
    });

    // 現在地ボタンのクリックイベント
    document.getElementById('here').addEventListener('click', function() {
        if(navigator.geolocation) {
            window.navigator.geolocation.getCurrentPosition(function(result) {
                // 現在地の取得成功
                var position = result.coords,
                    radius = position.accuracy,
                    latLng = new google.maps.LatLng(position.latitude, position.longitude),

                // 現在地に小さい円を書く
                circle = {
                    center: latLng,
                    radius: 10,
                    map: map,
                    strokeColor: '#44BBFF',
                    strokeOpacity: 0.8,
                    strokeWeight: 1,
                    fillColor: '#44BBFF',
                    fillOpacity: 0.8
                },
                circle = new google.maps.Circle(circle);
                // ズームして現在地へ移動
                map.setZoom(16);
                map.setCenter(latLng);                    
            });
        }
    });

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
        // 投稿の文だけ繰り返し
        for (var i = 0; i < locations.length; i++) {
        // マーカー作成
        var marker = new google.maps.Marker( {
            position: new google.maps.LatLng( locations[i].lat, locations[i].lng),
            map: map,
            animation: google.maps.Animation.DROP,
            label: String(locations[i].id)
        });
        // マーカークリックでカード出現
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent('<div class="card">'+
                    '<div class="card-header">'+
                    '<p>投稿者：' + locations[i].user.name + '</p>'+
                    '<p>タイトル：' + locations[i].title + '</p>'+
                    '</div>'+
                    '<div class="card-body">'+
                    '<p>場所：' + locations[i].place + '</p>'+
                    '<p>日時：' + locations[i].date + '</p>'+
                    '</div>' +
                    '<div class="card-footer">'+
                    '<a href="/map/' + locations[i].id + '">'+
                    '<button class="btn btn-outline-primary">'+
                    '詳細'+
                    '</button></a>'+
                    '</div>'+
                    '</div>');
                infowindow.open(map, marker);
            }
        })(marker, i));

        // マーカーマウスホバーで簡易情報表示
        google.maps.event.addListener( marker, 'mouseover', (function(marker, i) {
            return function() {
                infowindow.setContent('<p>投稿者：' + locations[i].user.name + '</p><hr><p>タイトル：' + locations[i].title + '</p><hr>' + '<p>場所：' + locations[i].place + '</p>');
                infowindow.open(map, marker);
            }
        })(marker, i));
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

    // マップダブルクリックで投稿
    map.addListener('dblclick', function(e) {
        var userId = '<?php echo $auth; ?>';
        if(userId === 'false') {
            alert('予定を登録するにはログインが必要です。');
            return false;
        }
        // フォームを表示
        $('#form-new').modal('toggle');
        // 緯度を取得
        var clickLat = e.latLng.lat();
        // クリックした地点の緯度をフォームにセット
        newForm.lat.value = clickLat;

        // 経度を取得
        var clickLng = e.latLng.lng();
        // クリックした地点の経度をフォームにセット
        newForm.lng.value = clickLng;
    });

    // 地名検索イベント
    function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({ 'address': address}, function(results, status) {
            if(status === 'OK') {
                map.setZoom(17);
                resultsMap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location,
                zoom: 4
            });
            } else {
                alert('検索できませんでした。理由：' + status);
            }
        });
    }
}
// END init.Map
</script>
<!-- クラスターのライブラリ読込み -->
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<!-- google map API読込み -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ $google_api_key }}&callback=initMap" async defer></script>

<!-- flatpickrライブラリ読込み -->
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
flatpickr(document.getElementsByClassName('date'), {
    locale: 'ja',
    dateFormat: 'Y/m/d',
    minDate: 'today'
});
var submit = document.getElementById('submit');
submit.addEventListener('click', function(e) {
    if(newForm.date.value === '') {
        e.preventDefault();
        alert('日付を選択して下さい');
        return false;
    }
});
</script>
@endsection