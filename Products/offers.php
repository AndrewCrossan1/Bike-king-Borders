<?php
    //Page Description: Provides the user with special offers which can be used for discounts, discounts on certain products or just information on current sales.

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Products";

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Offers";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('../Scripts/header.php');