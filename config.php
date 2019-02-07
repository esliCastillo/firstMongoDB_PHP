<?php
$connection = new MongoClient();
if(!$db = $connection->test){
echo "problemas de conexion";
}