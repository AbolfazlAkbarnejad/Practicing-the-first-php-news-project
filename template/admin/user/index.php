<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Users</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="#" class="btn btn-sm btn-success disabled">create</a>
    </div>
</div>
<section class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of users</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>username</th>
                <th>email</th>
                <th>position</th>
                <th> status</th>
                <th>created at</th>
                <th>position_setting</th>
                <th>setting</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($liders as $lider) { ?>
                <tr>

                    <td><?= $lider["id"] ?></td>
                    <td><?= $lider["username"] ?></td>
                    <td><?= $lider["email"] ?></td>
                    <td><?= $lider["position"] ?></td>
                    <td><?= $lider["status"] == 1 ? "no active" : " active" ?></td>
                    <td><?= $lider["created_at"] ?></td>

                    <td>

                        <h3 class="text-end">ــــــــــــــــــــــــــــ</h3>
                    </td>
                    <td>

                        <h3 class="text-end">ـــــــــــــــ</h3>
                    </td>
                <?php } ?>

                </tr>
                <?php  ?>


                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user["id"] ?></td>
                        <td><?= $user["username"] ?></td>
                        <td><?= $user["email"] ?></td>
                        <td><?= $user["position"] ?></td>
                        <td><?= $user["status"] == 1 ? "no active" : " active" ?></td>
                        <td><?= $user["created_at"] ?></td>

                        <td>


                            <!-- session احراز هویت  -->
                            <?php // if ($check_admin["position"] == "lider") { 
                            if ($check_admin["position"] == "lider") {
                            ?>
                                <?php if ($user["position"] == "user" and $user["status"] == 2) { ?>
                                    <a role="button" class="btn btn-sm btn-success text-white" href="<?= url("admin/user/position/" . $user["id"]) ?>">click to be admin</a>
                                <?php } elseif ($user["position"] == "admin" and $user["status"] == 2) { ?>
                                    <a role="button" class="btn btn-sm btn-warning text-white" href="<?= url("admin/user/position/" . $user["id"]) ?>">click not to be admin</a>
                                <?php  } ?>

                        </td>
                        <td>
                            <!-- session احراز هویت  -->
                            <?php if ($user["position"] == "user" || $user["position"] == "admin") { ?>
                                <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url("admin/user/delete/" . $user["id"]) ?>">delete</a>
                    <?php  }
                            }
                        }
                    ?>
                        </td>
                    </tr>
                    <?php  ?>

        </tbody>
    </table>
</section>
<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>