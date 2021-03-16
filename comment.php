<?php
session_start();
require_once 'myclass.php';
$ob = new myClass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}

$comment = $ob->comment($_POST['comm'],$_SESSION['name'], $_POST['ii']);
if ($comment) {
    echo "Comment Success";
} else {
    echo "upsss";
}
