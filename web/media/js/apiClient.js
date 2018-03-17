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

$('#btn-logout').on('click', function (e) {
    localStorage.removeItem('userData');
    window.location.href = '/';
});