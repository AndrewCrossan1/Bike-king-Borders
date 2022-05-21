<?php
    session_start();
    //Page Description: Allows the admin to view each account, also delete if needs be

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageTitle = "Gallery";

    require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'functions.php');
    ?>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">View images taken by our specialist photographer <span class="fst-italic">Andrew Crossan!</span></p>
        </div>
    </div>
</section>
<?php
//Send message if it is set
if (isset($_GET['message'])) {
    functions::SendMessage(base64_decode($_GET['message']));
}
?>

<div class="container-md mt-5 rounded mb-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/Media/Images/Carousel/dirt-road-3442651_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="ForestTrail" class="d-block w-100 img-fluid" alt="Forest Trail">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bike King Borders Forest Trail</h5>
                    <p>This trail tests riders instincts to the maximum, with twisty bends and narrow ledges,<br/>this is made for the bravest bikers!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/Media/Images/Carousel/forest-path-4829591_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="WoodStroll" class="d-block w-100 img-fluid" alt="Woods Stroll">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A stroll through the woods</h5>
                    <p>This trail is for beginner-intermediate riders, with a few tight turns<br>and minimal jumps.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/Media/Images/Carousel/mountain-2560534_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="DeadlyDrop" class="d-block w-100 img-fluid" alt="Deadly Drop">
                <div class="carousel-caption d-none d-md-block">
                    <h5>The deadly drop</h5>
                    <p>This trail is primarily downhill, perfect for those who know their bike and - <br>love a speed thrill.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/Media/Images/Carousel/trail-6404418_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="NaturalNice" class="d-block w-100 img-fluid" alt="Natural 'n Nice">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nice 'n natural</h5>
                    <p>This trail was created with the avid cyclist in mind, someone who is looking for peace<br>and tranquility as they cycle, perfect for any experience level.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/Media/Images/Carousel/gravel-698615_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="SandyStroll", class="d-block w-100 img-fluid" alt="Sandy Stroll">
                <div class="carousel-caption d-none d-md-block">
                    <h5>A stroll by the banks</h5>
                    <p>This trail is made for the cyclist who is looking for a great view, whilst they challenge<br>their ability with different and tough terrain</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="/Media/Images/Carousel/mountain-bike-4297972_1920.jpg" onclick="SetClickedPhotoURL(this.src, this.id)" id="MountainBike" class="d-block w-100 img-fluid" alt="Mountain Bike">
                <div class="carousel-caption d-none d-md-block">
                    <h5>An expert rider</h5>
                    <p>Here is a photograph of one of our sponsored riders, Clifford, the Big Red Dog.<br>He has been cycling for years and recently we have decided to sponsor him.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


<?php
    include('Scripts/footer.php');
?>
