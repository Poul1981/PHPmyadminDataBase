// let removeBtn = document.getElementsByClassName('remove');
$(function () {
    let btn = $(".add");//формочка
    let popup = $(".popup");
    let pop_content = $(".popup_content");
    let closed = $(".popup_close");
    let removeBtn = $(".remove");
    let sendButton = $("#sendMail");
    let sendForm = $("#append");

    //обработчик на добавление юзера
    btn.on("click", popapActive);
    //обработчик на закрытие формы
    closed.on("click", popupClose);

    //удаление из базы данных 1 строки
    removeBtn.on("click", deleteRow);

    function deleteRow() {
        let btn = $(this);
        popapActiveDel();
        $(".yes").on("click", function () {
            let clickedID = btn.attr("id");
            // console.log("cliked ID", clickedID);
            let action = 'delete';
            let message = { id: clickedID, act: action };
            // console.log(message);
            $.ajax({
                url: 'delete.php',
                method: "POST",
                data: message,
                success: function (data) {
                    // console.log("from delete", data);
                    btn.off("click");
                    btn.parent().parent().hide(200);
                    popupCloseDel();
                }
            });
        });
        $(".no").on("click", function () {
            popupCloseDel();
            $(".yes").off("click");
        });
    }

    ////открыть модальное окно
    function popapActive() {
        popup.addClass("active");
        pop_content.addClass("active");
    }
    ///подтверждение удaления
    function popapActiveDel() {
        $(".popup_del").addClass("active");
        $(".popup_content_del").addClass("active");
    }

    //// закрыть модальное окно
    function popupClose() {
        popup.removeClass("active");
        pop_content.removeClass("active");
    }
    //закрыть окно удаления
    function popupCloseDel() {
        $(".popup_del").removeClass("active");
        $(".popup_content_del").removeClass("active");
    }

    ///отправка формы на сервер
    sendForm.submit(function (e) {
        e.preventDefault();
        let arrySand = new FormData(this)
        // let arrySand = $(this).serialize();
        popupClose();
        $.ajax({
            url: 'addNewUser.php',
            type: "POST",
            data: arrySand,
            dataType: 'html',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: () => {
                sendButton.prop("disabled", true);
                sendButton.css("background-color", "grey");
                // alert("Данные отправлены");
                // console.log("arrySand=", arrySand);
            },
            success: function (data) {
                let ndata = JSON.parse(data);
                //console.log(JSON.parse(data));
                $("#table_body").append(
                    `<tr class="new_row">
                    <td>${ndata['ID']}</td>
                    <td>${ndata['family']}</td>
                    <td>${ndata['name']}</td>
                    <td>${ndata['patronymic']}</td>
                    <td>${ndata['e-mail']}</td>
                    <td>${ndata['country']}</td>
                    <td>${ndata['sity']}</td>
                    <td>${ndata['login']}</td>
                    <td>${ndata['password']}</td>
                    <td><div class="btn remove" id=${ndata['ID']}>Удалить</div></td>
                </tr>`
                );
                sendForm.trigger('reset');
                sendButton.prop("disabled", false);
                sendButton.css("background-color", "#99c719");
                $(".remove").on("click", deleteRow);//
            },
        });
        return false;
    });

    ///import file exel
    $(".load_form").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: "import.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.  
            cache: false,                // To unable request pages to be cached  
            processData: false,          // To send DOMDocument or non processed data file it is set to false  
            success: function (data) {
                // console.log(data);
                if (data == 'Error1') {
                    alert("Неверный формат файла!");
                }
                else if (data == "Error2") {
                    alert("Выберите файл.");
                }
                else {
                    $("#table_body").empty();
                    $("#table_body").append(data);
                    $(".remove").on("click", deleteRow);
                }
            }
        })
    });

    //показывает название файла выбранного пользователем
    $('#load_btn').change(function () {
        $('.load').text($('#load_btn')[0].files[0].name)
        $('.load').css('color', '#f0cc2e');
    });
})