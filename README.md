Wordpress Template Framework
============================

ほぼ自分専用に作っているWordPress向けのテンプレートフレームワーク。
fork/pull-request大歓迎。

通常functions.phpに記述するようなカスタムメニューやウィジェット領域などをクラスにてモジュール化し、
メニューの指定によって読み込み制御を行うことができるようになる。

ライセンス
----------
[Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0)

利用可能環境
------------
* PHP5.2以上(テストは5.3以上)
* Wordpress 3.0以上(テストは3.2以上)

使用方法
--------
### 手動で入れる
* 自分のテンプレートディレクトリにvendorディレクトリを作成。(libsとかでもOK）
* その中にWTFをインストールする。

### gitを使う
* テンプレートディレクトリで下記コマンドを実行

    git clone git://github.com/ariela/wtf.git vendor

### 共通
* vendor/Wtf/cachesに書き込み権限を与える。
* functions.phpに呼び出しコードを記述する。

    require_once dirname(\_\_FILE\_\_) . '/vendor/Wtf.php';
    $wpt = Wtf::getInstance();

* 管理メニューに「WTF設定」が追加されるので、使いたいモジュールを選択する。
* 管理メニューのサブパネルの設定を行う。

対応モジュール
--------------

### ヘッダ ###
wp_headで呼び出されるヘッダコードを追加する為のモジュール。

Wtf/Header以下にクラスを生成する。

#### クラスの作成方法
[例:OpenGraph ヘッダモジュール](https://github.com/ariela/wtf/blob/master/Wtf/Header/OpenGraph.php)

### カスタムメニュー ###
カスタムメニューの領域を追加する為のモジュール

Wtf/Menu以下にクラスを作成する。

#### クラスの作成方法
[例:Global メニュー領域モジュール](https://github.com/ariela/wtf/blob/master/Wtf/Menu/Global.php)

### ショートコード ###
投稿時に使用できるショートコードを追加する為のモジュール

Wtf/ShortCode以下にクラスを作成する。

#### クラスの作成方法
[例:Example ショートコードモジュール](https://github.com/ariela/wtf/blob/master/Wtf/ShortCode/Example.php)

### カスタムタクソノミー ###
カスタムタクソノミーを追加する為のモジュール

Wtf/Taxonomy以下にクラスを作成する。

#### クラスの作成方法
[例:Books カスタムタクソノミーモジュール](https://github.com/ariela/wtf/blob/master/Wtf/Taxonomy/Books.php)

### カスタム投稿タイプ ###
カスタム投稿タイプを追加する為のモジュール

Wtf/Type以下にクラスを作成する。

#### クラスの作成方法
[例:Books カスタム投稿タイプモジュール](https://github.com/ariela/wtf/blob/master/Wtf/Type/Books.php)

### ウィジェット領域 ###
ウィジェット領域を追加する為のモジュール

Wtf/WidgetArea以下にクラスを作成する。

#### クラスの作成方法
[例:First ウィジェット領域モジュール](https://github.com/ariela/wtf/blob/master/Wtf/WidgetArea/First.php)

### ウィジェット ###
ウィジェットを追加する為のモジュール

#### クラスの作成方法
[例:AdSence ウィジェットモジュール](https://github.com/ariela/wtf/blob/master/Wtf/Widget/AdSence.php)

### フィルター ###
WordPressのフィルターに追加する為のモジュール

Wtf/Filter以下にクラスを作成する。

#### クラスの作成方法
[例:AppendContact フィルターモジュール](https://github.com/ariela/wtf/blob/master/Wtf/Filter/AppendContact.php)
