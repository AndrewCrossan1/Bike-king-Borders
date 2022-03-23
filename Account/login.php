<?php
include('../Scripts/functions.php');
    session_start();
    //Page Description: Allows active users to login to their account
    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Accounts";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Login";
    require('../Scripts/header.php');
    //Require the header of the page (Includes Navigation, meta-data, etc.)
?>
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Login to your account</p>
        </div>
    </div>
</section>
<?php
    //Check if message has been set in url
    if (isset($_GET['message'])) {
        functions::SendMessage(base64_decode($_GET['message']));
    }
?>
    <div class="container-md bg-dark text-light border rounded" style="margin-top: 6%;">
        <div class="row p-2">
            <div class="col-lg text-center py-2">
                <p class="display-5">Bike King Borders</p>
                <p class="small">Bike King Borders offers exclusive perks<br/>and discounts for members through email, text and postage (If opted in)</p>
                <div class="container p-2 mt-3">
                    <div class="row p-1 justify-content-center">
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" src="/Media/Images/smilingonbike15.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike2.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike3.jpg"/>
                        </div>
                    </div>
                    <div class="row p-1 justify-content-center">
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike4.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike3.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike111.jpg"/>
                        </div>
                    </div>
                    <div class="row p-1 justify-content-center">
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike7.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike8.jpg"/>
                        </div>
                        <div class="col-3 w-25">
                            <img class="img-thumbnail" alt="Smiling on bike" id="loginimg" src="/Media/Images/smilingonbike9.jpg"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg bg-light border border-dark rounded text-dark py-2" style="box-shadow: 0px 0px 12px 1px #A2A3A5;">
                <p class="display-6 text-center mt-5">
                    Login to your account
                </p>
                <p class="small p-2 text-center">
                    Fill out the form to login in order to access member-exclusive offers and discounts
                </p>
                <form class="needs-validation mt-auto mb-auto" novalidate method="post" action="loginscript.php">
                    <div class="form-row text-center">
                        <div class="col-md">
                            <div class="form-outline mb-4 p-2">
                                <label for="Username" class="form-label">Username: </label><br>
                                <input type="text" id="Username" name="Username" minlength="8" class="form-control w-75 m-auto" placeholder="Username"  required/>
                                <div class="invalid-feedback">
                                    Oops! Something doesn't look right
                                </div>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-outline mb-4 p-2">
                                <label for="Password" class="form-label">Password: </label><br>
                                <input type="password" id="Password" name="Password" minlength="12" class="form-control w-75 m-auto" placeholder="Password" required/>
                                <div class="invalid-feedback">
                                    Oops! Something doesn't look right
                                </div>
                            </div>
                        </div>
                        <div class="col-md p-2">
                            <input type="submit" name="submit" id="submit" class="btn btn-primary w-25">
                            <input type="reset" class="btn btn-secondary w-25">
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
