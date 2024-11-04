# お問い合わせフォーム[確認テスト]

<div id="top"></div>

## 使用技術一覧

<p style="display: inline">

  <!-- バックエンドのフレームワーク一覧 -->
  <img src="https://img.shields.io/badge/-Laravel-171923.svg?logo=laravel&style=for-the-badge">
  <!-- バックエンドの言語一覧 -->
  <img src="https://img.shields.io/badge/-Php-777BB4.svg?logo=php&logoColor=FFFFFF&style=for-the-badge">
  <!-- WEBサーバー -->
  <img src="https://img.shields.io/badge/-Nginx-269539.svg?logo=nginx&style=for-the-badge">
  <!-- データベース関連 -->
  <img src="https://img.shields.io/badge/-MySQL-4479A1.svg?logo=mysql&style=for-the-badge&logoColor=white">
  <img src="https://img.shields.io/badge/-phpmyadmin-6C78AF.svg?logo=phpmyadmin&style=for-the-badge&logoColor=white">
  <!-- インフラ一覧 -->
  <img src="https://img.shields.io/badge/-Docker-1488C6.svg?logo=docker&style=for-the-badge">
  <img src="https://img.shields.io/badge/-github-010409.svg?logo=github&style=for-the-badge">
</p>

## 目次

1. [環境](#環境)
2. [開発環境構築](#開発環境構築)

<br />
<div align="right">
    <a href="Dockerfileの詳細リンク"><strong>Dockerfileの詳細 »</strong></a>
</div>
<br />




## 環境


| 言語・フレームワーク | バージョン  |
| --------------------- | ---------- |
| php                   | 7.4.9      |
| Laravel               | 8.83.27    |
| MySQL                 | 8.0.26     |
| phpMyAdmin            | 5.2.1      |
| nginx                 | 1.21.1     |



<p align="right">(<a href="#top">トップへ</a>)</p>

## 開発環境構築








必要に応じてdocker-compose.yml,Dockerfileは編集してください



### コンテナの作成と起動

以下のコマンドでリポジトリをクローン

git clone https://github.com/takuya9622/test1.git

必要に応じてdocker-compose.yml,Dockerfileは編集してください

.env ファイルを以下の環境変数例を元に作成

.env <br />
DB_CONNECTION=mysql <br />
DB_HOST=mysql <br />
DB_PORT=3306 <br />
DB_DATABASE=laravel_db <br />
DB_USERNAME=laravel_user <br />
DB_PASSWORD=laravel_pass <br />

.env ファイルを作成後、以下のコマンドで開発環境を構築

docker-compose up -d --build

### 動作確認
<a href="http://localhost:81">http://localhost:81</a>
[http://localhost:81](http://localhost:81){:target="_blank"}にアクセスできるか確認
アクセスできたらnginxはOK
<br />
[http://localhost:8082](http://localhost:8082){:target="_blank"}にアクセスできるか確認
アクセス出来たらMySqlはOK

### コンテナの停止

以下のコマンドでコンテナを停止

docker-compose down


### コマンド一覧

| コマンド                                                                               | 実行する処理                           |
| -------------------------------------------------------------------------------------- | -------------------------------------- |
| composer create-project --prefer-dist laravel/laravel                                  | Laravel をインストール                 |
| composer require laravel/fortify                                                       | Laravel Fortify をインストール         |
| docker-compose up -d --build                                                           | コンテナの起動                         |
| docker-compose down                                                                    | コンテナの停止                         |
| docker-compose exec php bash                                                           | php コンテナに入る                     |
| php artisan key;generate                                                               | 暗号化キーを生成                     |
| php artisan make:migration create_contacts_table                                       | マイグレーションファイルを作成         |
| php artisan make:seeder ContactsSeeder                                                 | シーダーファイルを作成                 |
| php artisan make:factory ContactFactory                                                | ファクトリーファイルを作成             |
| php artisan migrate                                                                    | マイグレーションを行う                 |
| php artisan db:seed                                                                    | シーディングを行う                     |
| php artisan make:model Contact                                                         | モデルファイルを作成                   |
| php artisan make:controller ContactController                                          | コントローラーファイルを作成           |
| php artisan make:request ContactRequest                                                | リクエストファイルを作成               |



<p align="right">(<a href="#top">トップへ</a>)</p>
