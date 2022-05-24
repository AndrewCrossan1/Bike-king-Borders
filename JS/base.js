$(document).ready(function() {
    $("#PriceRange").change(function() {
        document.getElementById('PriceRangeLabel').innerText = `Price Range: £0 - £${$(this).val()}`;
    });
    $(document).keydown(function(event) {
        //Decide what to do based on key pressed
        if (event.ctrlKey) {
            event.stopPropagation();
            event.preventDefault();
            switch (event.key) {
                case 'h':
                    window.location.href = "/home/";
                    break;
                case 'p':
                    window.location.href = '/products/';
                    break;
                case 'b':
                    window.location.href = '/basket/';
                    break;
                case 'l':
                    window.location.href = '/localarea/';
                    break;
                case 'a':
                    window.location.href = '/account/login/';
                    break;
                case 'c':
                    window.location.href = '/contact/';
                    break;
                case 'g':
                    window.location.href = '/gallery/';
                    break;
                case 'm':
                    window.location.href = '/admin/';
                    break;
            }
        }
    });
});


