<?php echo date("Y-m-d H:i:s");
require_once(BASE_PATH . "/template/app/layaout/heder.php")  ?>
<div class="clear-fix"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="top-sidebar-r">
                <span class="title">انتخاب سردبیر</span>
                <?php foreach ($selecteds as $selected) { ?>
                    <a href="<?= url("show/" . $selected["id"]) ?>"> <!-- user link show -->
                        <div class="bx">
                            <div class="col-md-6">
                                <div class="img-box">
                                    <figure>
                                        <img src="<?= asset($selected["image"]) ?>" alt="">
                                        <!-- <figcaption><span>></span></figcaption> -->
                                    </figure>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="meta">
                                    <h5 style="height: 89px;">
                                        <?= $selected["title"] ?></br>
                                        <span><i class="fa fa-clock-o"></i> <?= $selected["created_at"] ?></span>
                                        <div class="text-left" style="position: relative;bottom: 23px;">
                                            <sub><i class="fa fa-comment"> </i> <?= $selected["countComment"] ?></sub>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="main-slider-box">
                <div class="owl-carousel owl-theme main-slider">
                    <?php foreach ($news_hots as $news_hot) { ?>
                        <div class="item">
                            <figure>
                                <img src="<?= $news_hot["image"] ?>" alt="">
                                <figcaption class="gradient-fig"></figcaption>
                                <figcaption class="desc-fig">
                                    <!-- <span><i class="fa fa-heart"></i> 56</span> -->
                                    <h3> <?= $news_hot["title"] ?></h3>
                                    <span><i class="fa fa-clock-o"></i><?= $news_hot["created_at"] ?></span>
                                    <?= substr($news_hot["Summary"], 0, 340) . "..." ?>
                                </figcaption>
                            </figure>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="top-sidebar-l">
                <span class="title">یادداشت</span>
                <?php foreach ($likes as $like) { ?>
                    <a href="<?= url("like/" . $like["id"]) ?>">
                        <div class="bx">
                            <div class="col-md-3 nopadding">
                                <span style="background-color:<?= $_COOKIE["like_" . $like["id"]] == 1 ? ' #ef7c00' : "" ?>;"><i class="fa fa-heart"></i><?= $like["like"] ?> </span>
                            </div>
                            <div class="col-md-8 nopadding">
                                <h3>
                                    <?= $like["text"] ?>
                                </h3>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="clear-fix"></div>
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="r-sidebar">
                    <div class="special-posts">
                        <span class="title">گفتگو</span><br>
                        <?php foreach ($comments as $comment) { ?>

                            <div class="special-box">
                                <a href="<?= url("show/" . $comment["id"]) ?>">
                                    <figure>
                                        <img src="<?= $comment["image"] ?>" alt="">
                                        <figcaption class="txt">
                                            <h4> <?= $comment["title"] ?></h4>
                                            <span><i class="fa fa-calendar-o"></i> <?= $comment["created_at"] ?></span>
                                            <span><i class="fa fa-comment-o"></i> <?= $comment["countComment"] ?></span>
                                        </figcaption>
                                        <figcaption class="link"><i class="fa fa-external-link"></i></figcaption>
                                    </figure>
                                </a>
                            </div>
                        <?php  } ?>
                    </div>
                    <?php if (!empty($banners[0])) { ?>
                        <div style="border: 0px solid black; box-shadow: -5px 10px #00000005;background-color: white;">
                            <span class="title" style=" position: relative ;top: 10px ;right: 25px;">تبلیغات</span><br>
                            <?php foreach ($banners as $banner) { ?>
                                <a href="<?= $banner["link"] ?>">
                                    <img src="<?= asset($banner["image"]) ?>" style=" width: 100%;padding: 13px; height: 25vh; " alt="">
                                </a>
                            <?php } ?>
                        </div>
                    <?php  } ?>




                </div>
            </div>
            <div class="col-md-6">
                <div class="content-wrapper">
                    <div class="most-views">
                        <span class="title">مطالب پربازدید</span>
                        <?php if (!empty($populars[0])) { ?>
                            <div class="col-md-8">
                                <div class="main-post">
                                    <a href="<?= url("show/" . $populars[0]["id"]) ?>">
                                        <figure>
                                            <img src="<?= $populars[0]["image"] ?>" alt="">
                                            <figcaption>
                                                <span><i class="fa fa-folder-o"></i> خبر روز</span>
                                                <h3><?= $populars[0]["title"] ?></h3>
                                                <span><i class="fa fa-comments-o"></i> <?= $populars[0]["countComment"] ?></span>
                                            </figcaption>
                                        </figure>
                                        <div class="p-div">
                                            <?= $populars[0]["Summary"] ?>
                                        </div>
                                </div>
                                </a>
                            </div>
                        <?php } ?>
                        <div class="col-md-4">
                            <?php if (!empty($populars[1])) { ?>
                                <div class="oth-posts">
                                    <div class="r-box">
                                        <span class="cat-span"><?= $populars[1]["catgory"] ?></span>

                                        <a href="<?= url("show/" . $populars[1]["id"]) ?>">
                                            <h5> <?= $populars[1]["title"] ?></h5>
                                        </a>
                                        <span><i class="fa fa-clock-o"></i> <?= $populars[1]["created_at"] ?></span>
                                    </div>
                                <?php }
                            if (!empty($populars[2])) { ?>

                                    <div class="r-box">
                                        <span class="cat-span"><?= $populars[2]["catgory"] ?></span>
                                        <a href="<?= url("show/" . $populars[2]["id"]) ?>">
                                            <h5> <?= $populars[2]["title"] ?></h5>
                                        </a>
                                        <span><i class="fa fa-clock-o"></i> <?= $populars[2]["created_at"] ?></span>
                                    </div>

                                <?php }
                            if (!empty($populars[3])) { ?>

                                    <div class="r-box">
                                        <span class="cat-span"><?= $populars[3]["catgory"] ?></span>
                                        <a href="<?= url("show/" . $populars[3]["id"]) ?>">
                                            <h5> <?= $populars[3]["title"] ?></h5>
                                        </a>
                                        <span><i class="fa fa-clock-o"></i> <?= $populars[3]["created_at"] ?></span>
                                    </div>
                                <?php } ?>

                                </div>
                        </div>
                    </div>
                    <!-- <div class="special-cat-box">
                        <span class="title">فیلم و ویدئو</span>
                        <div class="col-md-6">
                            <div class="main-post">
                                <a href="#">
                                    <figure>
                                        <img src="img/290667058azer news.jpg" alt="">
                                        <figcaption>
                                            <span><i class="fa fa-folder-o"></i> خبر روز</span>
                                            <h3>ایپسوم متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h3>
                                            <span><i class="fa fa-comments-o"></i> 65</span>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                            <div class="main-post">
                                <a href="#">
                                    <figure>
                                        <img src="img/696112501123546.jpg" alt="">
                                        <figcaption>
                                            <span><i class="fa fa-folder-o"></i> خبر روز</span>
                                            <h3>ایپسوم متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h3>
                                            <span><i class="fa fa-comments-o"></i> 65</span>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="left-content">
                                <div class="col-md-6">
                                    <a href="#">
                                        <div class="content">
                                            <figure>
                                                <img src="img/696112501123546.jpg" alt="">
                                                <figcaption><i class="fa fa-external-link"></i></figcaption>
                                            </figure>
                                            <span>آموزشی</span>
                                            <span>انجمن</span>
                                            <h5> متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#">
                                        <div class="content">
                                            <figure>
                                                <img src="img/parsitarh-1038x515.png" alt="">
                                                <figcaption><i class="fa fa-external-link"></i></figcaption>
                                            </figure>
                                            <span>آموزشی</span>
                                            <h5> متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#">
                                        <div class="content">
                                            <figure>
                                                <img src="img/karkhaneh_iran_3.jpg" alt="">
                                                <figcaption><i class="fa fa-external-link"></i></figcaption>
                                            </figure>
                                            <span>آموزشی</span>
                                            <h5> متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h5>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#">
                                        <div class="content">
                                            <figure>
                                                <img src="img/1397022612335447514155694.jpg" alt="">
                                                <figcaption><i class="fa fa-external-link"></i></figcaption>
                                            </figure>
                                            <span>آموزشی</span>
                                            <h5> متن ساختگی با تولید سادگی نامفهوم تولید سادگی از صنعت</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="l-sidebar">
                    <div class="cat-sidebar report">
                        <span class="title">گزارش</span>
                        <div class="text-left"><i class="fa fa-arrows-alt"></i></div>
                        <ul>
                            <li><a href="#">لورم ایپسو استفاده از طراحان</a></li>
                            <li><a href="#">و سه درصد می طلبد تا با نرم افزارها ش</a></li>
                            <li><a href="#"> فارسی ایجاد کرد. در ارائه راهکارها</a></li>
                            <li><a href="#"> اصلی و جوابگوی مورد استفاده قرار گیرد.</a></li>
                            <li><a href="#">متن ساختگی با تولید سادگی نامفهوم متن ساختگی با تولید سادگی نامفهوم
                                    استفاده استفاده</a>
                            </li>
                            <li><a href="#"> و سه درصد گذشته با نرم افزارها </a></li>
                            <li><a href="#">لورم ایپسو استفاده از طراحان</a></li>
                            <li><a href="#">و سه درصد می طلبد تا با نرم افزارها ش</a></li>
                            <li><a href="#"> فارسی ایجاد کرد. در ارائه راهکارها</a></li>
                        </ul>
                    </div>
                </div>
                <div class="l-sidebar">
                    <div class="cat-sidebar">
                        <span class="title">دسته بندی مطالب</span>
                        <div class="text-left"><i class="fa fa-folder-o"></i></div>
                        <ul>
                            <?php foreach ($catgoreis as $catgory) { ?>
                                <li><a href="<?= url("catgory/" . $catgory['id'] . "/navgation/1") ?>"><?= $catgory["name"] ?></a><span><?= $catgory["countPost"] ?></span></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear-fix"></div>
    <div class="latest-posts">
        <div class="container-fluid">
            <div class="blog-title-span">
                <span class="title">آخرین مطالب</span>
            </div>
            <?php foreach ($posts as $post) { ?>

                <div class="col-md-3">
                    <div class="post-box">
                        <a href="<?= url("show/" . $post["id"]) ?>">
                            <figure>
                                <img src="<?= $post["image"] ?>" alt="">
                                <figcaption class="meta-fig">
                                    <span><i class="fa fa-clock-o"></i> <?= $post["created_at"] ?></span>&nbsp;
                                    <span><i class="fa fa-comment-o"></i> <?= $post["countComment"] ?></span>
                                </figcaption>
                                <figcaption class="view">
                                    <span>بخش ویژه</span>
                                    <span>انجمن</span>
                                    <span>اتاق خبر</span>
                                </figcaption>
                            </figure>
                            <div class="text-p">
                                <h5><?= $post["title"] ?></h5>
                                <?= substr($post["Summary"], 0, 100) . "..." ?>
                                <div class="text-rigt">
                                    <a href="#">ادامه ...</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="clear-fix"></div>
<?php require_once(BASE_PATH . "/template/app/layaout/footer.php")  ?>