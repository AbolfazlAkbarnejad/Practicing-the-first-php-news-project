<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="row mt-3">

    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/catgory") ?>" class="text-decoration-none">
            <div class="card text-white bg-gradiant-green-blue mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-clipboard-list"></i> Categories</span> <span class="badge badge-pill right"><?= $ContCatgory["COUNT(*)"] ?></span></div>
                <div class="card-body">
                    <section class="font-12 my-0"><i class="fas fa-clipboard-list"></i> GO TO Categories!</section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/user") ?>" class="text-decoration-none">
            <div class="card text-white bg-juicy-orange mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-users"></i> Users</span> <span class="badge badge-pill right"><?= $ContUser["COUNT(*)"] ?></span></div>
                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="fas fa-users-cog"></i> Admin <span class="badge badge-pill mx-1"><?= $ContAdmin["COUNT(*)"] ?></span></span>
                        <span class=""><i class="fas fa-user"></i> Lider <span class="badge badge-pill mx-1"><?= $ContLider["COUNT(*)"] ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/post") ?>" class="text-decoration-none">
            <div class="card text-white bg-dracula mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-newspaper"></i> Article</span> <span class="badge badge-pill right"><?= $ContPost["COUNT(*)"] ?></span></div>
                <div class="card-body">
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="fas fa-bolt"></i> Views <span class="badge badge-pill mx-1"><?= $ContView['SUM(view)'] ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-3">
        <a href="<?= url("admin/comment") ?>" class="text-decoration-none">
            <div class="card text-white bg-neon-life mb-3">
                <div class="card-header d-flex justify-content-between align-items-center"><span><i class="fas fa-comments"></i> Comment</span> <span class="badge badge-pill right"><?= $ContComment["COUNT(*)"] ?></span></div>
                <div class="card-body">
                    <!--                        <h5 class="card-title">Info card title</h5>-->
                    <section class="d-flex justify-content-between align-items-center font-12">
                        <span class=""><i class="far fa-eye-slash"></i> Unseen <span class="badge badge-pill mx-1"></span><?= $ContComment_Unseen["COUNT(*)"] ?></span>
                        <span class=""><i class="far fa-check-circle"></i> Approved <span class="badge badge-pill mx-1"><?= $ContComment_enable["COUNT(*)"] ?></span></span>
                    </section>
                </div>
            </div>
        </a>
    </div>

</div>


<div class="row mt-2">
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Most viewed posts
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>view</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts_view as $post_view) { ?>
                        <tr>
                            <td>
                                <a class="text-primary" href="">
                                    <?= $post_view["id"] ?>
                                </a>
                            </td>
                            <td>
                                <?= $post_view["title"] ?>
                            </td>
                            <td><span class="badge badge-secondary"> <?= $post_view["view"] ?>
                                </span></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Most commented posts

        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>comment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts_comment as $post_comment) { ?>

                        <tr>
                            <td>
                                <a class="text-primary" href="">
                                    <?= $post_comment["id"] ?>
                                </a>
                            </td>
                            <td>
                                <?= $post_comment["title"] ?>
                            </td>
                            <td><span class="badge badge-success"> <?= $post_comment["CountComment"] ?></span></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-4">
        <h2 class="h6 pb-0 mb-0">
            Comments
        </h2>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>username</th>
                        <th>comment</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($comments as $comment) { ?>

                        <tr>
                            <td>
                                <a class="text-primary" href="">
                                    <?= $comment["id"] ?>
                                </a>
                            </td>
                            <td>
                                <?= $comment["user_email"] ?>
                            </td>
                            <td>
                                <?= $comment["comment"] ?>
                            </td>
                            <td><span class="badge badge-warning"> <?= $comment["status"] ?>
                                </span></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>