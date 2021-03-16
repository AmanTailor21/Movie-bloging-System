<?php
session_start();
require_once 'myclass.php';
$ob=new myClass();

$id=$_POST["id"];
$uid=$_SESSION["id"];

$f=$ob->fetchlike($id);

$s = 1;
$r = $ob->insertlike($uid, $id, $s);
if ($r == 1) {
   echo "<script> document.getElementById('like').className ='fa fa-thumbs-o-up text-danger';</script>";
}

foreach ($f as $blog) {
    if($blog['0']==$uid) {
        $r = $ob->deletelike($uid, $blog['1']);
        if ($r == 1) {
            echo "<script> document.getElementById('like').className ='fa fa-thumbs-o-up text-dark';</script>";
        }
    }
}


$r = $ob->likecounter($id);
echo $r[0];
?>

