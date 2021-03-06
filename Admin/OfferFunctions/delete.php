<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Delete Product";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}

if (isset($_REQUEST['OfferID']) && $_REQUEST['OfferID'] == null) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/home/?message=<?php echo base64_encode('An offer must be selected!');?>";
    </script>
    <?php
}
?>

    <div class="container-md mt-5 ml-auto mr-auto text-center">
        <p class="display-6">
            Are you lost? Click <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">here</a> to go to the previous page
        </p>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm Delete</h5>
                    <a type="button" class="btn-close" href="/admin/offers/" aria-label="Leave">
                    </a>
                </div>
                <div class="modal-body">
                    <form method="post" action="/admin/offers/confirm/">
                        <input type="hidden" name="OfferID" value="<?php echo $_GET['id'];?>"/>
                        <p class="lead">Please enter the following number in order to delete this product:</p>
                        <hr/>
                        <input type="text" class="disabled text-center p-3 form-control fs-2" name="ConfirmationNumber" readonly value="<?php echo random_int(100000, 999999);?>"/>
                        <hr/>
                        <div class="form-group">
                            <input type="text" class="text-center p-1 fs-5 form-control" placeholder="Enter value" aria-placeholder="Enter Value" name="ConfirmationInput"/>
                        </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="/admin/products/">Exit</a>
                    <button type="submit" name="submitdelete" class="btn btn-primary">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <script>
        $(window).on('load', function() {
            $('#myModal').modal("show")
        });
    </script>
<?php
