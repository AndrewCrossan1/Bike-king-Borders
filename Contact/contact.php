<?php
    session_start();
    //Page Description: Allows the user to contact the shop

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Contact Us";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'settings.php');
    ?>

<body style="background: url('/Media/Images/AdminBackground.jpg'); background-size: cover;">

<?php
//Send message if it is set
if (isset($_GET['message'])) {
    functions::SendMessage(base64_decode($_GET['message']));
}
?>

<div class="container-md mb-0 bg-white light-shadow rounded-3" style="margin-top: 6%;">
    <div class="row">
        <div class="col-md-12 m-0 col-12 rounded-3">
            <form class="form" method="post" action="/ContactSend/">
                <p class="text-black fw-bold text-center fs-1 mt-2" style="font-family: Roboto, sans-serif;">Contact us</p>
                <p class="small text-center">Having an issue with a product? struggling to navigate the site? Fill out the form below for help with your request!</p>
                <div class="row p-3 mb-2">
                    <div class="col-md-6">
                        <div class="form-group rounded p-3 mx-auto" style="background-color: #D3D3D3;">
                            <label class="form-label" for="Email">Email:</label>
                            <input type="email" class="custom-control bg-transparent" placeholder="Enter email here..." name="Email" id="Email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group rounded p-3 mx-auto" style="background-color: #D3D3D3;">
                            <label class="form-label" for="FullName">Full Name:</label>
                            <input type="text" class="custom-control bg-transparent" placeholder="Enter full name..." name="FullName" id="FullName" required>
                        </div>
                    </div>
                </div>
                <div class="row p-3 mb-2">
                    <div class="col-md-12">
                        <div class="form-group rounded p-3 mx-auto" style="background-color: #D3D3D3;">
                            <script>
                                function GetProduct(str) {
                                    if (str.length == 0) {
                                        document.getElementById('Product').value= "";
                                        return;
                                    } else {
                                        let xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                document.getElementById('Product').value = this.responseText;
                                            }
                                        };
                                        xmlhttp.open("GET", "/Scripts/getproduct.php?q=" + str, true);
                                        xmlhttp.send();
                                    }
                                }
                            </script>
                            <label class="form-label" for="ProductSearch">Product: (If you have an issue)</label>
                            <input type="search" onkeyup="GetProduct(this.value)" class="custom-control bg-transparent" style="padding: 1%;" placeholder="Enter Product Name" name="ProductSearch" id="ProductSearch">
                            <br>
                            <input type="text" class="form-control disabled" id="Product" readonly name="Product"/>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row p-3 mb-2">
                    <div class="col-md-12">
                        <div class="form-group rounded p-3 mx-auto" style="background-color: #D3D3D3;">
                            <label class="form-label" for="Subject">Subject:</label>
                            <input type="text" class="custom-control bg-transparent fs-4" style="padding: 1%;" placeholder="My wheel has fallen off!" name="Subject" id="Subject" required>
                        </div>
                    </div>
                </div>
                <div class="row p-3 mb-2">
                    <div class="col-md-12">
                        <div class="form-group rounded p-3 mx-auto" style="background-color: #D3D3D3;">
                            <label class="form-label" for="Message">Message:</label>
                            <textarea rows="5" class="custom-control bg-transparent fs-5 text-black" style="padding: unset;" name="Message" id="Message" required>Enter message here</textarea>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row p-3 mb-2">
                    <div class="col-md-12">
                        <div class="form-group rounded p-3 mx-auto text-center">
                            <button class="btn btn-primary w-25" name="ContactSubmit" type="submit">Send Message</button>
                            <button class="btn btn-danger w-25" type="reset">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
    include('Scripts/footer.php');
?>

</body>
