<?php
session_start();
//Page Description: Allows the admin to manage current and historical offers

//Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
//Also keys is in with setting the pages active in header.php (Very fancy)
$PageName = "AdminLogin";

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Admin Login";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require('../Scripts/adminheader.php');
require_once('../Scripts/functions.php');

if (isset($_SESSION['Admin'])) {
    ?>
    <script>
        setTimeout(function(){
            window.location.href = 'home.php';
        });
    </script>
    <?php
}

?>

<?php
//Check if message has been set in url
if (isset($_GET['message'])) {
    functions::SendMessage(base64_decode($_GET['message']));
}
?>

<div class="container-md" style="margin-top: 10rem;">
    <div class="container" style="max-width: 30rem;">
        <form method="post" action="validate.php" class="w-100 mx-auto needs-validation" novalidate>
            <div class="card" style="max-width: 30rem;">
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