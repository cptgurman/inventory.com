//Добавление оборудования
$('.item-add-btn').click(function (e) {
    e.preventDefault();

    //удаляем все красные линии
    $(`input`).removeClass('error');

    let item_name = $('input[name="item_name"]').val(),
        item_code = $('input[name="item_code"]').val();

    $.ajax({
        url: 'vendor/add_item.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item_name: item_name,
            item_code: item_code
        },
        // data = php echo
        success(data) {
            console.log(data)

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
                }
            }
        }
    });
});


//Редактирование оборудования
$(document).ready(function () {
    $("button").click(function () {
        var currentRow = $(this).closest("tr");

        var col1 = currentRow.find("td:eq(0)").text(); // get current row 1st TD value
        var col2 = currentRow.find("td:eq(1)").text(); // get current row 2nd T
        var data = col1 + "\n" + col2;

        alert(data);
    });
});

//Удаление оборудования

