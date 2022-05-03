<?php
    session_start();
    //Author: Andrew Crossan
    //Project Name: Bike King Borders
    //Description: A website for a small bike selling company in the borders of scotland
    //College Year: Year 2

    //Page Description: The home page of the website!

    //Disclaimer:
    //I like leaving whitespace for more readable code so enjoy some satisfyingly well put together PHP.
    //End of disclaimer

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Home";

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Index";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require($_SERVER['DOCUMENT_ROOT'] . "/Scripts/" . "functions.php");
?>
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Welcome to Bike King Borders.</p>
        </div>
    </div>
</section>

<?php
//Send message if it is set
if (isset($_GET['message'])) {
    functions::SendMessage(base64_decode($_GET['message']));
}
?>
<script>
    SetCookies();
</script>
<div class="container-md">
    <div class="row mt-5">
        <div class="col-12 text-center" style="font-family: Ubuntu, Verdana,serif">
            <h1 class="display-3">Bike King Borders</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-4 text-center">
            <div class="card border-dark p-2">
                <div class="card border">
                    <div class="card-header"><h2 class="display-6">Who are we?</h2></div>
                    <div class="card-body">
                        <h5 class="card-title">Bike King Borders</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                            ahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card border-dark p-2">
                <div class="card border">
                    <div class="card-header"><h2 class="display-6">Why us?</h2></div>
                    <div class="card-body text">
                        <h5 class="card-title">Quality Servicing and Hires</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                            ahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="card border-dark p-2">
                <div class="card border">
                    <div class="card-header"><h2 class="display-6">Our Guarantee</h2></div>
                    <div class="card-body text">
                        <h5 class="card-title">Giving Back</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                            ahhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('Scripts/footer.php');
?>

