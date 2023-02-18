<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<section class="row my-3">
    <section class="col-12">
        <?php if (!empty(flash("error_banner"))) { ?>
            <h3 class="bg-danger col-3 p-2"><?= flash("error_banner") ?></h3>
        <?php } ?>
        <form method="post" action="<?= url("admin/banner/store") ?>" enctype="multipart/form-data">
            <div class="form-group ">
                <label for="link">link</label>
                <input type="text" class="form-control" id="link" name="link" value="https://www." required autofocus>
            </div>

            <div class="form-group">
                <label for="to_office">to ...</label>
                <input type="text" class="form-control" id="to_office" name="to_office" placeholder="to ..." required autofocus>
            </div>


            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control-file" required autofocus>
            </div>

            <div class="form-group">
                <select name="Priority" id="Priority" class="form-control" required autofocus>

                    <option value="4">
                        اولویت
                    </option>

                    <option value="3">
                        اولویت دوم
                    </option>

                    <option value="2">
                        اولویت سوم

                    </option>

                    <option value="1" selected>
                        اولویت چهارم

                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="ststus">ststus</label>
                <select name="status" id="ststus" class="form-control" required autofocus>
                    <option value="1" selected>
                        فعال
                    </option>
                    <option value="2" selected>
                        غیر فعال
                    </option>
                </select>


            </div>

            <div class="form-group">
                <label for="published_at">expiry date</label>
                <input type="text" class="form-control d-none" id="expiry_date" name="expiry_date" required autofocus>
                <input type="text" class="form-control" id="expiry_date_view" required autofocus>
            </div>


            <button type="submit" class="btn btn-primary btn-sm">store</button>
        </form>
    </section>
</section>

<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>
