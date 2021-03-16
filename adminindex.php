<?php
session_start();
require_once 'myclass.php';
$ob = new myclass();
$con = 0;
if (!isset($_SESSION['name'])) {
    header("Location:login.php");

}
$b = $ob->count();
foreach ($b as $ab) {
    $con = $ab[0];
} ?>

    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <script type="text/javascript" src="js.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <script src="jquery.js"></script>
        <style>
            textarea {
                width: 100%;
                height: 100%;
            }

        </style>
        <title>Movie Blog</title>
        <script type="text/javascript">
            var offset = 0;
            var cnt = 8;
            // $(document).ready(function () {
            //     $("#loadMore").on("click", function () {
            //
            //     });
            // });
            $(window).scroll(function () {
                if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                    offset = offset + 8;
                    $.ajax({
                        url: "load-more.php",
                        type: "POST",
                        data: {offset: offset},
                        cache: false,
                        success: function (data) {
                            cnt += 8;
                            $('#myList').append(data);
                            if ((<?php echo $con ?>) <= cnt) {
                                $('#loadMore').hide()
                            }
                        }
                    });
                }
            });
        </script>
    </head>
    <body>
    <?php
    include 'navbar.php';
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="image/watchxcricketonl-slider.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/Star-Wars-Rise-of-Skywalker-Key-Art-Horizontal.jpg"
                     alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/Slider%20Arrival-234081.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container" id='myList' style="padding-bottom: 10px;">
        <div class='row' id='myList'>
            <?php
            $a = $ob->show();
            foreach ($a as $rs) { ?>

                <div class="col-lg-3 mt-4">
                    <div class="card">
                        <a href="details.php?id=<?php echo $rs['m_id']; ?>"">
                        <img class="card-img-top" height="350px" src="<?php echo "image/" . $rs[4]; ?>">  </a>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $rs[1]; ?></h5>
                            <p class="card-text"><?php echo $rs[2]; ?></p>
                            <p class="card-text"><small class="text-muted"><a
                                            href="details.php?id=<?php echo $rs['m_id']; ?>"> Read More... </a></small>
                            </p>
                        </div>
                    </div>

                </div>
                <?php
            } ?>
        </div>
    </div>
    <p id='loadMore' style="cursor: pointer; text-align: center; margin-top: 10px;">Load More..</p>
    </body>
    </html>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
<?php include 'footer.php';
?>