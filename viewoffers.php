<?php
session_start();
//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Offers";

if (!isset($_SESSION['Username'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/account/login/';
        });
    </script>
    <?php
}

//Require the header of the page (Includes Navigation, meta-data, etc.)
require($_SERVER['DOCUMENT_ROOT'] . "/" . "settings.php");

$Offers = functions::GetOffers();
if ($Offers == null) {
    $message = "No offers available";
}
?>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">View all of our current offers here! Click apply to use in your basket!</p>
        </div>
    </div>
</section>

<div class="container-md">
    <div class="col-md-12 p-4">
        <div class="row justify-content-center">
            <?php
            if ($Offers == null) {
                functions::SendMessage($message);
            } else {
                foreach ($Offers as $Offer) {
                    ?>
                    <div class="col-md-3 col-12">
                        <div class="card p-2 bg-primary my-3 text-white w-100">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $Offer['Name']; ?></h5>
                                <p class="card-text"><?php echo $Offer['Description']; ?></p>
                            </div>
                            <div class="card-footer rounded bg-light">
                                <p class="card-text text-dark">Valid From: <?php echo $Offer['ValidFrom'];?></p>
                                <p class="card-text text-dark">Valid To: <?php echo $Offer['ValidTo'];?></p>
                                <p class="card-text text-dark">Discount: <?php echo $Offer['Discount'] * 100;?>%</p>
                                <div class="btn-group w-100">
                                    <a href="https://localhost/basket/?discountmessage=RGlzY291bnQgYXBwbGllZCE=&discount=<?php echo $Offer['Discount'];?>&code=<?php echo $Offer['Code'];?>" class="btn btn-outline-success w-50">Apply</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }?>
            <!--Get the tallest element and apply height to all others -->
            <script>
                $(document).ready(function() {
                    $('.row').each(function() {
                        var highest = 0;
                        //Loop each element
                        $('.card', this).each(function() {
                            if ($(this).height() > highest) {
                                highest = $(this).height();
                            }
                        });
                        $('.card', this).height(highest);
                    });
                });
            </script>
        </div>
    </div>
</div>

