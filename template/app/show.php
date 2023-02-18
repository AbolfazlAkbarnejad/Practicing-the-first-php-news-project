<?php
require_once(BASE_PATH . "/template/app/layaout/heder.php")  ?>

<div class="single_post">
    <div class="container-fluid">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="post_img">
                        <img src="img/696112501123546.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="posts_meta text-center">
                <span><i class="fa fa-comment-o"></i><?= $post["countComment"] ?></span>
                <span><i class="fa fa-calendar"></i> <?= $post["created_at"] ?></span>
                <span><i class="fa fa-archive"></i> <?= $post["nameCatgory"] ?></span>

            </div>
            <div class="post_content">
                <h4><?= $post["title"] ?></h4>
                <?= $post["Summary"] ?>
                <img src="<?= asset($post["image"]) ?>" alt="">
                <?= $post["body"] ?>
            </div>
            <div class="comments_form">
                <?php if (!empty(flash("error_sendComment"))) { ?>
                    <p style="color: green;"><?= flash("error_sendComment") ?></p>
                <?php } ?>
                <h5>دیدگاه شما </h5>
                <form action="<?= url("sendComment/" . $post["id"]) ?>" method="post">
                    <div class="form-row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="user_name" placeholder="نام شما">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="user_email" placeholder="ایمیل">
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" name="comment" placeholder="نظر شما ..."></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="text-left">
                                <button class="btn btn-primary">ثبت نظر</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="clear-fix"></div>
<?php require_once(BASE_PATH . "/template/app/layaout/footer.php")  ?>