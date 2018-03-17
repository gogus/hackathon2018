<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/esm/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/media/js/gmaps.js"></script>
<script src="/media/js/bootstrap.min.js"></script>
<script src="/media/js/apiClient.js"></script>

<script>
    var map;
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
            map.travelRoute({
                origin: [addressData.home_geo_lat, addressData.home_geo_long],
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

                map.travelRoute({
                    origin: [addressData.home_geo_lat, addressData.home_geo_long],
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