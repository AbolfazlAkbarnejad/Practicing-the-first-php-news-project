<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/post/create") ?>" class="btn btn-sm btn-success">create</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of posts</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>title</th>
                <th>summary</th>
                <th>view</th>
                <th>status</th>
                <th>user ID</th>
                <th>cat ID</th>
                <th>image</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) { ?>
                <tr>
                    <td>
                        <a class="text-primary" href="">
                            <?= $post["id"] ?>
                        </a>
                    </td>
                    <td>
                        <?= $post["title"] ?>
                    <td>
                        <?= strlen($post["Summary"]) > 200 ? substr($post["Summary"], 0, 200) . " ..." : $post["Summary"] ?></td>
                    <td>
                        <?= $post["view"] ?>
                    </td>
                    <td>
                        <?php if ($post["selected"] == "yes") { ?>
                            <span class="badge badge-dark">#editor_selected</span>
                        <?php } ?>
                    </td>
                    <td>
                        <?= $post["usersname"] ?>
                    </td>
                    <td>
                        <?= $post["catgory"] ?>
                    </td>
                    <td><img style="width: 80px;" src="<?= asset($post["image"]) ?>" alt=""></td>
                    <td style="width: 25rem;">
                        <!-- <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="">
                            remove breaking news add breaking news
                        </a> -->
                        <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url("admin/post/selected/" . $post["id"]) ?>">
                            <?= $post["selected"] == "yes" ? "remove selcted" : " add selected" ?>
                        </a>


                        <?php if ($check_newsHot["COUNT(*)"] <= 2) { ?>
                            <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url("admin/post/news_hot/" . $post["id"]) ?>">
                                <?= $post["news_hot"] == "enable" ? " exit to news hot" : "got to news hot" ?>
                            </a>
                        <?php } elseif ($post["news_hot"] == "enable") { ?>

                            <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url("admin/post/news_hot/" . $post["id"]) ?>">
                                <?= $post["news_hot"] == "enable" ? " exit to news hot" : "got to news hot" ?>
                            </a>

                        <?php } ?>





                        <hr class="my-1" />
                        <a role="button" class="btn btn-sm btn-primary text-white" href="<?= url("admin/post/edit/" . $post["id"]) ?>">edit</a>
                        <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url("admin/post/delet/" . $post["id"]) ?>">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>