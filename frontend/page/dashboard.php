<?php

require_once __DIR__ . '/../header.php';

?>

    <body>

    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">

            </div>
        </div>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <strong>#GoToWork</strong>
                </a>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Mikolaj Gogula</h1>
                <p class="lead text-muted">5 points</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Redeem points</a>
                    <a href="#" class="btn btn-outline-dark my-2">Logout</a>
                </p>
                <small class="text-muted">Your home address: 29 Rue Nicolas Liez, 1938 Luxembourg</small><br />
                <small class="text-muted">Your work address: 44 Your Work Rue, 1938 Luxembourg</small>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">
                <h3 class="text-center" style="margin-bottom: 40px;">Your possibilities for #GoToWork: </h3>
                <div class="row">


                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Go by bike! You are so good boy! Gather the points and redeem the points.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary">#GoToWork</button>
                                    </div>
                                    <small class="text-muted">9 mins &nbsp;&nbsp; 5 pts</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&bg=55595c&fg=eceeef&text=Thumbnail" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">Go by car if you must! But remember that you are so lazy! Gather the points and redeem the points.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary">#GoToWork</button>
                                        <button type="button" class="btn btn-sm btn-primary" style="margin-left: 5px;">Share ride</button>
                                    </div>
                                    <small class="text-muted">20 mins &nbsp;&nbsp; 2 pts</small>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p> &copy; Whatever 2018</p>
        </div>
    </footer>

<?php

require_once __DIR__ . '/../footer.php';

?>