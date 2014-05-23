

    <script src="<?php echo asset_url('js/flatui-fileinput.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.ui.touch-punch.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap-switch.js'); ?>"></script>
    <script src="<?php echo asset_url('js/flatui-checkbox.js'); ?>"></script>
    <script src="<?php echo asset_url('js/flatui-radio.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.tagsinput.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.placeholder.js'); ?>"></script>
    <script src="<?php echo asset_url('js/holder.js'); ?>"></script>
    <script src="<?php echo asset_url('js/application.js'); ?>"></script>

    <script type="text/javascript">
        $("#datepicker-01").datepicker().datepicker('setDate',new Date());
    </script>

    <script type="text/javascript">
    $(document).ready(function () {
        $('#assignCompany').change(function () {

            var company = $(this).val();
            $.ajax({
                url: "contactperson",
                async: false,
                type: "POST",
                data: "company_id="+company,
                dataType: "html",

                success: function(data) {
                    alert(data);
                    // data: project/contact_person methodun bize dondugu user arrayi olacak.
                    // burada dinamik olarak multiple select olusturulacak. 
                    // aklima takilan: eger contact person sectikten sonra , company assign listesinden remove edilirse ne yapacagiz?
                }
            })

        });
    });
</script>




    </body>
</html>