<?php

require_once __DIR__ . '/../header.php';

$points = $_GET['points'];
?>

    <body>

    <script>
        var points = <?=$points?>;
    </script>

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
        <div id="map"></div>
        <div id="money-box">
        <span>
         After successful ride you will get <br /> <i class="fa fa-money"></i> <strong><?=$points?> pts</strong>.</span>
        </div>
        <div id="confirm-box">
            <span>After you will confirm your ride, you will be tracked by your mobile device. After successful arrive to work, you will receive the points. </span>
        </div>
        <button class="btn btn-lg btn-primary" id="confirm-btn">Confirm ride</button>
        <div id="instructions" style="display: none;"></div>
        <div id="pro-award" style="display: none;">Great! You won <?=$points?> pts.</div>
        <a href="/?action=dashboard"><button class="btn btn-lg btn-primary" id="go-to-dashboard" style="display: none;">Go to dashboard</button></a>
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