$(document).ready(function () {
    $('#product-modal-btn').on('click', function () {
        $('#product-modal').modal('show')
            .find('#product-modal-content')
            .load($(this).attr('value'));
    });
});
