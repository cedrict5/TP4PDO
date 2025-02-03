<?php
$hostnom = 'host=srvmysql.btssio.dedyn.io';
$usernom = 'TIANANO';
$password = '05012006';
$bdd = 'TIANANO_Biblio';

try {
    $monPdo = new PDO("mysql:$hostnom;dbname=$bdd;charset=utf8", $usernom, $password);
    $monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $monPdo = null;
}
?>