

function recaptchaCallback() {
    if (grecaptcha.getResponse().length > 0) {
        submit_form_revenda();
    } else {
        swal({
            title: "Confirme a validação do captcha antes de prosseguir.",
            icon: "error",
        });
    }
}

/*
 * function isValidEmailAddress
 * @parameters email
 * Função com expressão regular para verificação do e-mail inserido no campo, se possui um formato válido.
 */

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
}

/*
 * function submit_form_revenda
 * @parameters name, email, grecaptcha
 * Função de submit do formulário recebendo internamente os parâmetros do nome, e-mail e se o captcha foi assinalado corretamente.
 */

function submit_form_revenda() {
    var name = $("#name_news").val();
    var email = $("#email_news").val();

    if (name === "") {
        swal({
            title: "O campo nome não pode ser vazio.",
            icon: "error",
        });
    } else if (email === "") {
        swal({
            title: "O campo e-mail não pode ser vazio.",
            icon: "error",
        });
    } else if (!isValidEmailAddress(email)) {
        swal({
            title: "Preencha o campo e-mail com um valor válido.",
            icon: "error",
        });
    } else {
        var token = $("#token").val();
 
        if (token === "") {
            swal({
                title: "É preciso inserir os dados de acesso.",
                icon: "error",
            });
        } else {

            var settings = {
                async: true,
                crossDomain: true,
                url: "https://api.traveltec.com.br/serv/marketing/cadastro_revenda",
                method: "POST",
                headers: {
                    token: token,
                    name: name,
                    email: email,
                    "cache-control": "no-cache",
                },
            };

            $.ajax(settings).done(function (response) {
                if (response.errors) {
                    swal({
                        text: response.message,
                        icon: "error",
                    });

                    $("#name_news").val("");
                    $("#email_news").val("");
                } else {
                    swal({
                        text: response.message,
                        icon: "success",
                    });

                    $("#name_news").val("");
                    $("#email_news").val("");
                }
            });

        } 
    }
} 