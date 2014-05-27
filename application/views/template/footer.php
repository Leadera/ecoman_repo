

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
            var marker;
            var lat,lon;
        $("#datepicker-01").datepicker().datepicker('setDate',new Date());
        $('#myModal').on('shown.bs.modal', function (e) { 
            google.maps.event.trigger(map, 'resize'); // modal acildiktan sonra haritanın resize edilmesi gerekiyor.

            map.setZoom(15);
            if(!marker)
                map.setCenter(new google.maps.LatLng(39.9738971871888, 32.745467126369476));
            else
                map.setCenter(marker.getPosition());

            google.maps.event.addListener(map, 'click', function(event) {
                $("#latId").val("Lat:" + event.latLng.lat()); $("#longId").val("Long:" + event.latLng.lng()); 
                $("#lat").val(event.latLng.lat()); $("#long").val(event.latLng.lng());
                placeMarker(event.latLng);
            });

        });



        function placeMarker(location) {
          if ( marker ) {
            marker.setPosition(location);
          } else {
            marker = new google.maps.Marker({
              position: location,
              map: map
            });
          }
        }

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
                dataType: "json",

                success: function(data) {
                    // gelen data array'i : database'den cekilen companylerin user'ları. 
                    $('#assignContactPerson option:not(:selected)').remove();
                    for (var k = 0; k < data.length; k++) { 

                        for (var i = 0; i < data[k].length; i++) { 
                            var opt =data[k][i]['id'];
                            if($("#assignContactPerson option[value='"+ opt +"']").length == 0)
                            {
                               $("#assignContactPerson").append(new Option(data[k][i]['name']+' '+data[k][i]['surname']+' - '+data[k][i]['cmpny_name'],data[k][i]['id']));
                            
                            }else{
                               
                            }
                        }
                    }                        
                    // aklima takilan: eger contact person sectikten sonra , company assign listesinden remove edilirse ne yapacagiz?
                    //cevap: remove edilen company'nin user'ları da remove edilecek.sistem şuan bu şekilde çalışmıyor. 
                    //company id'si ile kontrol yapılabilir.
                }
            })

        });
    });
</script>




    </body>
</html>