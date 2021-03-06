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
        <form autocomplete="off" role="presentation" class="needs-validation" id="form-register" method="post" action="/api/user/register" novalidate>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input name="first_name" type="text" autocomplete="off" class="form-control" id="firstName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input name="last_name" type="text" autocomplete="off" class="form-control" id="lastName" placeholder="" value="" required>
                    <div class="invalid-feedback">
                        Valid last name is required.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="email">Email </label>
                <input name="email" type="email" autocomplete="off" class="form-control" id="email" placeholder="you@example.com">
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input name="password" type="password" autocomplete="off" id="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <label for="address">Home Address</label>
                <input name="home_address" type="text" autocomplete="off" class="form-control" id="user_input_autocomplete_address_home" placeholder="1234 Main St" required>
            </div>

            <div class="mb-3">
                <label for="address">Work Address</label>
                <input name="work_address" type="text" autocomplete="off" class="form-control" id="user_input_autocomplete_address_work" placeholder="1234 Main St" required>
            </div>

            <div class="row">
                <div class="col-md-2 mb-3">
                    <input type="checkbox" name="car_have" id="car_have" value="1" /> Do you have a car?
                </div>
                <div class="col-md-10">
                    <input name="car_places" type="text" autocomplete="off" class="form-control" id="" placeholder="How many places do you have in the car?" required>
                </div>
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