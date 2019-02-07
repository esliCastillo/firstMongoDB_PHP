<?php
include_once("config.php");

$id = $_GET['id'];

$db->user->remove(array('_id' => new MongoId($id)));

header("Location:index.php");