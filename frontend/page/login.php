<?php

require_once __DIR__ . '/../header.php';

?>

    <body class="text-center page-signin">
    <form class="form-signin" action="/api/user/auth" method="POST">
        <img class="mb-4" src="/media/img/work.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <button class="btn btn-lg btn-primary btn-block" style="margin-top: 10px;" onclick="window.location.href = '/?action=register'">Register</button>
        <h5></h5>
        <p class="mt-5 mb-3 text-muted">&copy; Whatever 2018</p>
    </form>

<?php

require_once __DIR__ . '/../footer.php';

?>