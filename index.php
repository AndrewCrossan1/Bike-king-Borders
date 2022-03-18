<?php
    //Author: Andrew Crossan
    //Project Name: Bike King Borders
    //Description: A website for a small bike selling company in the borders of scotland
    //College Year: Year 2

    //Page Description: The home page of the website!

    //Disclaimer:
    //I like leaving whitespace for more readable code so enjoy some satisfyingly well put together PHP.
    //End of disclaimer

    //Set page title for meta-data in header.php (An isset is used in the meta-data to check for this - Overkill because if it's not set I am dumb.)
    $PageTitle = "Home";

    //Set page name for required content in functions.php (Avoids file navigation errors which are extremely annoying - PHP just be smarter :,( )
    //Also keys is in with setting the pages active in header.php (Very fancy)
    $PageName = "Index";

    //Require the header of the page (Includes Navigation, meta-data, etc.)
    require('Scripts/header.php');
?>
