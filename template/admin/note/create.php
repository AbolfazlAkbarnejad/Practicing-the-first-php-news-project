<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Create Note</h1>
</section>
<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("admin/note/store") ?>">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="text" name="text" placeholder="Enter noth ...">
            </div>

            <div class="form-group">
                <label for="cat_id">status</label>
                <select name="status" id="status" class="form-control" required autofocus>


                    <option value="1">
                        فعال
                    </option>
                    <option value="2">
                        غیر فعال
                    </option>


                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">store</button>
        </form>
    </section>

    <?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>