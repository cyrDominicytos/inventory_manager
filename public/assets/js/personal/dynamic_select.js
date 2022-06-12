var base_url = "<?= base_url() ?>";
$('#product_categories_id').change(function() {
    if ($(this).val() != '') {
        var value = $(this).val();
        $.ajax({
            url: base_url + "/dynamic/product",
            method: "POST",
            data: { id: value },
            success: function(result) {
                $('#product_prices_product_id').html(result);
            }
        })
    }
});

$('#product_prices_product_id').change(function() {
    if ($(this).val() != '') {
        var value = $(this).val();
        $.ajax({
            url: base_url + "/dynamic/sale_options",
            method: "POST",
            data: { id: value },
            success: function(result) {
                $('#product_prices_sales_option_id').html(result);
            }
        })
    }
});