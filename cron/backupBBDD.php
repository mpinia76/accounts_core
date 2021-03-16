<?php


include_once  dirname(__DIR__) . '/vendor/autoload.php';


use Accounts\Core\conf\AccountsConfig;
use Cose\persistence\PersistenceContext;
use Accounts\Core\notificaciones\backupBBDD\BackupBBDD;

//inicializamos cuentas core.
AccountsConfig::getInstance()->initialize();
AccountsConfig::getInstance()->initLogger( dirname(__FILE__).  "/log4php.xml");

$persistenceContext =  PersistenceContext::getInstance();


$notificacion = new BackupBBDD();
$notificacion->send();

//cerramos la conexión a la base.
$persistenceContext->close();




?>
