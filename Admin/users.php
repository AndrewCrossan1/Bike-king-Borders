<?php
session_start();
$PageTitle = "Manage users";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

//If user is not admin then leave
if (!isset($_SESSION['Admin'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = '/admin/login/';
        });
    </script>
    <?php
}

if (isset($_REQUEST['type'])) {
    ?>
    <script>
        let url = window.location.href;
        if (url.startsWith("https://localhost/Admin/users.php?")) {
            window.location.href = "https://localhost/admin/users/type=<?php echo $_REQUEST['type'];?>/datecreated=<?php echo $_REQUEST['datecreated'];?>/"
        }
    </script>
    <?php
}

if (isset($_REQUEST['AccountID'])) {
    $ViewUser = adminfunctions::GetUser($_REQUEST['AccountID']);
    ?>
    <script>
        $(window).on('load', function() {
            $('#ChangeModal').modal('show');
            $('#Username').prop('disabled', true);
            $('#Password').prop('disabled', true);
            $('#Email').prop('disabled', true);
            $('#passwordneeds').hide();
            $('#passwordnotes').hide()
            $('#SaveChanges').prop('disabled', true);
        });
        $(document).ready(function() {
            $('#EditUser').on('click', function() {
                if ($(this).text() == 'Cancel') {
                    $('#Username').prop('disabled', true);
                    $('#Password').prop('disabled', true);
                    $('#Email').prop('disabled', true);
                    $('#Username').val($('#UsernameHidden').val());
                    $('#Password').val($('#PasswordHidden').val());
                    $('#Email').val($('#EmailHidden').val());
                    $('#passwordneeds').hide();
                    $('#passwordnotes').hide()
                    $(this).text("Edit");
                    $('#SaveChanges').prop('disabled', true);
                } else {
                    $('#Username').prop('disabled', false)
                    $('#Password').prop('disabled', false)
                    $('#Email').prop('disabled', false)
                    $('#passwordneeds').show();
                    $('#passwordnotes').show()
                    $(this).text("Cancel");
                    $('#SaveChanges').prop('disabled', false);
                }
            });
        });
    </script><?php
} else {
    $ViewUser = null;
}

if (isset($_REQUEST['type']) && isset($_REQUEST['datecreated'])) {
    $_SESSION['filteredcontentusers'] = adminfunctions::FilterUsers($_REQUEST['type'], $_REQUEST['datecreated']);
} else {
    $_SESSION['filteredcontentusers'] = adminfunctions::GetUsers();
}
?>

