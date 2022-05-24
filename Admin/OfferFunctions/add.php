<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Add Product";

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
                                    <a class="nav-link active text-light" aria-selected="true" href="/admin/home/">Home</a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-12 bg-light p-5">
                <div class="container-fluid">
                    <p style="font-family: Ubuntu" class="text-primary display-6">Add an offer</p>
                    <p class="lead text-secondary">Fill out the required details in order to add a new offer to the shop</p>
                    <form class="pt-1 needs-validation" enctype="multipart/form-data" action="/admin/offers/confirm/" method="POST" novalidate>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label class="form-label py-1 fs-5" for="OfferName">Name:</label>
                            </div>
                            <div class="col-md-10 col-8">
                                <input class="form-control form-control-md w-75 py-2" minlength="4" maxlength="1000" type="text" id="OfferName" required name="OfferName"/>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Something doesn't look right!
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label class="form-label py-1 fs-5" for="OfferCode">Code:</label>
                            </div>
                            <div class="col-md-10 col-8">
                                <input class="form-control form-control-md w-75 py-2" minlength="4" maxlength="1000" type="text" id="OfferCode" required name="OfferCode"/>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Something doesn't look right!
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label class="form-label py-3 fs-5" for="OfferDescription">Description: </label>
                            </div>
                            <div class="col-md-10 col-8">
                                <textarea class="form-control form-control-md w-75 py-2" minlength="10" maxlength="1000" type="text" id="OfferDescription" name="OfferDescription"></textarea>
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Something doesn't look right!
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label for="OfferDiscount" class="form-label py-1 fs-5">Discount: </label>
                            </div>
                            <div class="col-md-10 col-8">
                                <div class="input-group w-75">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text py-2" id="basic-addon1">%</span>
                                    </div>
                                    <input type="number" step="5" class="form-control py-2" min="5" max="90" aria-label="OfferDiscount" required id="OfferDiscount" name="OfferDiscount" aria-describedby="basic-addon1">
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Something doesn't look right!
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label class="form-label py-1 fs-5" for="OfferValidFrom">Valid From:</label>
                            </div>
                            <div class="col-md-10 col-8">
                                <input type="date" required name="OfferValidFrom" id="OfferValidFrom" class="form-control form-control-md w-75 py-2">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Something doesn't look right!
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row">
                            <div class="col-md-2 col-4">
                                <label class="form-label py-1 fs-5" for="OfferValidTo">Valid To:</label>
                            </div>
                            <div class="col-md-10 col-8">
                                <input type="date" required name="OfferValidTo" id="OfferValidTo" class="form-control form-control-md w-75 py-2">
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Something doesn't look right!
                            </div>
                        </div>
                        <br>
                        <hr/>
                        <br>
                        <div class="row mt-5">
                            <div class="col-md-2 col-6">
                                <button type="submit" name="AddSubmit" class="btn btn-primary m-1 w-100">Add</button>
                            </div>
                            <div class="col-md-2 col-6">
                                <button type="reset" class="btn btn-secondary m-1 w-50">Reset</button>
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
    </div>
<?php
