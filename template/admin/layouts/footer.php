</main>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="<?= asset("public/admin_panel/js/bootstrap.min.js") ?>"></script>
<script src="<?= asset("public/admin_panel/js/mdb.min.js") ?>"></script>
<script src="<?= asset("public/admin_panel/ckeditor/ckeditor.js") ?>"></script>
<script src="<?= asset("public/jalalidatepicker/persian-date.min.js") ?>"></script>
<script src="<?= asset("public/jalalidatepicker/persian-datepicker.min.js") ?>"></script>
<script>
    $(document).ready(function() {
        CKEDITOR.replace("summary"); //id filts
        CKEDITOR.replace("body");
        CKEDITOR.replace("text_footer");



        $("#expiry_date_view").persianDatepicker({
            format: "YY_MM_DD HH:mm:ss",
            toolbox:{
                calendarSwitch:{
                    enable:true
                }
              
            },
            observer :true,
                altField: "#expiry_date"   // id fil to send the database
        })

    });
</script>
</body>

</html>