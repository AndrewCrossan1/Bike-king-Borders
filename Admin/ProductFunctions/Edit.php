<?php
session_start();
//Page Description: Allows the admin to manage current and historical offers

//Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
//Also keys is in with setting the pages active in header.php (Very fancy)
$PageName = "AdminEdit";

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Edit Product";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require('../../Scripts/adminheader.php');
require_once('../../Scripts/functions.php');
require_once('../../Models/Product.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1 && isset($_GET['id'])) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}

$Product = AdminFunctions::GetProduct($_GET['id']);

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
                <p style="font-family: Ubuntu" class="text-primary display-6">Edit a Product</p>
                <p class="lead text-secondary">Product ID: <?php echo $_GET['id'];?></p>
                <form class="pt-1 needs-validation" enctype="multipart/form-data" action="/admin/product/confirm/" method="POST" novalidate>
                    <hr/>
                    <br>
                    <div class="row">
                        <div class="col-md-2 col-4">
                            <label class="form-label py-1 fs-5" for="ProductName">Name:</label>
                        </div>
                        <div class="col-md-10 col-8">
                            <input class="form-control form-control-md w-75 py-2" minlength="4" maxlength="1000" type="text" id="ProductName" value="<?php echo $Product->getName();?>" contenteditable="true" required name="ProductName"/>
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
                            <label class="form-label py-3 fs-5" for="ProductDescription">Description: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <textarea class="form-control form-control-md w-75 py-2" minlength="10" contenteditable="true" maxlength="1000" type="text" id="ProductDescription" name="ProductDescription"><?php echo $Product->getDescription();?></textarea>
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
                            <label for="ProductPrice" class="form-label py-1 fs-5">Price: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <div class="input-group w-75">
                                <div class="input-group-prepend">
                                    <span class="input-group-text py-2" id="basic-addon1">£</span>
                                </div>
                                <input type="number" step="0.01" class="form-control py-2" min="0.00" max="9999.00" value="<?php echo $Product->getPrice();?>" contenteditable="true" aria-label="ProductPrice" required id="ProductPrice" name="ProductPrice" aria-describedby="basic-addon1">
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
                            <label class="form-label py-1 fs-5" for="ProductType">Bike Type: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <input class="form-control form-control-md w-75 py-2" type="text" maxlength="1000" minlength="1" value="<?php echo $Product->getType();?>" contenteditable="true" id="ProductType" required name="ProductType"/>
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
                            <label class="form-label py-1 fs-5" for="ProductColour">Colour: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <input class="form-control w-75 form-control-md py-2" value="<?php echo $Product->getColour();?>" contenteditable="true" type="text" id="ProductColour" required name="ProductColour"/>
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
                            <label class="form-label py-1 fs-5" for="ProductAge">Age: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <input class="form-control form-control-md w-75 py-2" type="number" value="<?php echo $Product->getAge();?>" contenteditable="true" min="1" id="ProductAge" name="ProductAge" required/>
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
                    <input type="hidden" value="<?php echo $_REQUEST['id']; ?>" name="id"/>
                    <div class="row">
                        <div class="col-md-2 col-4">
                            <label class="form-label py-1 fs-5" for="ProductImage">Product Image: </label>
                        </div>
                        <div class="col-md-10 col-8">
                            <input type="file" class="w-100 py-2" id="ProductImage"  accept="image/*" name="ProductImage"/>
                            <p></p>
                            <img id="ViewImage" src="/Media/Products/<?php if ($Product->getSlug() == null) { echo 'default.png'; } else { echo $Product->getSlug();}?>" class="img-fluid" style="max-height: 150px; max-width: 150px;" alt="Current Image"/>
                            <script>
                                $(document).ready(function() {
                                    var y;
                                    $("#ProductImage").change(function() {
                                        var y = $("#ProductImage")[0].files[0];
                                        if (y) {
                                            const fileReader = new FileReader();
                                            fileReader.readAsDataURL(y);
                                            fileReader.addEventListener("load", function () {
                                                document.getElementById("ViewImage").src = this.result;
                                            });
                                        }
                                    });
                                });
                            </script><br><br>
                            <button type="button" class="btn btn-outline-danger" style="width: 15%;" onclick="document.getElementById('ViewImage').src = '/Media/Products/<?php echo $Product->getSlug();?>'">Reset</button>
                        </div>
                    </div>
                    <br>
                    <hr/>
                    <div class="row mt-5">
                        <div class="col-md-2 col-6">
                            <button type="submit" name="SaveSubmit" class="btn btn-primary m-1 w-100">Save</button>
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
