<?php require_once(BASE_PATH . "/template/app/layaout/heder.php")  ?>

<div class="latest-posts">
    <div class="container-fluid">
        <div class="col-md-9">
            <div class="blog-title-span">
                <span class="title">اخبار و مقالات</span>
            </div>

            <?php
            // $postddd = $posts[1 * 2] ;
            // dd($post);
            // for ($i = 0; $i < $posts ; $i++) {
            foreach ($posts as $post) {
                // dd($posts);
            ?>

                <div class="col-md-4">
                    <div class="post-box">
                        <a href="<?= url("show/" . $post["id"]) ?>">

                            <figure>
                                <img src="<?= asset($post["image"]) ?>" alt="">
                                <figcaption class="meta-fig">
                                    <span><i class="fa fa-clock-o"></i><?= $post["created_at"] ?> </span>&nbsp;
                                    <span><i class="fa fa-comment-o"></i> <?= $post["countComment"] ?></span>
                                </figcaption>

                            </figure>
                            <div class="text-p">
                                <h5> <?= $post["title"] ?></h5>
                                <?= substr($post["Summary"], 0, 250) ?>
                                <div class="text-rigt">
                                    <a href="#">ادامه ...</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="col-md-3 main-content">
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
        </div>
        <div class="col-md-12 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php
                    $Previous = $nav_id - 1;
                    if ($nav_id >= 2) { ?>
                        <li class="page-item"><a class="page-link" href="<?= url("catgory/" . $check_catgory["id"] . "/navgation/" . $Previous) ?>">قبلی</a></li>
                    <?php } ?>
                    <?php
                    //   dd($check_catgory);
                    // $d = count($contgrops) / 2;
                    // dd($contgrops);
                    // for ($i = 1; $i <= $d; $i++) {
                    // $cont_post = count($po);
                    // dd($po["COUNT(*)"]);
                    // foreach ($po as $grops) {
                    // dd($po);
                    $po = $po["COUNT(*)"] / 6.1;
                    for ($i = 0; $i <= (int)$po; $i++) {
                        // for ($i = 0; $i < $grop; $i++) {
                        //    var_dump($grops) 
                        $Page = $i + 1;

                    ?>

                        <li class="page-item"><a class="page-link" href="<?= url("catgory/" . $check_catgory["id"] . "/navgation/" . $Page) ?>" style=" background-color: <?= $nav_id == $i+1 ? "rgba(76, 72, 72, 0.384)" : "" ?>"><?= $i + 1 ?></a></li>
                        <?php
                        ?>
                    <?php }
                    // dd($i);
                    $next =  $nav_id + 1;
                    if ($nav_id < $i) {
                    ?>
                        <li class="page-item"><a class="page-link" href="<?= url("catgory/" . $check_catgory["id"] . "/navgation/" . $next) ?>">بعدی</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="clear-fix"></div>

<?php require_once(BASE_PATH . "/template/app/layaout/footer.php")  ?>