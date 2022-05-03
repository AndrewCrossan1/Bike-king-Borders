<?php

session_start();

if (isset($_SESSION['discountcode']) && $_SESSION['discount']) {
    unset($_SESSION['discountcode']);
    unset($_SESSION['discount']);
    $message = base64_encode("Discount removed");
    ?>
    <script>
        window.location.href = "/basket/?discountmessage=<?php echo $message; ?>";
    </script>
    <?php
} else {
    ?>
    <script>
        window.location.href = "/basket/";
    </script>
    <?php
}
?>

