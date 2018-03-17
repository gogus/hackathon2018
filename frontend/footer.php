<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/esm/popper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="/media/js/gmaps.js"></script>
<script src="/media/js/bootstrap.min.js"></script>
 
<script>
    var map;
    $(document).ready(function(){
        map = new GMaps({
            div: '#map',
            lat: -12.043333,
            lng: -77.028333
        });
        map.travelRoute({
            origin: [-12.044012922866312, -77.02470665341184],
            destination: [-12.090814532191756, -77.02271108990476],
            travelMode: 'driving',
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
                origin: [-12.044012922866312, -77.02470665341184],
                destination: [-12.090814532191756, -77.02271108990476],
                travelMode: 'driving',
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
    });
</script>

</body>
</html>