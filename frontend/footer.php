<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/esm/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true&libraries=places&key=AIzaSyD_k3nyu4lTraCWMIoK0FFd3yRH_o2_Ovc"></script>
<script type="text/javascript" src="/media/js/gmaps.js"></script>
<script src="/media/js/bootstrap.min.js"></script>
<script src="/media/js/apiClient.js?<?= time() ?>"></script>

<script>
    var map;
    var homeLat;
    var homeLong;
    var workLat;
    var workLong;

    $(document).ready(function(){
        var userData = JSON.parse(window.localStorage.getItem('userData'));

        if (window.location.href.includes('dashboard')) {
            $("#name").html(userData.first_name + ' ' + userData.last_name);

            $.ajax({
                type: 'GET',
                url: document.api_url + 'api/user/points/' + userData.id,
                cache: false,
                dataType: "json",
                contentType: "application/json"
            })
            .done(function(result) {
                $("#points").html(result.points + ' points');
                $("#pointsHeader").html(result.points);
                localStorage.setItem('points', result.points);
            });

            $.ajax({
                type: 'GET',
                url: document.api_url + 'api/user/address/' + userData.id,
                cache: false,
                dataType: "json",
                contentType: "application/json"
            })
            .done(function(result) {
                $("#homeAddress").html(result.home_address);
                $("#workAddress").html(result.work_address);
                
                localStorage.setItem('userAddress', JSON.stringify(result));
            });

            $("#velohModal").on('shown.bs.modal', function(){

                $.ajax({
                    type: 'GET',
                    url: document.api_url + 'api/user/bikepoints/around/home/' + userData.id,
                    cache: false,
                    dataType: "json",
                    contentType: "application/json"
                })
                .fail(function(result) {
                    alert('Invalid response from API.');
                })
                .done(function(result) {
                    var userAddress = JSON.parse(window.localStorage.getItem('userAddress'));

                    map = new GMaps({
                        div: '#map',
                        lat: userAddress.home_geo_lat,
                        lng: userAddress.home_geo_long
                    });

                    $.each(result.features, function( index, value ) {
                        console.log(value.geometry.coordinates);
                        map.addMarker({
                            lat: value.geometry.coordinates[1],
                            lng: value.geometry.coordinates[0],
                            title: 'Velo station',
                            click: function(e) {
                                window.location.href = '/?action=ride&token=' + window.btoa('{"points": 7, "lat": "' + value.geometry.coordinates[1] + '", "lng": "' + value.geometry.coordinates[0] + '", "jackpot": true}')
                            }
                        });
                    });
                });
            });
        }

        if (window.location.href.includes('register')) {
            function initializeAutocompleteHome(id) {
                var element = document.getElementById(id);
                if (element) {
                    var autocomplete = new google.maps.places.Autocomplete(element);
                    google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChangedHome);
                }
            }

            function initializeAutocompleteWork(id) {
                var element = document.getElementById(id);
                if (element) {
                    var autocomplete = new google.maps.places.Autocomplete(element);
                    google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChangedWork);
                }
            }

            function onPlaceChangedHome() {
                var place = this.getPlace();

                homeLat = place.geometry.location.lat();
                homeLong = place.geometry.location.lng();
            }

            function onPlaceChangedWork() {
                var place = this.getPlace();

                workLat = place.geometry.location.lat();
                workLong = place.geometry.location.lng();
            }

            google.maps.event.addDomListener(window, 'load', function() {
                initializeAutocompleteHome('user_input_autocomplete_address_home');
                initializeAutocompleteWork('user_input_autocomplete_address_work');
            });
        }

        if (window.location.href.includes('ride')) {
            var addressData = JSON.parse(window.localStorage.getItem('userAddress'));

            $.ajax({
                type: 'GET',
                url: document.api_url + 'api/user/points/' + userData.id,
                cache: false,
                dataType: "json",
                contentType: "application/json"
            })
                .done(function(result) {
                    $("#points").html(result.points + ' points');
                    $("#pointsHeader").html(result.points);
                    localStorage.setItem('points', result.points);
                });
            
            map = new GMaps({
                div: '#map',
                lat: -12.043333,
                lng: -77.028333
            });

            if (lat === null) {
                lat = addressData.home_geo_lat;
                lng = addressData.home_geo_long;
            }

            map.travelRoute({
                origin: [lat, lng],
                destination: [addressData.work_geo_lat, addressData.work_geo_long],
                travelMode: 'biking',
                step: function(e){
                    map.setCenter(e.end_location.lat(), e.end_location.lng());
                    map.drawPolyline({
                        path: e.path,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.6,
                        strokeWeight: 6
                    });
                }
            });
            $('#confirm-btn').click(function(e){
                e.preventDefault();

                if (lat === null) {
                    lat = addressData.home_geo_lat;
                    lng = addressData.home_geo_long;
                }

                map.travelRoute({
                    origin: [lat, lng],
                    destination: [addressData.work_geo_lat, addressData.work_geo_long],
                    travelMode: 'biking',
                    step: function(e){
                        var isFinished = e.instructions.includes('Destination');

                        $("#confirm-box").html('We are tracking you now... Please finish your ride.');
                        $("#confirm-btn").fadeOut('slow');
                        $('#instructions').append('<li>'+e.instructions+'</li>');
                        $('#instructions li:eq('+e.step_number+')').delay(500*e.step_number).fadeIn(200, function(){
                            if (isFinished) {
                                $("#money-box").fadeOut('slow');
                                $("#confirm-box").fadeOut('slow');
                                $('#pro-award').show();
                                $('#pro-award').removeClass().addClass('bounce animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                                    $(this).removeClass();
                                    $(this).addClass('animated flash');
                                });
                                $('#go-to-dashboard').fadeIn('slow');
                                setPoints(parseInt(window.localStorage.getItem('points')) + points);
                            }

                            map.setCenter(e.end_location.lat(), e.end_location.lng());
                            map.drawPolyline({
                                path: e.path,
                                strokeColor: '#FF0000',
                                strokeOpacity: 0.6,
                                strokeWeight: 6
                            });
                        });
                    }
                });
            });
            setTimeout(function(){$("#map").css('height', document.body.clientHeight - 150)}, 500);
        }

    });
</script>

</body>
</html>