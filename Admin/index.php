<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Admin Login";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

if(isset($_SESSION['Admin']) && $_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/home/";
    </script>
    <?php
}

//Check if message has been set in url
if (isset($_GET['message'])) {
    adminfunctions::SendMessage(base64_decode($_GET['message']));
}
?>
<body style="background: url('/Media/Images/AdminBackground.jpg'); background-size: cover;">

<div class="adminlogin">
    <div class="container-md">
        <div class="container" style="max-width: 30rem;margin-top: 10rem;">
            <form method="post" action="/admin/validate/" class="w-100 mx-auto needs-validation" novalidate>
                <div class="card border-0" style="max-width: 30rem; box-shadow: 0 0 20px 1px black;">
                    <div class="card-header bg-primary p-3 text-light fs-5 text-center">
                        Administrator Login
                    </div>
                    <div class="card-body">
                        <div class="form-group p-1">
                            <label for="Username" class="form-label text-left">Username:</label><br>
                            <input type="text" name="Username" class="form-control" id="Username" placeholder="Username" required/>
                            <div class="invalid-feedback">
                                Oops! That doesn't look right.
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group p-1">
                            <label for="Password" class="form-label text-left">Password:</label><br>
                            <input type="password" name="Password" class="form-control" id="Password" placeholder="Password" required/>
                            <div class="invalid-feedback">
                                Oops! That doesn't look right.
                            </div>
                        </div>
                        <br/>
                        <div class="btn-group text-center w-100">
                            <input type="submit" class="btn btn-primary" name="submit" alt="Login" value="Login">
                            <input type="reset" class="btn btn-outline-secondary" alt="Reset Values" value="Reset">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <p class="small">Unauthorised access of this website can lead to a severe penalty and or a prison sentence.</p>
                    </div>
                </div>
                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                                form.addEventListener('submit', function(event) {
                                    if (form.checkValidity() === false) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }
                                    form.classList.add('was-validated');
                                }, false);
                            });
                        }, false);
                    })();
                </script>
            </form>
        </div>
    </div>
</div>