$(document).ready(function() {
    $("#PriceRange").change(function() {
        document.getElementById('PriceRangeLabel').innerText = `Price Range: £0 - £${$(this).val()}`;
    });
});
