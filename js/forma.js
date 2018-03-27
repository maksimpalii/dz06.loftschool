$('.order__form-button_submit').on('click', function (e) {
    e.preventDefault();
    $.ajax({
        url: 'submit',
        type: 'post',
        // data:{
        //     id:superperemenaya
        // },
        data: $('#order-form').serialize()
        //dataType:'json'
    }).done(function (resultat) {
        //console.log(resultat);
        switch (resultat) {
            case 'not empty':
                $('.error-message').html('Не все поля заполнены!');
                $('#error').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'Message could not be sent':
                $('.error-message').html('Сообщение не было отправлено!');
                $('#error').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'captcha no':
                $('.error-message').html('Капча не пройдена!');
                $('#error').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'registration':
                $('#success .status-popup__message').html('Регистрация успешна!');
                $('#success').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'autorisation':
                $('#success .status-popup__message').html('Авторизация успешна!');
                $('#success').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'message':
                $('#success .status-popup__message').html('Сообщение отправлено!');
                $('#success').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            case 'message & registration':
                $('#success .status-popup__message').html('Сообщение отправлено и зарегистрированы!');
                $('#success').css({
                    'display': 'block', 'position': 'fixed', 'top': '50%', 'left': '50%',
                    '-webkit-transform': 'translate(-50%, -50%)',
                    '-ms-transform': 'translate(-50%, -50%)',
                    'transform': 'translate(-50%, -50%)', 'background': '#ffffff'
                });
                break;
            default:
                break;
        }
    })

});

$('.status-popup__close').on('click', function (e) {
    e.preventDefault();
    $('.status-popup').css({'display': 'none'});
});