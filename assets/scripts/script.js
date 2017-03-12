$('document').ready(function () {
    $('#form-login').validate({
        rules: {
            user: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            user: {
                required: 'Favor informar o seu Usuário'
            },
            password: {
                required: 'Favor informar a sua Senha'
            }
        },
        submitHandler: submitForm
    });

    function submitForm() {
        var data = $('#form-login').serialize();

        $.ajax({
            type: 'POST',
            url: 'includes/process_login.php',
            data: data,
            beforeSend: function () {
                $('#error').fadeOut();
                $('#btn-login').html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Enviando...');
            },
            success: function (response) {
                if (response=='ok') {
                    $('#btn-login').html('<img src="../../assets/images/btn-ajax-loader.gif" /> &nbsp; Entrando...');
                    setTimeout('window.location.href="../../home.php";', 4000);
                } else {
                    $('#error').fadeIn(1000, function () {
                        $('#error').html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
                        $('#btn-login').html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Entrar');
                    });
                }
            }
        });
        return false;
    }
});
