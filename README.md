planetarium
===========

web socket のRatchetがうまく動作しません。

PHP Fatal error:  Non-abstract method CakeWampAppServer::onUnSubscribe() must contain body in /vagrant_data/Plugin/Ratchet/Lib/Wamp/CakeWampAppServer.php on line 171

/vagrant_data/Plugin/Ratchet/Lib/Wamp/CakeWampAppRpcTrait.php
32行目
- abstract function onUnSubscribe($conn, $topic);
+ //abstract function onUnSubscribe($conn, $topic);
をコメントにして動作させています。