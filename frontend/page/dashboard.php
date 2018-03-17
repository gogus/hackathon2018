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
                <span class="text-right" style="color: #fff;">Your points: <i class="fa fa-money"></i> <span id="pointsHeader">n/a</span></span>
            </div>
        </div>
    </header>

    <main role="main">

        <section class="jumbotron text-center">
            <div class="container">
                <h2><i class="fa fa-user"></i></h2><h1 class="jumbotron-heading" id="name">Loading...</h1>
                <h2> <span class="badge badge-secondary" style="background-color:green;"><i class="fa fa-graduation-cap"></i> Beginner</span></h2>
                <p class="lead text-muted" id="points">n/a points</p>
                <p>
                    <a href="#" class="btn btn-primary my-2"><i class="fa fa-shopping-cart"></i> Redeem points</a>
                    <a href="#" class="btn badge-secondary my-2"><i class="fa fa-users"></i> Invite your friends</a>
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
                                        <a href="/?action=ride&token=<?=base64_encode(json_encode(['points' => 5, 'jackpot' => false]));?>"><button type="button" class="btn btn-sm btn-primary">#GoToWork</button></a> &nbsp;
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" class="velohBtn" data-target="#velohModal">Use Veloh</button>
                                    </div>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> 9 mins &nbsp;&nbsp;<i class="fa fa-money"></i> 5 pts</small>
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
                                        <a href="/?action=ride&token=<?=base64_encode(json_encode(['points' => 1, 'jackpot' => false]));?>"><button type="button" class="btn btn-sm btn-primary">#GoToWork</button></a>
                                        <button type="button" class="btn btn-sm btn-success" style="margin-left: 5px;">Share ride</button>
                                    </div>
                                    <small class="text-muted"><i class="fa fa-clock-o"></i> 20 mins &nbsp;&nbsp;<i class="fa fa-money"></i> 1 pts</small>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>
    <div class="modal fade" id="velohModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose veloh station</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="animated flash" style="color: blueviolet;"><i class="fa fa-star"></i> Jackpot unlocked! Use veloh instead of your bike. 2 more points for your ride!</h5>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
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