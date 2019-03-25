var arr=[];
// Подсчёт всего
$(document).ready(function () {
    $('#services input:checkbox').click(function () {

        var timeNow = new Date();
        var dayNow = timeNow.getDay();
        // Подсчёт первичной суммы
        var sum = 0;
        $("input:checked").each(function () {
            sum += +$(this).val();
        });
        $('#sum span').html('' + sum + '');
        //подсчёт прожатых чекбоксов
        var checkedSum = ($('#services input:checkbox:checked').length);
        $(result = 0);

        var saleDayCheck = ($('.saleday').text());

        /// подсчёт скидки
        var sale = 0;
        if (checkedSum >= 3) {
            sale = 30;
        } else if (checkedSum == 2) {
            sale += 10;
        }
        /// Дневная скидка
        var output = 0;
        for (var i = 0; i < saleDayCheck.length; i++) {
            var outputSign = saleDayCheck[i];
            if (outputSign == "DayNow") {
                sale += 10;

            }
            ;

        }
        if (sale >= 30) {
            sale = 30;
        }
        var saleFinal = sale;
        $('#salefinal span').html(saleFinal);
        $('input:checkbox:checked').each(function(){

            var clickId = this.id;

            arr.forEach(function(elem) {
                if (elem == clickId) {

                    arr.splice(0,50);
                }
            });
            arr.push(clickId);

            $('#arrIdPost').val(arr);
        });


//подсчёт финальной цены
        var finalPrice = sum - (sum / 100) * saleFinal;
        $('#finalprice span').html(finalPrice);
        $('#finalpriceget').val(finalPrice);
        $('#salefinalget').val(saleFinal);

    });
    $('#basketButton').click(function () {
        $.session.set('arrId', 'arrWithId');
    })
    /*function putIdArr(currentId) {
    if (document.getElementById(currentId).checked) {
        arrWithId[arrWithId.length] = currentId;
        console.log("Добавлен элемент");
        console.log(arrWithId);
    }/*else if (document.getElementById("checkbox").checked == false;){    /// Удаление при снятии чекбокса
                        for(let i = 0; i < arrWithId.length; i++){
                            if(arrWithId[i] == currentId){
                                arrWithId.splice(0, 1);
                                console.log("Удалён элемент");
                                console.log(arrWithId);
                            }
                        }
                    }*/
// } - конец function putIdArr

});// загрузка документа