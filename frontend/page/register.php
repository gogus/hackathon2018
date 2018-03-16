<?php

require_once __DIR__ . '/../header.php';

?>

    <body class="bg-light">

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="/media/img/work.svg" alt="" width="72" height="72">
            <h2>Register</h2>
        </div>

        <h4 class="mb-3">Details</h4>
        <form class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email </label>
                <input type="email" class="form-control" id="email" placeholder="you@example.com">
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <label for="address">Home Address</label>
                <input type="text" class="form-control" id="home-address" placeholder="1234 Main St" required>
            </div>

            <div class="mb-3">
                <label for="address">Work Address</label>
                <input type="text" class="form-control" id="work-address" placeholder="1234 Main St" required>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
        </form>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2018 Whatever</p>
        </footer>
    </div>

<?php

require_once __DIR__ . '/../footer.php';

?>