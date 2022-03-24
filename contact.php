<?php
    session_start();
    //Page Description: Allows the user to contact the shop

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Contact";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Contact Us";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('Scripts/header.php');
    ?>


<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Get in contact with the folks at Bike King Borders!</p>
        </div>
    </div>
</section>
<?php
//Send message if it is set
if (isset($_GET['message'])) {
    functions::SendMessage(base64_decode($_GET['message']));
}
?>

<?php
    include('Scripts/footer.php');
?>