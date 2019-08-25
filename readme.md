## アプリ概要
googleマップを元に、お出かけする同行者を探す仲間募集アプリ。
自分で募集を掲載することも可能。  
https://gmap-app.tk/


## 主な機能
- Maps JavaScript API利用
    - GoogleマップのAPIであるMaps JavaScript APIを利用
    - 地名で検索、現在地表示、マーカーのカラフル化など実装

- コメント
    - 募集詳細画面にて、コメントをAjaxで投稿可能
 
- お気に入り機能
    - 気になる募集をお気に入り登録可能

- マイページ
    - 自分の投稿、コメント、お気に入りをタブ切替により１画面で閲覧可能

## 技術
- Maps Javascript API
- Ajax
- Flatpickr(date-pickerライブラリ)
- Bootstrap4
- Featureテスト

## 本番インフラ
- 言語(PHP 7.2)
- FW(Laravel 5.8)
- サーバ(EC2)
- DB(RDS)
- DNS管理(Route53)
- 証明書取得(ACM)
- 画像アップロード先(S3)
- ロードバランサー(ELB)

## 開発インフラ
- 言語(PHP 7.2)
- FW(Laravel 5.8)
- DB(Mysql5.7)
- 画像アップロード先(S3)
- 環境(Docker,Laradock)
