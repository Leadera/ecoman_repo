    <div class="bottom-menu  " style="margin-top:80px;">
      <div class="container">
        <div class="row">
          <div class="col-md-2 ">
            Ecoman
          </div>

          <div class="col-md-8">
            <ul class="bottom-links">
              <li><a href="#fakelink">About Us</a></li>
              <li><a href="#fakelink">Store</a></li>
              <li class="active"><a href="#fakelink">Jobs</a></li>
              <li><a href="#fakelink">Privacy</a></li>
              <li><a href="#fakelink">Terms</a></li>
              <li><a href="#fakelink">Follow Us</a></li>
              <li><a href="#fakelink">Support</a></li>
              <li><a href="#fakelink">Links</a></li>
            </ul>
          </div>

          <div class="col-md-2">
            <ul class="bottom-icons">
              <li><a href="#fakelink" class="fui-pinterest"></a></li>
              <li><a href="#fakelink" class="fui-facebook"></a></li>
              <li><a href="#fakelink" class="fui-twitter"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo asset_url('js/flatui-fileinput.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery-ui-1.10.3.custom.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.ui.touch-punch.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery-ui-1.10.4.custom.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap-select.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap-switch.js'); ?>"></script>
    <script src="<?php echo asset_url('js/flatui-checkbox.js'); ?>"></script>
    <script src="<?php echo asset_url('js/flatui-radio.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.tagsinput.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.placeholder.js'); ?>"></script>
    <script src="<?php echo asset_url('js/holder.js'); ?>"></script>
    <script src="<?php echo asset_url('js/application.js'); ?>"></script>
    <script src="<?php echo asset_url('js/jquery.autocomplete.multiselect.js'); ?>"></script>

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

    <!-- AutoComplete trigger JS Code -->
    <script type="text/javascript">
    $(function(){
      $("#companySearch").autocomplete({
        source: "companySearch", // path to the company_search method
        multiselect: true
      });
    });
    </script>


    </body>
</html>