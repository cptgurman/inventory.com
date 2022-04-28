//Добавление сотрудника
$('.employee-add-btn').click(function (e) {
    e.preventDefault();

    //удаляем все красные линии
    $(`input`).removeClass('error');

    let
        full_name = $('input[name="full_name"]').val(),
        inn = $('input[name="inn"]').val(),
        phone = $('input[name="phone"]').val(),
        email = $('input[name="email"]').val(),
        position = $('input[name="position"]').val(),
        section = $('input[name="section"]').val();
    console.log(full_name, inn, phone);

    $.ajax({
        url: 'vendor/add_employee.php',
        type: 'POST',
        dataType: 'json',
        data: {
            full_name: full_name,
            inn: inn,
            phone: phone,
            email: email,
            position: position,
            section: section,
        },
        // data = php echo
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/employees.php';
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


//Редактирование сотрудника
let id;

$('.employee-edit-btn').click(function (e) {
    let currentRow = $(this).closest("tr");
    id = currentRow.attr('id');
    let edit_full_name = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    let edit_inn = currentRow.find("td:eq(1)").text(); // get current row 2nd T
    let edit_phone = currentRow.find("td:eq(2)").text(); // get current row 2nd T
    let edit_email = currentRow.find("td:eq(3)").text(); // get current row 2nd T
    let edit_position = currentRow.find("td:eq(4)").text(); // get current row 2nd T
    let edit_section = currentRow.find("td:eq(5)").text();
    console.log(edit_full_name, edit_inn, edit_phone, edit_email, edit_position, edit_section);
    $('.edit_full_name').val(edit_full_name);
    $('.edit_inn').val(edit_inn);
    $('.edit_phone').val(edit_phone);
    $('.edit_email').val(edit_email);
    $('.edit_position').val(edit_position);
    $('.edit_section').val(edit_section);
});



$('.employee-save-edit-btn').click(function (e) {
    e.preventDefault();

    console.log('Инпуты' + id);
    $.ajax({
        url: 'vendor/edit_employee.php',
        type: 'POST',
        dataType: 'json',
        data: {
            full_name: $('.edit_full_name').val(),
            inn: $('.edit_inn').val(),
            phone: $('.edit_phone').val(),
            email: $('.edit_email').val(),
            position: $('.edit_position').val(),
            section: $('.edit_section').val(),
            id: id,
        },
        // data = php echo
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/employees.php';
            } else {

                //false true
                $('.msg').removeClass('none').text(data.message)
                if (data.type === 1) {
                    data.fields.forEach((field) => {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                    $('.msg').removeClass('none').text(data.message)
                    console.log(data.fields);

                }
            }
        }
    });
});




//Удаление сотрудника

$('.employee-delete-btn').click(function (e) {
    let currentRow = $(this).closest("tr");
    id = currentRow.attr('id');
    let employee_full_name = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    $('.delete-employee-text').text(employee_full_name);
});



$('.employee-delete-accept-btn').click(function (e) {
    e.preventDefault();


    console.log('Инпуты' + id);
    $.ajax({
        url: 'vendor/delete_employee.php',
        type: 'POST',
        dataType: 'json',
        data: {
            employee_id: id
        },
        // data = php echo
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/employees.php';
            } else {

                //false true
                $('.msg').removeClass('none').text(data.message)
                if (data.type === 1) {
                    data.fields.forEach((field) => {
                        $(`input[name="${field}"]`).addClass('error');
                    });
                    $('.msg').removeClass('none').text(data.message)
                    console.log(data.fields);

                }
            }
        }
    });
});
