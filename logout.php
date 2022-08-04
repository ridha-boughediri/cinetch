<?php

require_once("model/Dbh.php");
require_once("model/User.php");

$disconnect = new User;

$disconnect->disconnect();
