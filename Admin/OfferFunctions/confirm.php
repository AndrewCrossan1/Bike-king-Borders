<?php

session_start();

//Require the header of the page (Includes Navigation, meta-data, etc.)
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . 'adminsettings.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    ?>
    <script>
        window.location.href = "https://localhost/admin/login/";
    </script>
    <?php
}
if (isset($_POST['submitdelete'])) {
    $Database = new Database();
    if (!isset($_POST['ConfirmationInput'])) {
        $Message = base64_encode("Enter the code shown!");
        ?>
        <script>
            window.location.href = "/admin/offers/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
    if ($_POST['ConfirmationInput'] == $_POST['ConfirmationNumber']) {
        $result = $Database->Delete("DELETE FROM Offers WHERE OfferID = ?", array($_POST['OfferID']));
        if ($result == true) {
            $Message = base64_encode("Offer deleted successfully");
            ?>
            <script>
                window.location.href = "/admin/offers/?message=<?php echo $Message;?>";
            </script>
            <?php
        } else {
            $Message = base64_encode("Offer could not be deleted");
            ?>
            <script>
                window.location.href = "/admin/offers/?message=<?php echo $Message;?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Please enter the code shown");
        ?>
        <script>
            window.location.href = "/admin/offers/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
}
if (isset($_POST['AddSubmit'])) {
    //Cleaning Variables
    //Setting keys
    $cd = array(
        "Name" => null,
        "Code" => null,
        "Description" => null,
        "Discount" => null,
        "ValidFrom" => null,
        "ValidTo" => null,
    );
    $Name = filter_input(INPUT_POST, "OfferName", FILTER_SANITIZE_STRING);
    $cd['Discount'] = (int)$_POST['OfferDiscount'] / 100;
    $cd['Name'] = $Name;
    $cd['Description'] = $_POST['OfferDescription'];
    $cd['Code'] = $_POST['OfferCode'];
    $cd['ValidFrom'] = $_POST['OfferValidFrom'];
    $cd['ValidTo'] = $_POST['OfferValidTo'];

    //Database upload
    $Database = new Database();
    $sql = "INSERT INTO Offers (Name, Code, Description, Discount, ValidFrom, ValidTo) VALUES (?, ?, ?, ?, ?, ?);";
    if ($query = $Database->conn->prepare($sql)) {
        //Array with keys is used for readability
        if ($query->bind_param("sssdss", $cd['Name'], $cd['Code'], $cd['Description'], $cd['Discount'], $cd['ValidFrom'], $cd['ValidTo'])) {
            if ($query->execute()) {
                $Message = base64_encode("Offer successfully added");
                ?>
                <script>
                    window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                </script>
                <?php
            } else {
                $Message = base64_encode("Could not create offer!");
                ?>
                <script>
                    window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                </script>
                <?php
            }
        } else {
            $Message = base64_encode("Could not create offer!");
            ?>
            <script>
                window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Could not create offer!");
        ?>
        <script>
            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
        </script>
        <?php
    }
} else {
    $Message = base64_encode("Could not create offer!");
    ?>
    <script>
        window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
    </script>
    <?php
}
?>