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

//Require the header of the page (Includes Navigation, meta-data, etc.)
require($_SERVER['DOCUMENT_ROOT'] . "/" . "settings.php");
?>
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Welcome to Bike King Borders.</p>
        </div>
    </div>
</section>
<div class="container-fluid p-2" style="background-image: url('/Media/Images/mountains-1412683.png'); background-size: cover;">
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
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-4 col-6 mb-2 text-center">
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
            <div class="col-md-4 col-6 mb-2 text-center">
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
            <div class="col-md-4 col-6 mb-2 text-center">
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
        <div class="row" style="margin-top: 10%;">
            <div class="col-md-12">
                <div class="card border-dark p-2">
                    <div class="card border">
                        <div class="card-header text-center">
                            <h3>Commendations</h3>
                        </div>
                        <div class="card-body text">
                            <div class="row">
                                <div class="col-md-3 col-12 mb-3">
                                    <div class="card border">
                                        <div class="card-header text-center">
                                            'Incredible Service'
                                        </div>
                                        <div class="card-body text">
                                            <div class="card-header text-center">
                                                By GlasgowTimes
                                            </div>
                                            <div class="card-body text-center">
                                                'Easily one of the best companies we have interviewed, nothing but positivity and great help from the staff at Bike King Borders.
                                                Some of our writers are riding their bikes now! 10/10'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <div class="card border">
                                        <div class="card-header text-center">
                                            'Humble but classy'
                                        </div>
                                        <div class="card-body text">
                                            <div class="card-header text-center">
                                                By Sir Chris Hoy
                                            </div>
                                            <div class="card-body text-center">
                                                'I've dealt with many bike companies during my time, but none quite like BKB. From the services they offer to the staff they employee
                                                they are nothing but classy. Would recommend any day of the week'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <div class="card border">
                                        <div class="card-header text-center">
                                            'Incredible Service'
                                        </div>
                                        <div class="card-body text">
                                            <div class="card-header text-center">
                                                By GoCycle
                                            </div>
                                            <div class="card-body text-center">
                                                'A company to be reckoned with. A true display of human decency and etiquette, every employee knows their role and delivers the upmost
                                                advice on purchases, being a bike distributor, that is imperative.'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12 mb-3">
                                    <div class="card border">
                                        <div class="card-header text-center">
                                            'Incredible Service'
                                        </div>
                                        <div class="card-body text">
                                            <div class="card-header text-center">
                                                By Microbike
                                            </div>
                                            <div class="card-body text-center">
                                                pkmgkomasfgkomag
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10%; margin-bottom: 5%;">
            <div class="col-md-12">
                <div class="card border-dark p-2">
                    <div class="card border">
                        <div class="card-header text-center">
                            <h3>Images you have viewed</h3>
                        </div>
                        <div class="card-body text">
                            <div class="row" id="imagerow">
                                <script>
                                    //Get saved images
                                    let viewedimgs = JSON.parse(window.localStorage.getItem("images"));
                                    //Check if no images are saved
                                    if (viewedimgs == null) {
                                        //Display sad face message
                                        $('#imagerow').append(
                                            `<div class="col-md-12 col-12 mb-3 text-center">
                                                    <div class="card border">
                                                        <div class="card-header text-center">
                                                            <h5>You have not viewed any images!</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            `
                                        );
                                    } else {
                                        //Display card for each image
                                        viewedimgs.forEach(function (image) {
                                            $('#imagerow').append(
                                                `<div class="col-md-4 col-12 mb-3">
                                                    <div class="card border">
                                                        <div class="card-header text-center">
                                                            <h5>${image[0]}</h5>
                                                        </div>
                                                        <div class="card-body text-center">
                                                            <img src="${image[1]}" class="img-fluid" alt="${image[0]}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                                            );
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('Scripts/footer.php');
?>

