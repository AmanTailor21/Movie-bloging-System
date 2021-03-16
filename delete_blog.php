<?php
require_once 'myclass.php';
$ob = new myclass();
if (isset($_REQUEST['did'])) {
    $d = $ob->delete($_REQUEST['did']);
    if ($d) {
        echo '<script type="text/javascript"> alert("Blog Deleted Successfully");
             window.location.href="adminindex.php";</script>';
    } else {
        echo "upsss";
    }
}
