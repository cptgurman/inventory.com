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
                let status = typeof (data[i].date_of_receipt) == "object" ? 'Выдан' : 'На складе';
                console.log(data[i]);
                if (status == 'Выдан') {
                    $(".thetable tbody").append('<tr id=' + data[i].id + '><td>' + data[i].code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary" id="back-btn">Возврат</button>' + '</td></tr>')
                } else {
                    $(".thetable tbody").append('<tr><td>' + data[i].code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + status + '</td><td>' + data[i].date_of_issue + '</td></tr>')
                }
            }
        }
    });
});


//Выдать оборудование
$(".usage-add-btn").click(function (e) {
    let item_id = $(".select-item").val();
    let employee_id = $(".select-employee").val();
    $.ajax({
        url: 'vendor/add_usage.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item_id: item_id,
            employee_id: employee_id
        },
        // data = php echo
        success(data) {
            for (var i = 0; i < data.length; i++) {
                let status = data[i].date_of_receipt == "NULL" ? 'Выдан' : 'На складе';
                $(".thetable tbody").append('<tr><td>' + data[i].code + '</td><td>' + data[i].item_name +
                    '</td><td>' + data[i].full_name + '</td><td>' + status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary" id="back-btn"><i class="bi bi-person-fill">Возврат</button>' + '</td></tr>')
            }
        }
    });
});

//Возврат оборудования
$(document).on("click", "#back-btn", function () {
    let currentRow = $(this).closest("tr");
    item_usage_id = currentRow.attr('id');

    $.ajax({
        url: 'vendor/back_usage.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item_usage_id: item_usage_id,
        },
        success(data) {
            //add true
            if (data.status) {
                document.location.href = '/usage.php';
            }
        }
    });
});
