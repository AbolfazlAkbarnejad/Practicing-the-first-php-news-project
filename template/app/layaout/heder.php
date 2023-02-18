<html>
<?php         //footer AND heder

use database\database;

$db = new database;
$showSetting = $db->select("SELECT * FROM setting")->fetch(); ?>

<head>
    <title><?= $showSetting["title"] ?></title>
    <meta name="description" content="<?= $showSetting["description"] ?>">
    <meta name="keywords" content="<?= $showSetting["key_words"] ?>">

    <link rel="stylesheet" href=" <?= asset("public/home/css/bootstrap.css") ?>">
    <link rel="stylesheet" href=" <?= asset("public/home/css/font-awesome.min.css") ?>">
    <link rel="stylesheet" href=" <?= asset("public/home/css/owl.carousel.css") ?>">
    <link rel="stylesheet" href=" <?= asset("public/home/css/owl.theme.default.css") ?>">
    <link rel="stylesheet" href="<?= asset("public/home/style.css ") ?>">

    <link rel="icon" type="image/x-icon" href="<?= asset($showSetting["icon"]) ?>">
    <link rel="icon" type="image/x-icon" href="<?= asset($showSetting["icon"]) ?>"><!-- logo non -->

</head>

<body>
    <div class="top-bar">

        <div class="container-fluid">
            <div class="col-md-6">
                <div class="search-btn">
                    <span><i class="fa fa-search"></i></span>
                </div>
            </div>
            <div class="col-md-6" style="margin-top: 10px;">
                <div class="top-cat-box">
                    <div class="col-md-12">
                        <div class="menu">
                            <ul>
                                <?php if (!isset($_SESSION["user"]) and !isset($_COOKIE["login"])) { ?>
                                    <li><a href="<?= url("login") ?>"> ورود</a></li>
                                    <li><a href="<?= url("register") ?>"> ثبت نام</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                     <div class="show-cat">
                         <span>
                             دسته ها
                             <i class="fa fa-bars"></i>
                         </span>
                     </div>
                     </div> -->
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container-fluid">
            <div class="col-md-10">
                <div class="main-menu">
                    <ul>
                        <li><a href="#">اتاق خبر</a></li>
                        <li><a href="#">اقتصادی</a></li>
                        <li><a href="#">انجمن</a></li>
                        <li><a href="#">گروه رسانه ای</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="social-box">
                    <ul>
                        <?php if (isset($showSetting["link_twitter"])) { ?>
                            <li><a href="<?= $showSetting["key_words"] ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>

                        <?php }
                        if (isset($showSetting["link_facebook"])) { ?>

                            <li><a href="<?= $showSetting["link_facebook"] ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>

                        <?php }
                        if (isset($showSetting["link_instagram"])) { ?>

                            <li><a href="<?= $showSetting["link_instagram"] ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>