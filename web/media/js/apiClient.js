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
        localStorage.setItem('hackathonId', result.id);
        window.location.href = '/?action=dashboard';
    });
});
