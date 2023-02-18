<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<section class="row my-3">
    <section class="col-12">
        <?php if (!empty(flash("updateBanner_error"))) { ?>
            <h3 class="bg-danger col-3 p-2"><?= flash("updateBanner_error") ?></h3>
        <?php } ?>
        <form method="post" action="<?= url("admin/banner/update/" . $banners["id"]) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="link">link</label>
                <input type="text" class="form-control" id="link" name="link" value="<?= $banners["link"] ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="to_office">to ...</label>
                <input type="text" class="form-control" id="to_office" name="to_office" value="<?= $banners["to_office"] ?>" required autofocus>
            </div>


            <div class="form-group">
                <label for="image">Image</label>
                <br>
                <input type="file" id="image" name="image" class="" >
            </div>
            <div class="form-group">
                <img src="<?= asset($banners["image"]) ?>" style="width: 320px; height: 170px;" alt="">

            </div>

            <div class="form-group">
                <select name="Priority" id="Priority" class="form-control" required autofocus>

                    <option value="4" <?= $banners["Priority"] == 4 ?"selected" :"" ?>>
                        اولویت
                    </option>

                    <option value="3" <?= $banners["Priority"] == 3 ?"selected" :"" ?>>
                        اولویت دوم
                    </option>

                    <option value="2" <?= $banners["Priority"] == 2 ?"selected" :"" ?>>
                        اولویت سوم

                    </option>

                    <option value="1" <?= $banners["Priority"] == 1 ?"selected" :"" ?>>
                        اولویت چهارم

                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="ststus">ststus</label>
                <select name="status" id="ststus" class="form-control" required autofocus>
                    <option value="1" <?= $banners["status"] =="anable" ?"selected" :"" ?>>
                        فعال
                    </option>
                    <option value="2" <?= $banners["status"] =="desable" ?"selected" :"" ?>>
                        غیر فعال
                    </option>
                </select>


            </div>

            <div class="form-group">
                <label for="published_at">expiry date</label>
                <input type="text" class="form-control d-none" id="expiry_date" name="expiry_date" required autofocus>
                <input type="text" class="form-control" id="expiry_date_view" value="<?= $banners["expiry_date"] ?>" required autofocus>
            </div>


            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>
    </section>
</section>

<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>
