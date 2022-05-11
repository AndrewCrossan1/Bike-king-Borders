<?php

session_start();

$PageTitle = "Close a ticket";

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/Scripts/' . 'adminfunctions.php');

//Redirect if user doesn't come from admin support.php, redirect if http referer isnt support page, redirect if id is not set
if (!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
} elseif (!str_starts_with($_SERVER['HTTP_REFERER'],'https://localhost/admin/support/')) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/support/";
    </script>
    <?php
} elseif (!isset($_REQUEST['id'])) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/support/";
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
                <h5 class="modal-title" id="exampleModalLongTitle">Confirm close</h5>
                <a type="button" class="btn-close" href="/admin/support/" aria-label="Leave">
                </a>
            </div>
            <div class="modal-body">
                <form method="post" action="/admin/support/confirm/">
                    <input type="hidden" name="TicketID" value="<?php echo $_REQUEST['id'];?>"/>
                    <p class="lead">Please enter the following number in order to close this ticket:</p>
                    <hr/>
                    <input type="text" class="disabled text-center p-3 form-control fs-2" name="ConfirmationNumber" readonly value="<?php echo random_int(100000, 999999);?>"/>
                    <hr/>
                    <div class="form-group">
                        <input type="text" class="text-center p-1 fs-5 form-control" placeholder="Enter value" aria-placeholder="Enter Value" name="ConfirmationInput"/>
                    </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="/admin/support/">Exit</a>
                <button type="submit" name="submitclose" class="btn btn-primary">Close</button>
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
