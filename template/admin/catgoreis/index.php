<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Categories</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/catgory/create") ?>" class="btn btn-sm btn-success">create</a>
    </div>
</div>
<div class="table-responsive">

    <table class="table table-striped table-sm">
        <caption>List of categories</caption>
        <thead>
            <?php if (!empty(flash("error_cargory"))) { ?>

                <h6 style="color: red;"><?= flash("error_cargory") ?></h6>
            <?php } ?>
            <!-- <div style="width: 500px;height: 350px; border: 1px solid black;position: absolute; margin-left: 25%;">
                <h5 style="text-align: center;">بین گزینه های زیر گزینه مد نظر خود را انتخاب کنید</h5>
                <div class="col-12 d" style="margin-top: 25%; width:100%; display: flex; justify-content: space-around;margin-left: auto; margin-right: auto;">
                    <a role="button" href="<?= url("admin/catgory/delete/" . $catgory["id"]) ?>" class="btn btn-sm btn-danger  text-white" >delete</a>
                    <a role="button" href="<?= url("admin/catgory/delete/" . $catgory["id"]) ?>" class="btn btn-sm btn-danger   text-white">delete</a>
                </div>
            </div> -->
            <tr>
                <th>#</th>
                <th>name</th>
                <th>number post</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($catgoreis[0]["name"])) {
                foreach ($catgoreis as $catgory) { ?>
                    <tr>
                        <td>
                            <?= $catgory["id"] ?>
                        </td>
                        <td>
                            <?= $catgory["name"] ?>
                        </td>
                        <td>
                            <?= $catgory["countPost"] ?>
                        </td>
                        <td>
                            <a role="button" href="<?= url("admin/catgory/edit/" . $catgory["id"]) ?>" class="btn btn-sm btn-info my-0 mx-1 text-white">update</a>
                            <a role="button" href="<?= url("admin/catgory/delete/" . $catgory["id"]) ?>" class="btn btn-sm btn-danger my-0 mx-1 text-white">delete</a>
                        </td>

                    </tr>
            <?php }
            } ?>
        </tbody>

    </table>
</div>

<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>