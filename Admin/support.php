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

if (!isset($_SESSION['filteredcontent'])) {
    $Tickets = adminfunctions::GetTickets();
}
?>

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
            <div class="container-fluid p-3">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!--Filters-->
                        <form class="form" action="/Admin/SupportScripts/GetTickets.php" method="get">
                            <div class="form-group border border-dark border-2 rounded row p-3">
                                <div class="col-md-4 col-12">
                                    <label for="status" class="form-label">Ticket Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'Active') { echo ' selected';} ?>
                                        <option value="active" <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'active') { echo ' selected';} ?>>Active</option>
                                        <option value="closed" <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'closed') { echo ' selected';} ?>>Closed</option>
                                        <option value="all" <?php if (isset($_REQUEST['status']) && $_REQUEST['status'] == 'all') { echo ' selected';} ?>>All</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="form-label" for="DatePosted">Date Posted</label>
                                    <select name="dateposted" id="DatePosted" class="form-select fg-white">
                                        <option value="newest" <?php if (isset($_REQUEST['dateposted']) && $_REQUEST['dateposted'] == 'newest') { echo ' selected';} ?>>Newest</option>
                                        <option value="oldest" <?php if (isset($_REQUEST['dateposted']) && $_REQUEST['dateposted'] == 'oldest') { echo ' selected';} ?>>Oldest</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="form-label" for="submit">Filter results:</label>
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <!--Get the tallest element and apply height to all otherw -->
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
                <?php
                if (isset($_SESSION['filteredcontent']) && $_SESSION['filteredcontent'] != null) {
                    for ($x = 0; $x<count($_SESSION['filteredcontent']); $x++) {?>
                        <div class="col-md-3 col-6" style="min-height: 400px;">
                            <div class="card p-2 bg-primary my-3 text-white w-100">
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $_SESSION['filteredcontent'][$x]['Subject']; ?></h5>
                                <p class="card-text">By: <?php echo $_SESSION['filteredcontent'][$x]['Fullname']; ?></p>
                            </div>
                            <div class="card-footer rounded bg-light">
                                <?php
                                if ($_SESSION['filteredcontent'][$x]['Active'] == 1) {
                                    $status = 'Open';
                                } else {
                                    $status = 'Closed';
                                }
                                ?>
                                <p class="card-text text-dark">Date Created: <?php echo $_SESSION['filteredcontent'][$x]['DateCreated'];?></p>
                                <p class="card-text text-dark">Status: <?php echo $status; ?></p>
                                <p class="card-text text-dark">ProductID: <?php echo $_SESSION['filteredcontent'][$x]['ProductID'];?></p>
                                <div class="btn-group w-100">
                                    <a type="button" href="/support/respond/" class="btn btn-outline-primary w-50">Respond</a>
                                    <a type="button" href="/support/delete/" class="btn btn-outline-danger w-50">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                    } else if ($Tickets != null && (isset($_SESSION['filteredcontent']) && $_SESSION['filteredcontent'] !=null)) {
                        for ($x = 0; $x<count($Tickets); $x++) {?>
                        <div class="col-md-3 col-6" style="min-height: 400px;">
                            <div class="card p-2 bg-primary my-3 text-white w-100">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $Tickets[$x]['Subject']; ?></h5>
                                    <p class="card-text">By: <?php echo $Tickets[$x]['Fullname']; ?></p>
                                </div>
                                <div class="card-footer rounded bg-light">
                                    <?php
                                    if ($Tickets[$x]['Active'] == 1) {
                                        $status = 'Open';
                                    } else {
                                        $status = 'Closed';
                                    }
                                    ?>
                                    <p class="card-text text-dark">Date Created: <?php echo $Tickets[$x]['DateCreated'];?></p>
                                    <p class="card-text text-dark">Status: <?php echo $status; ?></p>
                                    <p class="card-text text-dark">ProductID: <?php echo $Tickets[$x]['ProductID'];?></p>
                                    <div class="btn-group w-100">
                                        <a type="button" href="/support/respond/" class="btn btn-outline-primary w-50">Respond</a>
                                        <a type="button" href="/support/delete/" class="btn btn-outline-danger w-50">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    } else {
                    adminfunctions::SendMessage('No Products available with chosen filters');
                }?>
            </div>
        </div>
    </div>
</div>
</div>