var userData = JSON.parse(window.localStorage.getItem('userData'));

function setPoints(points) {
    $.ajax({
        type: 'POST',
        url: document.api_url + 'api/user/points/' + userData.id,
        cache: false,
        data: JSON.stringify({ points: points}),
        dataType: "json",
        contentType: "application/json"
    });

    $("#pointsHeader").html(points);
}

$('.form-signin').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: document.api_url + 'api/user/auth',
        cache: false,
        data: JSON.stringify({ email: $("#inputEmail").val(), password: $("#inputPassword").val()}),
        dataType: "json",
        contentType: "application/json"
    })
    .fail(function(result) {
        alert('Invalid login/pass.');
    })
    .done(function(result) {
        localStorage.setItem('userData', JSON.stringify(result));
        window.location.href = '/?action=dashboard';
    });
});

$("#form-register").on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: document.api_url + 'api/user/register',
        cache: false,
        data: JSON.stringify(
            {
                first_name: $("#firstName").val(),
                last_name: $("#lastName").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                home_address: $("#user_input_autocomplete_address_home").val(),
                work_address: $("#user_input_autocomplete_address_work").val(),
                home_geo_lat: homeLat,
                home_geo_long: homeLong,
                work_geo_long: workLong,
                work_geo_lat: workLat,
                have_car: $("#car_have").is(':checked'),
                available_seats: $("#car_places").val(),
            }
        ),
        dataType: "json",
        contentType: "application/json"
    })
    .fail(function(result) {
        alert('Invalid data, try again.');
    })
    .done(function(result) {
        localStorage.setItem('userData', JSON.stringify(result));
        window.location.href = '/?action=dashboard';
    });
});

$('#btn-logout').on('click', function (e) {
    localStorage.removeItem('userData');
    window.location.href = '/';
});