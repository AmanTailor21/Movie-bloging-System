<?php
session_start();
require_once 'myclass.php';
$ob = new myClass();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");
}
$id = $_REQUEST['id'];
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="js.js"></script>
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="jquery.js"></script>
    <style>
        textarea {
            width: 100%;
            height: 100%;
        }

        .custom {
            background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);
        }


    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#like").click(function () {
                $.ajax({
                    type: "POST",
                    url: "like.php",
                    data: {id:<?php echo $id;?>},
                    dataType: "html",
                    success: function (response) {
                        //$("#like").html(response);
                        $("#total").html(response);
                    }
                });
            });

            $(".send").click(function () {
                let comment_id = $(this).data('comment-id');
                let blog_id = $(this).data('blog-id');
                let reply = $('#view_' + comment_id).find('input').val();

                $.ajax({ //
                    type: "POST",
                    url: "comment_reply.php",
                    data: {comm: reply, m_id: blog_id, c_id: comment_id},
                    dataType: "html",
                    success: function (response) {
                        $.ajax({ //
                            type: "GET",
                            url: "getcomment_reply.php",
                            data: {c_id: comment_id},
                            dataType: "html",
                            success: function (response) {
                                $("#reply_data").val("");
                                $("#comment_reply-post").empty();
                                $("#comment_reply-post").append(response);
                            }
                        });
                    }
                });
            });

        });


        $(document).ready(function () {
            $("#submit").click(function () {
                $.ajax({ //
                    type: "POST",
                    url: "comment.php",
                    data: {comm: $("#comment").val(), ii:<?php echo $id; ?>},
                    dataType: "html", //expect html to be returned
                    success: function (response) {
                        $.ajax({ //
                            type: "GET",
                            url: "getcomment.php",
                            data: {id: <?php echo $id; ?>},
                            dataType: "html", //expect html to be returned
                            success: function (response) {
                                $("#comment").val("");
                                $("#comment-post").empty();
                                $("#comment-post").prepend(response);
                            }
                        });
                    }
                });
            });
        });


        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) {?>
            $('#view_<?php echo $com[0]; ?>').hide();
            <?php } ?>
        });
        $(document).ready(function () {
            <?php $c = $ob->getcomment($id); foreach ($c as $com) { ?>
            $('#show_<?php echo $com[0]; ?>').click(function () {

                $('#view_<?php echo $com[0]; ?>').toggle("");

            });
            <?php } ?>
        });

    </script>
    <title>Movie Blog</title>

</head>
<body>
<?php
include 'navbar.php';
?>
<div class="container mt-5">
    <?php
    $a = $ob->showmovie($id);
    foreach ($a as $rs) { ?>
        <div class="row">
            <div class="col-lg-4">
                <img class="img" width="100%" src="<?php echo "image/" . $rs[4]; ?>">
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-sm-10">
                        <h1 class="title"><?php echo $rs[1]; ?></h1>
                    </div>
                    <div class="col-sm-2" id="like-div">
                        <?php $num = $ob->glike($_SESSION['id'], $rs[0]); ?>
                        <i class="fa fa-thumbs-o-up <?php echo ($num == 1) ? 'text-danger ' : '' ?>" id="like"
                           style="font-size: 25px"></i>
                        <i id="total"><?php $r = $ob->likecounter($id);
                            echo $r[0]; ?></i>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <small class="text-muted">Post By : <?php echo $rs[6] ?> </small>

                    </div>
                    <div class="col-lg-3">
                        <small class="text-muted"> <?php echo $rs[7] ?> </small>
                    </div>
                </div>
                <h5 class="" style=" background-color: #abe9cd;
            background-image: linear-gradient(315deg, #abe9cd 0%, #3eadcf 74%);">Topic : <?php echo $rs[2]; ?></h5>
                <p class="text"> <?php echo $rs[3]; ?></p>
                <div class="container-fluid p-0" id="comment-post">
                    <?php
                    $c = $ob->getcomment($id);
                    foreach ($c as $com) { ?>
                        <div class="p-1">
                            <div class="row">
                                <div class="col-lg-1">
                                    <img src="user.png" width="30px" height="30px">
                                </div>
                                <div class="col-sm-9">
                                    <a><b><?php echo $com[2]; ?></b></a>
                                    <p><?php echo $com[1]; ?></p>
                                    <div class="container-fluid" id="comment_reply-post">
                                        <?php
                                        $c = $ob->getcomment_reply($com[0]);
                                        foreach ($c as $val) { ?>
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <img src="user.png" width="25px" height="25px">
                                                </div>
                                                <div class="col-sm-11">
                                                    <a><b><?php echo $val[3] ?></b></a>
                                                    <p><?php echo $val[4] ?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <i class="fa fa-reply-all" aria-hidden="true" id="show_<?php echo $com[0]; ?>">
                                        <small class="text-muted">Reply</small></i>
                                </div>

                                <div class="container-fluid">
                                    <div class="input-group mb-3" id="view_<?php echo $com[0]; ?>">
                                        <input type="text" class="form-control" id="reply_data"
                                               placeholder="Enter Your Reply" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary send"
                                                    data-blog-id="<?php echo $_REQUEST['id']; ?>"
                                                    data-comment-id="<?php echo $com[0]; ?>" type="button">Send
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<div class="container mt-5" style="padding-bottom: 60px;">
    <h2>Leave a Replay</h2>
    <form method="post">
        <div class="form-group">
            <textarea class="form-control" name="comment" id="comment" placeholder="Enter Your Comment"></textarea><br>
            <input class="btn btn-success" style="background-color: #ff9800;color: white" type="button" id="submit"
                   value="Submit" name="Submit">
        </div>
    </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>-->
<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"-->
<!--        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"-->
<!--        crossorigin="anonymous"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"-->
<!--        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"-->
<!--        crossorigin="anonymous"></script>-->

</body>
</html>
<?php include 'footer.php';
?>




