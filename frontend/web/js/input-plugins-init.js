const SUCCESS_COLOR = '#71843f';
const ERROR_COLOR = '#a90329';

$('article select').select2({
    minimumResultsForSearch: Infinity
});

$(".btn-append").popover(
    {
        'title': 'Add new element',
        'html': true,
        'content': '<label class="input"><input type="text"/></label><button class="btn btn-default btn-block btn-popover" type="button"><i class="fa fa-check"></i> Add</button>'
    }
);

$(document).on('click','.btn-popover', function () {
    var select = $(this).parent().parent().next().find("select");
    var value = $(this).prev().find("input").val();

    var selectName = select.prop('name');

    var baseModel = selectName.substring(0, selectName.indexOf('[')).toLowerCase();
    var field = selectName.substring(selectName.indexOf('[') + 1, selectName.indexOf('_id]'));

    if (baseModel !== 'customer') baseModel = baseModel.replace('customer', '');

    // field name can start from base model name, but related model won't start with two same words
    // example: Customer[customer_status_id] => customer_status => CustomerStatus (not CustomerCustomerStatus)
    var modelName = (baseModel !== field.split('_')[0] ? baseModel + '_' : '').concat(field);

    // disable button
    $(this).prop('disabled', 'disabled');
    $('i', $(this)).removeClass('fa-check');
    $('i', $(this)).addClass('fa-spinner');
    $('i', $(this)).addClass('fa-pulse');

    $.ajax({
        url: '{$model_add_ajax_url}',
        method: 'post',
        data: {
            name: modelName,
            title: value
        },
        type: 'json',
        context: this
    })
        .done(function(response) {
            select.append(
                $('<option/>', { value: response.id, text: value })
            );
            select.trigger('change');

            $.toast({
                heading: 'Element Added',
                text: 'New element added successfully - check the list',
                icon: 'info',
                loader: false,
                loaderBg: SUCCESS_COLOR,
                position: 'top-right'
            });
        })
        .fail(function() {
            $.toast({
                heading: 'Error',
                text: 'Element was not added. Try to repeat your request or refresh the page',
                icon: 'error',
                loader: false,
                loaderBg: ERROR_COLOR,
                position: 'top-right'
            });
        })
        .complete(function() {
            // enable button
            $(this).prop('disabled', false);
            $('i', $(this)).addClass('fa-check');
            $('i', $(this)).removeClass('fa-spinner');
            $('i', $(this)).removeClass('fa-pulse');

            $(this).parent().parent().popover('hide');
        });
});