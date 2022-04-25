
// Авторизация

//Нажатие кнопки
$('.login-btn').click(function (e) {
    e.preventDefault();

    //удаляем все красные линии
    $(`input`).removeClass('error');

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        // data = php echo
        success(data) {
            console.log(data)

            //login true
            if (data.status) {
                document.location.href = '/profile.php';
            } else {

                //false true
                $('.msg').removeClass('none').text(data.message)
                if (data.type === 1) {
                    data.fields.forEach((field) => {
                        $(`input[name="${field}"]`).addClass('error');
                    });


                    $('.msg').removeClass('none').text(data.message)
                }
            }
        }
    });
});



//Ава с поля

let avatar = false;


$('input[name="avatar"]').change((e) => {
    avatar = e.target.files[0];
});




// Регистрация
$('.register-btn').click(function (e) {
    e.preventDefault();

    //удаляем все красные линии
    $(`input`).removeClass('error');

    let full_name = $('input[name="full_name"]').val(),
        login = $('input[name="login"]').val(),
        email = $('input[name="email"]').val(),
        password = $('input[name="password"]').val(),
        password_confirm = $('input[name="password_confirm"]').val();



    let formData = new FormData();

    formData.append('login', login);
    formData.append('full_name', full_name);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);
    formData.append('avatar', avatar);


    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        // data = php echo
        success(data) {
            console.log(data)

            //login true
            if (data.status) {
                document.location.href = '/profile.php';
            } else {

                //false true
                $('.msg').removeClass('none').text(data.message)
                if (data.type === 1) {
                    data.fields.forEach((field) => {
                        $(`input[name="${field}"]`).addClass('error');
                    });

                    $('.msg').removeClass('none').text(data.message)
                }
            }
        }
    });
});
