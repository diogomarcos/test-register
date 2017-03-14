$(document).ready(function () {
    $('.delete').click(function (e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var parent = $(this).parent("td").parent("tr");

        bootbox.dialog({
            message: "Tem certeza de que deseja excluir?",
            title: "<i class='glyphicon glyphicon-trash'></i> Excluir Cliente",
            buttons: {
                success: {
                    label: "Não",
                    className: "btn-success",
                    callback: function () {
                        $('.bootbox').modal('hide');
                    }
                },
                danger: {
                    label: "Sim",
                    className: "btn-danger",
                    callback: function () {
                        $.post('includes/delete-cliente.php', {'delete': id})
                            .done(function (response) {
                                bootbox.alert(response);
                                parent.fadeOut('slow');
                            })
                            .fail(function () {
                                bootbox.alert('Ocorreu algum erro...');
                            })

                    }
                }
            }
        });
    });
});