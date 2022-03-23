<?php
    session_start();
    //Page Description: Allows users to create an account where they can access member exclusive deals and other bonuses.

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Account";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Create an account";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('../Scripts/header.php');
?>

<!--Send message to UI if an error or notification occurs-->
<?php
    if (isset($_GET['message'])) {
        Functions::SendMessage($_GET['message']);
    }
?>
<div class="container-fluid mr-auto ml-auto" style="margin-top: 3%;">
    <h1 class="display-3 fw-bold text-center" style="font-family: Ubuntu, Verdana">Why join Bike King Borders?</h1>
    <div class="row p-3 justify-content-center">
        <div class="col-md-3 m-1 text-dark border border-dark rounded text-center p-2">
            <i class="fas fa-percent" aria-hidden="false" style="font-size: 75px;"></i>
            <p class="lead">Member exclusive discounts!</p>
        </div>
        <div class="col-md-3 m-1 text-dark border border-dark rounded text-center p-2">
            <i class="fas fa-bicycle" aria-hidden="false" style="font-size: 75px;"></i>
            <p class="lead">Exclusive custom bike offers based on your previous purchases!</p>
        </div>
        <div class="col-md-3 m-1 text-dark border border-dark rounded text-center p-2">
            <i class="fa fa-money" aria-hidden="false" style="font-size: 75px;"></i>
            <p class="lead">Gain Wheels&copy for purchases and hires through the Bike Kings rewards program!</p>
        </div>
    </div>
</div>
    <!--The form-->
<div class="container-md bg-dark text-light border rounded my-2" style="margin-top: 1%;">
    <div class="row p-2">
        <div class="col-lg text-center text-dark bg-light p-2" style="box-shadow: 0px 0px 12px 1px #A2A3A5;">
            <p class="lead text-center">Fill in the form below and click submit to create your very own Bike King Borders account and reap the benefits of member perks!</p>
            <form class="p-3 m-2" method="POST" action="validate.php">
                <!--Username Input-->
                <div class="form-group row pt-1">
                    <label for="UsernameInput" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" id="UsernameInput" name="UsernameInput" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <!--Password Input-->
                <div class="form-group row pt-3">
                    <label for="PasswordInput" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="PasswordInput" name="PasswordInput" class="form-control" placeholder="Password" required>
                    </div>
                </div>
                <!--Confirm password-->
                <div class="form-group row pt-3">
                    <label for="PasswordInputConfirm" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" id="PasswordInputConfirm" name="PasswordInputConfirm" class="form-control" placeholder="Confirm Password" required>
                    </div>
                </div>
                <!--Forename, Surname, Phone Number-->
                <div class="row pt-3">
                    <div class="col">
                        <label for="ForenameInput">Forename</label>
                        <input type="text" id="ForenameInput" name="ForenameInput" class="form-control" placeholder="Forename" required>
                    </div>
                    <div class="col">
                        <label for="SurnameInput">Surname</label>
                        <input type="text" id="SurnameInput" name="SurnameInput" class="form-control" placeholder="Surname" required>
                    </div>
                    <div class="col">
                        <label for="PhoneInput">Phone Number</label>
                        <input type="text" id="PhoneInput" name="PhoneInput" class="form-control" placeholder="Phone Number" required>
                    </div>
                </div>
                <!--Email and Address-->
                <div class="row pt-3">
                    <div class="col">
                        <label for="EmailInput">Email</label>
                        <input type="email" id="EmailInput" name="EmailInput" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="HouseInput">Number</label>
                                <input type="number" id="HouseInput" name="HouseInput" class="form-control col-md-6" placeholder="1234" required>
                            </div>
                            <div class="col-md-8">
                                <label for="AddressInput">Address Line 1</label>
                                <input type="text" id="AddressInput" name="AddressInput" class="form-control col-md-6" placeholder="Address" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-6">
                        <input type="submit" name="submit" id="submit" class="btn btn-primary w-75" value="Create"/>
                    </div>
                    <div class="col-6">
                        <input type="reset" name="reset" id="reset" class="btn btn-secondary w-75" value="Reset"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>