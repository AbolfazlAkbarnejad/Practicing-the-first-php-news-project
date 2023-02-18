<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Note</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/note/create") ?>" class="btn btn-sm <?= $check_Limitation["COUNT(*)"] >= 7 ? '' : 'btn-success' ?>" style="<?=  $check_Limitation["COUNT(*)"] >=7 ?' pointer-events: none':"" ?>;background-color: #00c8518f;color: white;">create</a>
        <?= flash("error_btn_create") ?>
    </div>
</div>
<div class="table-responsive">

    <table class="table table-striped table-sm">
        <caption>List of likes</caption>
        <thead>


            <tr>
                <th>#</th>
                <th>name</th>
                <th>Number</th>
                <th>position</th>
                <th>status</th>
                <th>setting</th>
            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($likes as $like) { ?>
                <tr>
                    <td>
                        <?= $like["id"] ?>
                    </td>
                    <td>
                        <?= $like["text"] ?>
                    </td>
                    <td>
                        <?= $like["like"] ?>
                    </td>
                    <td>
                        <?= $like["status"] ?>
                    </td>
                    <td>



                        <?php if ($check_Limitation["COUNT(*)"] <= 6 AND $like["status"] == "desable") { ?>
                            <a role="button" href="<?= url("admin/note_enable/" . $like["id"]) ?>" class="btn btn-sm btn-info my-0 mx-1 text-white">enable</a>
                        <?php } elseif($like["status"] == "enable") { ?>
                            <a role="button" href="<?= url("admin/note_desable/" . $like["id"]) ?>" class="btn btn-sm btn-danger my-0 mx-1 text-white">desable</a>
                        <?php  } ?>

                        


                    </td>

                    <td>
                        <a role="button" href="<?= url('admin/note/edit/' . $like["id"]) ?>" class="btn btn-sm btn-info my-0 mx-1 text-white">edit</a>
                        <a role="button" href="<?= url("admin/delete/") . "/" . $like["id"] ?>" class="btn btn-sm btn-danger my-0 mx-1 text-white">delete</a>
                    </td>

                </tr>
            <?php }
            ?>
        </tbody>

    </table>
</div>

<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>