//Весь список оборудования
$(document).ready(function () {

    $.ajax({
        url: 'vendor/get_usage.php',
        type: 'POST',
        dataType: 'json',
        data: 'true',
        // data = php echo
        success(data) {
            for (var i = 0; i < data.length; i++) {
                let status = data[i].date_of_receipt == "NULL" ? 'Выдан' : 'На складе';
                $(".thetable tbody").append('<tr><td>' + data[i].code + '</td><td>' + data[i].item_name +
                    '</td><td>' + data[i].full_name + '</td><td>' + status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary"><i class="bi bi-person-fill">Возврат</button>' + '</td></tr>')
            }

        }
    });

});





//Редактирование оборудования
let id;


$('.editbtn').click(function (e) {
    let currentRow = $(this).closest("tr");
    id = currentRow.attr('id');
    let item_name = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    let item_code = currentRow.find("td:eq(1)").text(); // get current row 2nd T
    console.log(item_name, item_code, id);
    $('.editName').val(item_name);
    $('.editCode').val(item_code);
});



$('.saveEdit').click(function (e) {
    e.preventDefault();

    //удаляем все красные линии
    $(`input`).removeClass('error');

    let item_name = $('.editName').val();
    let item_code = $('.editCode').val();
    console.log('Инпуты' + item_name, item_code, id);
    $.ajax({
        url: 'vendor/edit_item.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item_name: item_name,
            item_code: item_code,
            item_id: id
        },
        // data = php echo
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/inventory.php';
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




//Удаление оборудования

$('.deletebtn').click(function (e) {
    let currentRow = $(this).closest("tr");
    id = currentRow.attr('id');
    let item_name = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
    let item_code = currentRow.find("td:eq(1)").text(); // get current row 2nd T
    console.log(item_name, item_code, id);
    $('.deleteItemName').text(item_name);
    $('.deleteItemCode').text(item_code);
});



$('.deletebtnaccept').click(function (e) {
    e.preventDefault();


    console.log('Инпуты' + id);
    $.ajax({
        url: 'vendor/delete_item.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item_id: id
        },
        // data = php echo
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/inventory.php';
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
