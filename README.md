Wordpress Template Framework
============================

ほぼ自分専用に作っているWordPress向けのテンプレートフレームワーク。
fork/pull-request大歓迎。

通常functions.phpに記述するようなカスタムメニューやウィジェット領域などをクラスにてモジュール化し、
メニューの指定によって読み込み制御を行うことができるようになる。

ライセンス
----------
[Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0)

使用方法
--------
### 手動で入れる
* 自分のテンプレートディレクトリにvendorディレクトリを作成。(libsとかでもOK）
* その中にWTFをインストールする。

### gitを使う
* テンプレートディレクトリで下記コマンドを実行

    git clone git://github.com/ariela/wtf.git vendor

### 共通
* functions.phpに呼び出しコードを記述する。

    require_once dirname(\_\_FILE\_\_) . '/vendor/Wtf.php';
    $wpt = Wtf::getInstance();

* テーマのメニューに「WTF設定」が追加されるので、使いたいモジュールを選択する。

対応モジュール
--------------

### カスタムメニュー
Wtf/Menu以下にクラスを作成する。

### ショートコード
Wtf/ShortCode以下にクラスを作成する。

### カスタムタクソノミー
Wtf/Taxonomy以下にクラスを作成する。

### カスタム投稿タイプ
Wtf/Type以下にクラスを作成する。

### ウィジェット領域
Wtf/WidgetArea以下にクラスを作成する。

### フィルター
Wtf/Filter以下にクラスを作成する。