//Весь список оборудования
$(document).ready(function () {


    //url parametrs
    let searchParams = new URLSearchParams(window.location.search)

    let item = searchParams.has('item') ? searchParams.get('item') : -1;
    let name = searchParams.has('name') ? searchParams.get('name') : -1;
    let status = searchParams.has('status') ? searchParams.get('status') : 0;


    console.log("item " + item, "name " + name, "status " + status);
    $.ajax({
        url: 'vendor/filter_usage.php',
        type: 'GET',
        dataType: 'json',
        data: {
            item: item,
            name: name,
            status: status
        },
        // data = php echo
        success(data) {
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);
                if (data[i].status == 'Выдан') {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary" id="back-btn">Возврат</button>' + '</td></tr>')
                } else {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td></tr>')
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
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);
                if (data[i].status == 'Выдан') {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary" id="back-btn">Возврат</button>' + '</td></tr>')
                } else {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td></tr>')
                }
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

//фиьлтр
$(".filter-btn").click(function (e) {
    let item = ($(".item-filter").val() == 'Оборудование') ? -1 : $(".item-filter").val();
    let name = ($(".employee-filter").val() == 'Сотрудник') ? -1 : $(".employee-filter").val();
    let status = ($('#check_status').is(':checked')) ? 1 : 0;
    $.ajax({
        url: 'vendor/filter_usage.php',
        type: 'GET',
        dataType: 'json',
        data: {
            item: item,
            name: name,
            status: status
        },

        success(data) {

            $(".thetable tbody tr").remove()
            console.log(data);
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);
                if (data[i].status == 'Выдан') {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td><td>' + '<button type="button" class="btn btn-primary" id="back-btn">Возврат</button>' + '</td></tr>')
                } else {
                    $(".thetable tbody").append('<tr id=' + data[i].item_id + '><td>' + '<button type="button" class="btn btn-primary logs-btn">?</button>' + '<td>' + data[i].item_code + '</td><td>' + data[i].item_name +
                        '</td><td>' + data[i].full_name + '</td><td>' + data[i].status + '</td><td>' + data[i].date_of_issue + '</td></tr>')
                }
            }
        }
    });
});

$(document).on("click", ".logs-btn", function () {
    let currentRow = $(this).closest("tr");
    item_id = currentRow.attr('id');

    $.ajax({
        url: 'vendor/logs_usage.php',
        type: 'GET',
        dataType: 'json',
        data: {
            item_id: item_id,
        },

        success(data) {
            $(".logstable tbody tr").remove()
            for (var i = 0; i < data.length; i++) {
                console.log(data[i]);

                $(".logstable tbody").append('<tr><td>' + data[i].full_name + '</td><td>' + data[i].date_of_issue + '</td><td>' + data[i].date_of_receipt + '</td></tr>')

            }
        }
    })
    console.log(item_id);
    $('#logsUsage').modal('show');
})


//отчет
$(".excel").click(function (e) {
    $.ajax({
        url: 'vendor/php_excel.php',
        type: 'POST',
        dataType: 'json',
        data: {
            item: "123",
        },

        success(data) {
            console.log(data)
            console.log('отчет создан');
        }
    });
});

