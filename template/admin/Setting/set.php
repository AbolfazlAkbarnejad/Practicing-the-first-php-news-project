<?php require_once  BASE_PATH ."/template/admin/layouts/heder.php" ?>

<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Set Web Setting</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("admin/setting/update") ?>" enctype="multipart/form-data">
            <div class="" style="margin-bottom: 100px;">
                hed setting

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title"  value="<?= $setting["title"] ?>" autofocus>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="<?= $setting["description"] ?>" autofocus>
                </div>

                <div class="form-group">
                    <label for="keywords">Keywords</label>
                    <br>
                    <input type="text" class="form-control" id="key_words" name="key_words" value="<?= $setting["key_words"] ?>" autofocus>
                </div>


                <div class="form-group">

                    <img style="width: 100px;" src="" alt="">
                    <hr />

                    <label for="logo">Logo</label>
                    <input type="file" id="logo" name="logo" class="form-control-file" autofocus>
                </div>

                <div class="form-group">

                    <img style="width: 100px;" src="" alt="">
                    <hr />

                    <label for="icon">Icon</label>
                    <input type="file" id="icon" name="icon" class="form-control-file" autofocus>
                </div>
            </div>
            <div class="" style="margin-bottom: 100px;">
                navbar
                <div class="form-group">
                    <label >ID instagram</label>
                    <input type="text" class="form-control" id="link_instagram" name="link_instagram" value="<?= $setting["link_instagram"] ?>" autofocus>
                </div>
                <div class="form-group">
                    <label >ID facebook</label>
                    <input type="text" class="form-control" id="link_facebook" name="link_facebook" value="<?= $setting["link_facebook"] ?>" autofocus>
                </div>
                <div class="form-group">
                    <label >ID twitter</label>
                    <input type="text" class="form-control" id="link_twitter" name="link_twitter" value="<?= $setting["link_twitter"] ?>" autofocus>
                </div>
            </div>
            <div class="" style="margin-bottom: 100px;">

                //footer

                <div class="form-group">
                    <label for="title">text footer</label>
                    <textarea class="form-control" id="text_footer" name="text_footer" rows="3"><?= $setting["text_footer"]?></textarea>
                </div>
                <div class="form-group">
                    <label for="keywords"> all rights</label>
                    <input type="text" class="form-control" id="all_rights" name="all_rights" value="<?= $setting["all_rights"]?>" autofocus>
                </div>
                <div class="form-group">
                    <label>phone_number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $setting["phone_number"]?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="title">office number</label>
                    <input type="text" class="form-control" id="office_number" name="office_number" value="<?= $setting["office_number"]?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="keywords">E mail</label>
                    <input type="text" class="form-control" id="E-mail" name="E-mail" value="<?= $setting["E-mail"] ?>" autofocus>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" value="<?= $setting["Address"] ?>" autofocus>
                </div>

            </div>



            <button type="submit" class="btn btn-primary btn-sm">set</button>
        </form>
    </section>
</section>
<?php require_once  BASE_PATH ."/template/admin/layouts/footer.php" ?>