<?php
include 'includes/functions.php';
include ('includes/config.inc.php');

session_destroy();

header("Location: /cms/index.php");
die();