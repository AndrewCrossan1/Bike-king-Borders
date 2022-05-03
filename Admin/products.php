<?php
session_start();

//Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
$PageTitle = "Manage Products";

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
<section id="header">
    <div class="container-fluid bg-dark text-light p-5">
        <div class="jumbotron">
            <h1 class="display-5"><?php echo $PageTitle; ?></h1>
            <p class="lead">Add, update or remove products from the shop</p>
        </div>
    </div>
</section>

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
                                <a class="nav-link text-light" href="/admin/home/">Home</a>
                            </li>
                            <hr style="color: white;"/>
                            <li class="nav-item">
                                <a class="nav-link text-light active" aria-selected="true" href="/admin/products/">Products</a>
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
        <div class="col-md-10 col-12">
            <!--Main content-->
            <?php
            if (isset($_REQUEST['message'])) {
                functions::SendMessage(base64_decode($_REQUEST['message']));
            }
            ?>
            <div class="container-fluid p-3">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-12">
                        <div class="card bg-white border border-primary p-3 my-2">
                            <div class="card-body">
                                <table class="table table-striped table-hover table-responsive">
                                    <thead class="bg-dark text-white text-left">
                                    <th>ProductID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Colour</th>
                                    <th>Age</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $array = AdminFunctions::GetProducts(25);
                                    while ($row = $array->fetch_assoc()) {?>
                                        <tr>
                                            <td><?php echo $row['ProductID']; ?></td>
                                            <td><?php echo $row['Name']; ?></td>
                                            <td><?php echo $row['Description']; ?></td>
                                            <td><?php echo $row['Price']; ?></td>
                                            <td><?php echo $row['Colour']; ?></td>
                                            <td><?php echo $row['Age']; ?></td>
                                            <td><?php echo $row['Type']; ?></td>
                                            <td>
                                                <a href="/admin/product/edit/id=<?php echo $row['ProductID'];?>"><i class="fa fa-pencil text-dark"></i></a>
                                                <a href="/admin/product/delete/id=<?php echo $row['ProductID'];?>"><i class="fa fa-trash-can text-dark"></i></a>
                                                <a href="/product/view/id=<?php echo $row['ProductID'];?>"><i class="fa fa-magnifying-glass text-dark"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot class="text-center bg-dark">
                                    <tr>
                                        <td colspan="100"><a class="btn btn-outline-light w-100 p-3 m-0" href="../ProductFunctions/Add.php">Add Product</a></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
