<?php
session_start();
require_once 'myclass.php';
$ob = new myclass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
?>
<div class='row' id='myList'>
        <?php
        $a = $ob->loadmore($_REQUEST["offset"]);
        ?>

           <?php
        foreach ($a as $rs) {

            ?>
            <div class="col-lg-3 mt-4">
                <div class="card">
                    <a href="details.php?id=<?php echo $rs['m_id']; ?>"">
                    <img class="card-img-top" height="350px" src="<?php echo "image/" . $rs[4]; ?>">  </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $rs[1]; ?></h5>
                        <p class="card-text"><?php echo $rs[2]; ?></p>
                        <p class="card-text"><small class="text-muted"><a href="details.php?id=<?php echo $rs['m_id']; ?>"> Read More... </a></small></p>
                    </div>
                </div>

            </div>
          <?php
        }
        ?>
</div>