<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Add, update or remove users.</p>
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
                                <a class="nav-link text-light active" aria-selected="true" href="/admin/users/" tabindex="-1">Users</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="/admin/support/" tabindex="-1">Support Tickets</a>
                            </li>
                            <hr style="color: white;"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10 col-12">
            <!--Main content-->
            <?php if(isset($_REQUEST['message'])) {
                adminfunctions::SendMessage(base64_decode($_REQUEST['message']));
            }
            ?>
            <div class="container-fluid p-3">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <!--Filters-->
                        <form class="form" action="/Admin/users.php" method="get">
                            <div class="form-group border border-dark border-2 rounded row p-3">
                                <div class="col-md-4 col-12">
                                    <label for="type" class="form-label">Account Type</label>
                                    <select name="type" id="type" class="form-select">
                                        <option value="employee" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'employee') { echo ' selected';} ?>>Employee</option>
                                        <option value="customer" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'customer') { echo ' selected';} ?>>Customer</option>
                                        <option value="all" <?php if (isset($_REQUEST['type']) && $_REQUEST['type'] == 'all') { echo ' selected';} ?>>All</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="form-label" for="datecreated">Date Created</label>
                                    <select name="datecreated" id="datecreated" class="form-select fg-white">
                                        <option value="newest" <?php if (isset($_REQUEST['datecreated']) && $_REQUEST['datecreated'] == 'newest') { echo ' selected';} ?>>Newest</option>
                                        <option value="oldest" <?php if (isset($_REQUEST['datecreated']) && $_REQUEST['datecreated'] == 'oldest') { echo ' selected';} ?>>Oldest</option>
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
                <div class="row">
                    <?php
                    if (isset($_SESSION['filteredcontentusers']) && $_SESSION['filteredcontentusers'] != null) {
                        for ($x = 0; $x<count($_SESSION['filteredcontentusers']); $x++) {?>
                            <div class="col-md-3 col-6" style="min-height: 400px;">
                                <div class="card p-2 bg-primary my-3 text-white w-100">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $_SESSION['filteredcontentusers'][$x]['Username']; ?></h5>
                                        <?php if (isset($_REQUEST['type']) && !($_REQUEST['type'] == 'all')) { ?>
                                            <p class="card-text">Email: <?php echo $_SESSION['filteredcontentusers'][$x]['Email']; ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer rounded bg-light">
                                        <p class="card-text text-dark">Date Created: <?php echo $_SESSION['filteredcontentusers'][$x]['DateCreated'];?></p>
                                        <p class="card-text text-dark">AccountID: <?php echo $_SESSION['filteredcontentusers'][$x]['AccountID'];?></p>
                                        <form method="get" action="https://localhost/admin/users/">
                                            <input type="hidden" name="AccountID" value="<?php echo $_SESSION['filteredcontentusers'][$x]['AccountID']; ?>"/>
                                            <div class="btn-group w-100">
                                                <button type="submit" class="btn btn-outline-primary w-50">View</button>
                                                <a href="#delete" class="btn btn-outline-danger w-50">Delete</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        adminfunctions::SendMessage('No accounts available with chosen filters');
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ChangeModal" tabindex="-1" aria-labelledby="ChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/Admin/UserFunctions/savechanges.php">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <label for="Username" class="form-label w-100">Username:</label>
                            </div>
                            <div class="col-md-12 col-12">
                                <input type="text" class="form-control w-75" id="Username" minlength="7" name="Username" value="<?php echo $ViewUser[0]['Username'];?>">
                                <input type="hidden" class="form-control w-75" id="UsernameHidden" name="UsernameHidden" value="<?php echo $ViewUser[0]['Username'];?>">
                                <input type="hidden" id="HiddenID" name="HiddenID" value="<?php echo $ViewUser[0]['AccountID'];?>"/>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-12" id="passwordneeds">
                                <p class="small text-danger">Password must contain the following</p>
                                <ul class="small text-danger">
                                    <li>Must start with a capital letter</li>
                                    <li>Must contain a number</li>
                                    <li>Must be 9-15 characters long</li>
                                    <li>Must contain a special character (!?_#)</li>
                                </ul>
                            </div>
                            <div class="col-md-12 col-12">
                                <label for="Password" class="form-label w-100">Password:</label>
                            </div>
                            <div class="col-md-12 col-12">
                                <input type="password" class="form-control w-75" id="Password" minlength="9" pattern="^[A-Z]+[a-zA-Z]+[0-9]+[!?_#]+" name="Password" value="<?php echo $ViewUser[0]['Password'];?>">
                                <input type="hidden" class="form-control w-75" id="PasswordHidden" name="PasswordHidden" value="<?php echo $ViewUser[0]['Password'];?>">
                            </div>
                            <div class="col-md-12 col-12 mt-1" id="passwordnotes">
                                <p class="small text-danger">Enter the current password if you wish to update this account</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <label for="Email" class="form-label w-100">Email:</label>
                            </div>
                            <div class="col-md-12 col-12">
                                <input type="email" class="form-control w-75" id="Email" name="Email" value="<?php echo $ViewUser[0]['Email'];?>">
                                <input type="hidden" class="form-control w-75" id="EmailHidden" name="EmailHidden" value="<?php echo $ViewUser[0]['Email'];?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="EditUser" class="btn btn-secondary">Edit</button>
                    <button type="submit" name="SaveChanges" id="SaveChanges" class="btn btn-outline-success">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>