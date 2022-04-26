<?php
session_start();

$PageName = "DeleteConfirm";
require('../../Scripts/functions.php');

if(!isset($_SESSION['Admin']) && !$_SESSION['Admin'] == 1) {
    echo 'not logged in';
}
if (isset($_POST['submitdelete'])) {
    $Database = new Database();
    if (!isset($_POST['ConfirmationInput'])) {
        $Message = base64_encode("Enter the code shown!");
        ?>
        <script>
            window.location.href = "/admin/products/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
    if ($_POST['ConfirmationInput'] == $_POST['ConfirmationNumber']) {
        $result = $Database->Delete("DELETE FROM products WHERE ProductID = ?", array($_POST['ProductID']));
        if ($result == true) {
            $Message = base64_encode("Product deleted successfully");
            ?>
            <script>
                window.location.href = "/admin/products/?message=<?php echo $Message;?>";
            </script>
            <?php
        } else {
            $Message = base64_encode("Product could not be deleted");
            ?>
            <script>
                window.location.href = "/admin/products/?message=<?php echo $Message;?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Please enter the code shown");
        ?>
        <script>
            window.location.href = "/admin/products/?message=<?php echo $Message;?>";
        </script>
        <?php
    }
}
if (isset($_POST['AddSubmit'])) {
    //Cleaning Variables
    //Setting keys
    $cd = array(
            "Name" => null,
            "Description" => null,
            "imgslug" => null,
            "Price" => null,
            "Colour" => null,
            "Age" => null,
            "Type" => null,
    );
    $Name = filter_input(INPUT_POST, "ProductName", FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, "ProductPrice", FILTER_VALIDATE_FLOAT);
    $Type = filter_input(INPUT_POST, "ProductType", FILTER_SANITIZE_STRING);
    $Colour = filter_input(INPUT_POST, "ProductColour", FILTER_SANITIZE_STRING);
    $Age = filter_input(INPUT_POST, "ProductAge", FILTER_VALIDATE_INT);
    $cd['Name'] = $Name;
    $cd['Price'] = $Price;
    $cd['Colour'] = $Colour;
    $cd['Age'] = $Age;
    $cd['Type'] = $Type;
    //Description and File are both nullable
    if (isset($_POST['ProductDescription'])) {
        $cd['Description'] = filter_input(INPUT_POST, "ProductDescription", FILTER_SANITIZE_STRING);
    }
    if (isset($_FILES['ProductImage'])) {
        //Check if file can be saved
        $cd['imgslug'] = $_FILES['ProductImage']['name'];
    }
    //Proceed to database upload then file saving
    $Database = new Database();
    $sql = "INSERT INTO products (Name, Description, Price, imgslug, Colour, Age, Type, date) VALUES (?, ?, ?, ?, ?, ?, ?, sysdate());";
    if ($query = $Database->conn->prepare($sql)) {
        //Array with keys is used for readability
        if ($query->bind_param("ssdssis", $cd['Name'], $cd['Description'], $cd['Price'], $cd['imgslug'], $cd['Colour'], $cd['Age'], $cd['Type'])) {
            if ($query->execute()) {
                $TempResult = $Database->Select("SELECT ProductID FROM products WHERE Name = ?", array($cd['Name']));
                $Result = $TempResult->fetch_assoc();
                //For use in picture saving
                $ProductID = $Result['ProductID'];
                //Save picture to folder if set
                if ($cd["imgslug"] != null) {
                    //Get temporary save location
                    $TempFileName = $_FILES['ProductImage']['tmp_name'];
                    //Set target directory
                    $target_dir = "../../Media/Products/";
                    //Create directory with product id
                    //Set error message for common if statements
                    $Message = base64_encode("Could not create product!");
                    if (mkdir($target_dir . $ProductID)) {
                        $target_dir = $target_dir . $ProductID . "/";
                        //Move file to product id folder
                        if (!move_uploaded_file($TempFileName, $target_dir . $cd['imgslug'])) {
                            ?>
                            <script>
                                window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                            </script>
                            <?php
                        }
                    } else {
                        ?>
                        <script>
                            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                        </script>
                        <?php
                    }
                }
                $Message = base64_encode("Product successfully added");
                ?>
                <script>
                    window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                </script>
                <?php
            }
        } else {
            $Message = base64_encode("Could not create product!");
            ?>
            <script>
                window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Could not create product!");
        ?>
        <script>
            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
        </script>
        <?php
    }
}
if (isset($_POST['SaveSubmit'])) {
    //Setting keys
    $cd = array(
        "Name" => null,
        "Description" => null,
        "imgslug" => null,
        "Price" => null,
        "Colour" => null,
        "Age" => null,
        "Type" => null,
    );
    //Cleaning Variables
    $Name = filter_input(INPUT_POST, "ProductName", FILTER_SANITIZE_STRING);
    $Price = filter_input(INPUT_POST, "ProductPrice", FILTER_VALIDATE_FLOAT);
    $Type = filter_input(INPUT_POST, "ProductType", FILTER_SANITIZE_STRING);
    $Colour = filter_input(INPUT_POST, "ProductColour", FILTER_SANITIZE_STRING);
    $Age = filter_input(INPUT_POST, "ProductAge", FILTER_VALIDATE_INT);
    $cd['Name'] = $Name;
    $cd['Price'] = $Price;
    $cd['Colour'] = $Colour;
    $cd['Age'] = $Age;
    $cd['Type'] = $Type;
    //Description and File are both nullable
    if (isset($_POST['ProductDescription'])) {
        $cd['Description'] = filter_input(INPUT_POST, "ProductDescription", FILTER_SANITIZE_STRING);
    }
    if (isset($_FILES['ProductImage'])) {
        //Check if file can be saved
        $cd['imgslug'] = $_FILES['ProductImage']['name'];
    }
    //Proceed to database upload then file saving
    $Database = new Database();
    $sql = "UPDATE products SET Name = ?, Price = ?, Type = ?, Colour = ?, Age = ?, Description = ?, imgslug = ?, ModifiedDate = ? WHERE ProductID = ?;";
    if ($query = $Database->conn->prepare($sql)) {
        //Array with keys is used for readability
        //DD-MM-YYYY
        $Date = $_POST['ModDate'];
        if ($query->bind_param("sdssisssi", $cd['Name'], $cd['Price'], $cd['Type'], $cd['Colour'], $cd['Age'], $cd['Description'], $cd['imgslug'], $Date, $_REQUEST['id'])) {
            if ($query->execute()) {
                if ($cd["imgslug"] != null) {
                    //Get temporary save location
                    $TempFileName = $_FILES['ProductImage']['tmp_name'];
                    //Set target directory
                    $target_dir = "../../Media/Products/" . $_REQUEST['id'] . "/";
                    //Set error message for common if statements
                    $Message = base64_encode("Could not modify product");
                    if (!move_uploaded_file($TempFileName, $target_dir . $cd['imgslug'])) {
                        ?>
                        <script>
                            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                        </script>
                        <?php
                    }
                }
                $Message = base64_encode("Product successfully modified");
                ?>
                <script>
                    window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
                </script>
                <?php
            } else {

            }
        } else {
            $Message = base64_encode("Could not modify product!");
            ?>
            <script>
                window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
            </script>
            <?php
        }
    } else {
        $Message = base64_encode("Could not modify product!");
        ?>
        <script>
            window.location.href = "https://localhost/admin/home/?message=<?php echo $Message; ?>";
        </script>
        <?php
    }
}