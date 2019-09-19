# Laravel

## 前提

- php
- composer
- laravel
- mysql
- Node.js
- Vue.js

## サーバ起動

```bash
$ cp .env.example .env
$ vim .env # DB関連を設定
$ php artisan key:generate
$ php artisan config:cache
$ composer install # ライブラリインストール
$ php artisan migrate:generate # 既存テーブルから定義を作成
$ php artisan serve
```

.envはこの部分を記述

```.env
DB_CONNECTION=mysql
DB_HOST=[DB host]
DB_PORT=3306
DB_DATABASE=[database name]
DB_USERNAME=[username]
DB_PASSWORD=[password]
```

ブラウザでは

- http://localhost:8000/api/users
- http://localhost:8000/api/users/{id}

でDB内容が閲覧可能。

今回はGETしか実装していません。

## DB接続

### 実装手順

#### Laravelの雛形からサーバ起動するまで

```bash
$ laravel new [app name] # 新しいプロジェクト
$ cd [app name] # プロジェクトディレクトリに移動
$ vim .env # DB接続関連を設定
$ composer require --dev xethron/migrations-generator # 既存テーブルから定義を作成するライブラリ
$ php artisan migrate:generate # 既存テーブルから定義を作成
$ rm app/User.php # 念の為削除
$ php artisan make:model User # Userモデルを作成
$ php artisan make:controller UserController --api # APIのコントローラを作成
$ vim app/Http/Controllers/UserController.php # コントローラを設定
$ vim routes/api.php # 最後にapiResourceを付け加える
$ php artisan serve
```

##### DB操作

- all() : 全件取得
- first() : 最初だけ取得
- find() : id指定で取得
- chunk() : 件数ごとに取得
- select() : 指定カラムだけ取得
- where() : 条件指定
- where()->where() : AND
- where()->orWhere() : OR
- whereBetween() : 範囲指定

など
[参考](https://blog.capilano-fw.com/?p=665){:target="_blank"}


#### フロントエンド


##### Vue.js

Laravelの雛形に最初から導入されているVue.jsを利用

```bash
$ yarn install # nodeモジュールインストール
$ vim resources/js/components/UsersList.vue # コンポーネントを作成
$ vim resources/js/app.js # 使用するコンポーネントを追加
$ vim resources/views/users.blade.php # bladeファイル作成
$ yarn dev # development mode で publicディレクトリ内を作成
$ php artisan serve
```

##### Vuex

```bash
$ yarn add --dev vuex
```

##### Vue-Router

```bash
$ yarn add --dev vue-router
```

##### Vuetify

Vuetifyを利用する場合

```bash
$ yarn add --dev vuetify vuetify-loader @mdi/font
```

##### ページネーション

[Vuetifyのv-data-tableを使ってサーバサイドページネーションを行う参考サーバサイドページネーション](https://codepen.io/pen/?&editable=true&editors=101){:target="_blank"}
