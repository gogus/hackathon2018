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
                <span class="text-right" style="color: #fff;">Your points: <span id="pointsHeader">n/a</span></span>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h2><i class="fa fa-user"></i></h2><h1 class="jumbotron-heading" id="name">Loading...</h1>
                <p class="lead text-muted" id="points">n/a points</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Redeem points</a>
                    <a href="#" id="btn-logout" class="btn btn-outline-dark my-2">Logout</a>
                </p>
                <small class="text-muted">Your home address: <span id="homeAddress">Loading...</span></small><br />
                <small class="text-muted">Your work address: <span id="workAddress">Loading...</span></small> <br />
                <br />
                <h5><i class="fa fa-star"></i> Congratulations! You are trending on #5 position in this week.</h5>
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
                                        <a href="/?action=ride&points=5"><button type="button" class="btn btn-sm btn-primary">#GoToWork</button></a>
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
                                        <a href="/?action=ride&points=2"><button type="button" class="btn btn-sm btn-primary">#GoToWork</button></a>
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