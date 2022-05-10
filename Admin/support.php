<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Support tickets";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}
?>

<script>
    $(document).ready(function() {
        var items = [];
        $('#status').change(function() {
            $.getJSON('/Admin/SupportScripts/GetTickets.php',
                {
                    status : $('#status').val(),
                    dateposted : $('#DatePosted').val(),
                },
                function(data) {
                    items = data[0];
                    console.log(items);
                });
            });
    });
</script>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Manage support tickets (Reply, Remove and</p>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 col-12 bg-dark">
            <!--Side navigation bar-->
            <div class="container-fluid p-5">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-light">Bike King Borders</h4>
                        <hr style="color: white;"/>
                        <div class="nav flex-column nav-pills">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/home/">Home</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/products/">Products</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/offers/">Offers</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/users/" tabindex="-1">Users</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light active" aria-selected="true" href="/admin/support/" tabindex="-1">Support Tickets</a>
                            </li>
                            <hr style="color: white;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <!--Main content-->
            <?php
            if (isset($_REQUEST['message'])) {
                adminfunctions::SendMessage(base64_decode($_REQUEST['message']));
            }
            ?>
            <script>
                document.writeln(content);
            </script>
            <div class="container-fluid p-3">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!--AJAX Filters-->
                        <div class="form-group border border-dark border-2 rounded row p-3">
                            <div class="col-md-4 col-12">
                                <label for="status" class="form-label">Ticket Status</label>
                                <select name="Status" id="status" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="Closed">Closed</option>
                                    <option value="All">All</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label" for="DatePosted">Date Posted</label>
                                <select name="DatePosted" id="DatePosted" class="form-select fg-white">
                                    <option value="Newest" selected>Newest</option>
                                    <option value="Oldest">Oldest</option>
                                </select>
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label" for="Search">Search for post</label>
                                <input placeholder="Enter subject" type="search" name="Search" id="Search" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    <?php for ($x = 0; $x<12; $x++) {?>
                    <div class="col-md-3 col-6" style="min-height: 400px;">
                        <div class="card p-2 bg-primary my-3 text-white w-100">
                            <div class="card-body">
                                <h5 class="card-title">The wheels on my bike have broken, what do I do?</h5>
                                <p class="card-text">By: Andrew Crossan</p>
                            </div>
                            <div class="card-footer rounded bg-light">
                                <p class="card-text text-dark">Status: Active</p>
                                <p class="card-text text-dark">ProductID: 4</p>
                                <div class="btn-group w-100">
                                    <a type="button" href="/support/respond/" class="btn btn-outline-primary w-50">Respond</a>
                                    <a type="button" href="/support/delete/" class="btn btn-outline-danger w-50">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>