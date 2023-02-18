<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Website Setting</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url("admin/setting/set") ?>" class="btn btn-sm btn-success">set web setting</a>
    </div>
</div>
<section class="table-responsive">
    hed setting
    <table class="table table-striped table-sm" style="margin-bottom: 50px;">
        <thead>
            <tr>
                <th>name</th>
                <th>value</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>title</td>
                <td>
                    <?= $setting["title"] ?>
                </td>
            </tr>
            <tr>
                <td>description</td>
                <td>
                    <?= $setting["description"] ?>
                </td>
            </tr>
            <tr>
                <td>key_words</td>
                <td>
                    <?= $setting["key_words"] ?>
                </td>
            </tr>

            <tr>
                <td>Logo</td>
                <td><img src="<?= asset($setting["logo"]) ?>" alt="" width="100px" height="100px"></td>
            </tr>
            <tr>
                <td>Icon</td>
                <td><img src="<?= asset($setting["icon"]) ?>" alt="" width="100px" height="100px"> </td>
            </tr>
        </tbody>
    </table>

    navbar
    <table class="table table-striped table-sm" style="margin-bottom: 50px;">
        <thead>

        </thead>
        <tbody>

            <tr>
                <td>ID instagram</td>
                <td>
                    <?= $setting["link_instagram"] ?>
                </td>
            </tr>
            <tr>
                <td>ID facebook</td>
                <td>
                    <?= $setting["link_facebook"] ?>
                </td>
            </tr>
            <tr>
                <td>ID twitter</td>
                <td>
                    <?= $setting["link_twitter"] ?>
                </td>
            </tr>

        </tbody>
    </table>

    footer
    <table class="table table-striped table-sm">
        <thead>

        </thead>
        <tbody>

            <tr>
                <td>text footer</td>
                <td>
                    <?= $setting["text_footer"] ?>
                </td>
            </tr>
            <tr>
                <td>all rights</td>
                <td>
                    <?= $setting["all_rights"] ?>
                </td>
            </tr>
            <tr>
                <td>phone number</td>
                <td>
                    <?= $setting["phone_number"] == NULL ? "NULL" : $setting["phone_number"]  ?>
                </td>
            </tr>

            <tr>
                <td>office number</td>
                <td>

                    <?= $setting["office_number"] == NULL ? "NULL" : $setting["office_number"]  ?>
                </td>
            </tr>

            <tr>
                <td>E mail</td>
                <td>
                    <?= $setting["E-mail"] ?>
                </td>
            </tr>
            <tr>
                <td>Address</td>
                <td>
                    <?= $setting["Address"] ?>
                </td>
            </tr>


        </tbody>
    </table>
</section>
<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>