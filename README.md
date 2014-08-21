planetarium
===========
Vagrant on
* PHP 5.4+
* CakePHP 2.x
* nginx
* Ratchet (webSocket)
* supervisor
* haproxy


===========
web socket Ratchet have error!!!

> PHP Fatal error:  Non-abstract method CakeWampAppServer::onUnSubscribe() must contain body in /vagrant_data/Plugin/Ratchet/Lib/Wamp/CakeWampAppServer.php on line 171

if you change source. It works.
/vagrant_data/Plugin/Ratchet/Lib/Wamp/CakeWampAppRpcTrait.php
line32

- abstract function onUnSubscribe($conn, $topic);
+ //abstract function onUnSubscribe($conn, $topic);

