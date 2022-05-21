<?php
session_start();
//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Local Area";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require($_SERVER['DOCUMENT_ROOT'] . "/" . "settings.php");
?>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
                <p class="lead">View a map of our local area, including trails and our shop!</p>
        </div>
    </div>
</section>

<div class="container-md mt-5 border rounded">
    <div class="row">
        <div class="col-md-6 p-4" style="background-color: rgba(208,208,208,0.6); height: 60vh;">
            <iframe class="map-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d72074.58522109772!2d-2.819801445477749!3d55.63105933686973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4887836ce3d02c59%3A0x6e8f056ad84648a5!2sJust%20Cycle%20Ltd!5e0!3m2!1sen!2suk!4v1653171128539!5m2!1sen!2suk" style="width: 100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-md-6 bg-dark p-4">
            <iframe src="/Media/Videos/bike_-_82636%20(Original).mp4" allowfullscreen="true" style="width: 100%; height: 100%;">
        </div>
    </div>
</div>