$(function () {
    var dynamicPhone = $('#dynamic-phone');

    $(document).on('click', '#add-input', function () {
        $(dynamicPhone).append(
            '<tr>'+
                '<td>Telefone Extra</td>'+
                '<td><input type="text" name="phone[]" class="form-control phone"></td>'+
                '<td>'+
                    '<a id="remove-input" class="btn btn-danger" href="javascript:void(0)">'+
                        '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>'+
                        'Remover Telefone'+
                    '</a>'+
                '</td>'+
            '</tr>'
        );

        $(this).trigger('mask-it');

        return false;
    });

    $(document).on('click', '#remove-input', function () {
        $(this).parents('tr').remove();
        return false;
    });

    $(document).on('mask-it', function () {
        $('.phone').mask('(00)0000-00009');
    }).trigger('mask-it');
});