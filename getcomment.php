
<?php
session_start();
require_once 'myclass.php';
$ob=new myClass();

        $c = $ob->getcomment($_REQUEST['id']);
        $val = $c[0];
        foreach ($c as $val) { ?>
            <div class='p-2'>
                <div class='row'>
                    <div class='col-lg-1'>
                        <img src='user.png' width='30px' height='30px'>
                    </div>
                    <div class='col-sm-9'>
                        <a><b><?php echo $val['id'] ?></b></a>
                        <p><?php echo $val['c_replay'] ?></p>
                    </div>
                </div>
            </div>
       <?php }
?>
