<?php
require($_SERVER['DOCUMENT_ROOT'] . "/Scripts/" . "database.php");
if (isset($_GET['discountcode'])) {
    $Database = new Database();
    //Get corresponding code from database
    $sql = "SELECT * FROM Offers WHERE Code = ? AND ValidTo > sysdate() AND ValidFrom <= sysdate()";
    $query = $Database->conn->prepare($sql);
    if ($query->bind_param("s", $_GET['discountcode'])) {
        //Execute
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $discount = $row['Discount'];
                $Message = base64_encode("Discount applied!");
                ?>
                <script>
                    window.location.href="/basket/?discountmessage=<?php echo $Message; ?>&discount=<?php echo (float)$discount;?>&code=<?php echo $_GET['discountcode'];?>";
                </script>
                <?php
            } else {
                $Message = base64_encode("Invalid code!");
                ?>
                <script>
                    window.location.href="/basket/?discountmessage=<?php echo $Message; ?>";
                </script>
                <?php
            }
        } else {
            $Message = base64_encode("Invalid code!");
            ?>
            <script>
                window.location.href="/basket/?discountmessage=<?php echo $Message; ?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Invalid code!");
        ?>
        <script>
            window.location.href="/basket/?discountmessage=<?php echo $Message; ?>";
        </script>
        <?php
    }
} else {
    ?>
    <script>
        window.location.href="/basket/";
    </script>
    <?php
}
?>
