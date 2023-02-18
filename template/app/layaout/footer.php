<?php

use database\database;

$db = new database;
$showSetting = $db->select("SELECT * FROM setting")->fetch(); ?>

<div class="footer">
    <div class="container-fluid">
        <div class="col-md-5">
            <div class="footer-box">
                <span class="title">مجله seo90</span>
                <?= $showSetting["text_footer"] ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="footer-box">
                <span class="title">دسترسی سریع</span>
                <ul>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">قوانین</a></li>
                    <li><a href="#">نشریات</a></li>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">خبرنامه</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="footer-box">
                <span class="title">موضوعی</span>
                <ul>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">قوانین</a></li>
                    <li><a href="#">نشریات</a></li>
                    <li><a href="#">موضوعی</a></li>
                    <li><a href="#">خبرنامه</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <div class="footer-box contact-box">
                <span class="title">تماس با ما</span>
                <p><i class="fa fa-phone"></i> <?= $showSetting["office_number"] ?></p>
                <p><i class="fa fa-phone"></i> <?= $showSetting["phone_number"] ?></p>

                <p><i class="fa fa-envelope-o"></i> <?= $showSetting["E-mail"] ?></p>

                <p><i class="fa fa-map-marker"></i> <?= $showSetting["Address"] ?></p>
            </div>
        </div>
        <div class="clear-fix"></div>
    </div>
</div>
<div class="end-wrapper">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="copy-r">
                <p>&copy; تمامی حقوق متعلق به <?= $showSetting["all_rights"] ?> می باشد</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="creator text-left">
                <p>طراحی سایت ، سئو 90</p>
            </div>
        </div>
    </div>
</div>
<div class="bg"></div>
<script src="<?= asset("public/home/js/jquery.js ") ?>"></script>
<script src=" <?= asset("public/home/js/bootstrap.js ") ?>"></script>
<script src=" <?= asset("public/home/js/owl.carousel.min.js ") ?>"></script>
<script src=" <?= asset("public/home/js/index.js") ?>"></script>
</body>

</html>