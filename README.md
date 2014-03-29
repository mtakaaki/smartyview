smartyview
==========
CakePHP から Smarty を扱えるようにするためのViewライブラリです。

http://www18.atwiki.jp/javascripter/pages/26.html

上記サイトでオリジナルソースが配布されているのですが、対応バージョンが2.0と
古く、CakePHP2.2を使用するとエラーが発生します。こちらで配布するsmartyview
はオリジナルソースに手を加え、2.2でも正常に利用できるように対応しました。

2014.03.30 
 - CakePHP 2.4系だとエラーが発生して使用できなかったのを対応しました。
 - smartyライブラリのディレクトリ名をSmartyに変更しました。
 - AppControllerと一式を同梱するようにした
 - Viewオブジェクトをthisに割り当てるようにした

使用方法
--------
1. SmartyのコアライブラリをCakePHPのvendorsディレクトリにコピーします。

    cp -pr smarty-x.x/lib cakephp-x.x/vendors/Smarty

2. smartyviewツリーをコピーします。

    cp -pr smartyview/app cakephp-x.x/

3. tmpのパーミッションを書き込み可能にしておきます。

    chmod -R a+w cakephp-x-x/app/tmp

