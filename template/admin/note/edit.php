<?php require_once  BASE_PATH . "/template/admin/layouts/heder.php" ?>


<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit NOte</h1>
</section>

<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?= url("admin/note/update/" . $note["id"]) ?>">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="text" name="text" value="<?= $note["text"] ?>">
                <!--            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                <select name="status" id="status" class="form-control" required autofocus>

                    <option value="1" <?= $note["status"] == 'enable' ? 'selected' : "" ?>>
                        فعال
                    </option>
                    <option value="2" <?= $note["status"] == 'desable' ? 'selected' : "" ?>>
                        غیر فعال
                    </option>
                </select>

            </div>
            <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>
    </section>
</section>
<?php require_once  BASE_PATH . "/template/admin/layouts/footer.php" ?>