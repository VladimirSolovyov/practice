//тычок по тычке - обработка установки
function change_price_cb_handler() {
    if (jqWar("select[name=pst_marketing_id] option").length > 1) {
        jqWar("select[name=pst_marketing_id]")[0].parentNode.parentNode.setStyle("display", "table-row");
    } else {
        jqWar("select[name=pst_marketing_id]")[0].parentNode.parentNode.setStyle("display", "none");
    }
    if (!(jqWar("select[name=pst_marketing_id]")[0].selectedIndex > 0)) {
        jqWar("select[name=pst_marketing_id]")[0].selectedIndex = 0;
    }
    dest_input.value = jqWar("select[name=pst_marketing_id] option[value=" + jqWar("select[name=pst_marketing_id]")[0].value + "]")[0].getAttribute("destination");
}

var def_dest, select_provider, change_price_cb, dest_input;

var allChecked = false;
function checkAll() {

    var checkboxes = parent.frames.position_list.document.querySelectorAll(".col_control [type='checkbox']");

    if (checkboxes.length > 0) {
        allChecked = !allChecked;
        for (var i = 0; i < checkboxes.length; i++) {

            checkboxes[i].checked = allChecked;
        }
    }
}

jqWar(document).ready(function () {

    jqWar("select[name=actionType]").bind("change", function () {
        if (this.form.newState) {
            this.form.newState.selectedIndex = 0;
        }

        Array.prototype.forEach.call(document.getElementsByClassName('more_option'), function (el) {
            el.style.display = 'none';
        });

        var optionBlock = document.getElementById(this.value);
        if (optionBlock) {
            optionBlock.style.display = 'table-cell';
        }

        var actionComment = document.getElementById('action-comment');
        var actionCommentShow = false;
        if (this.options[this.selectedIndex].getAttribute('commented')) {
            actionCommentShow = true;
        }
        if (actionComment) {

            if (actionCommentShow) {
                actionComment.classList.add('action-comment_show');
            } else {
                actionComment.classList.remove('action-comment_show');
            }
            document.getElementsByName('log_comment')[0].value = '';
        }

        var withChangeProviderBlock = document.getElementById('with_change_provider');
        if (withChangeProviderBlock) {
            if (this.value == "changeProvider") {
                withChangeProviderBlock.style.display = "table-cell";
            } else {
                withChangeProviderBlock.style.display = "none";
            }
        } else {
            if (this.value == "changeProvider") {
                jqWar("[name=proceedAction]").hide();
            } else {
                jqWar("[name=proceedAction]").show();
            }
        }
    });

    var commentBlock = jqWar("#action-comment__block");
    var commentArea = jqWar('[name=log_comment]');
    jqWar("#action-comment__icon").click(function () {
        commentBlock.toggleClass("action-comment__block_show");
    });

    commentArea.blur(function () {
        commentBlock.removeClass("action-comment__block_show");
    });

    select_provider = jqWar("select[name=new_provider_id]")[0];
    if (!select_provider) {
        return;
    }
    dest_input = jqWar("input[name=pst_destination]")[0];

    jqWar("select[name=pst_marketing_id]")[0].parentNode.parentNode.setStyle("display", "none");
    def_dest = dest_input.value;

    jqWar("select[name=new_provider_id]").bind("change", function () {
            jqWar.ajax({
                type: "POST",
                url: '/admin/eshop/orders/positions_list.html?subj=edittable_form1&fn=edit&pst_id=5526&_prid=1&pst_provider_id=' + jqWar("select[name=new_provider_id]")[0].value + '&send=Y',
                success: function (resp) {
                    var tmp = jqWar(resp);
                    jqWar('select[name=pst_marketing_id]').html(tmp.find('select[name=pst_marketing_id]').html());
                    jqWar("select[name=pst_marketing_id]")[0].selectedIndex = 0;
                    change_price_cb_handler();
                    return false;
                }
            });
        }
    );

    jqWar("select[name=pst_marketing_id]").bind("change", function (el) {

        dest_input.value = this.selectedOptions[0].getAttribute("destination");
    });

    jqWar("[name=action]").submit(function () {
        this.submit();
        jqWar("[name=log_comment]").val('');
        return false;
    });
	
	
	
	
	// Скрытие фильтра в позициях заказа - оказалось лишнее
    /*jqWar("table.clear").eq(0).find('a').text('Отобразить');
    jqWar("#filter_table").css('display','none');
    hideFrameset();*/
    console.log(1);
    debugger;

    // скрываем лишнии статусы 25/01/18
    jqWar("#stt_id option").eq(3).css('display','none'); //отказ брак товара
    jqWar("#stt_id option").eq(15).css('display','none'); //В пути
    jqWar("#stt_id option").eq(18).css('display','none'); //"Заказ принят поставщиком"
    jqWar("#stt_id option").eq(22).css('display','none'); //"Идет сборка"
    jqWar("#stt_id option").eq(23).css('display','none'); //"Куплен"
    jqWar("#stt_id option").eq(26).css('display','none'); //"На складе МСК"
    jqWar("#stt_id option").eq(29).css('display','none'); //"Отказ:некорректная замена поставщика"
    jqWar("#stt_id option").eq(30).css('display','none'); //"Отказ:отсутствие на складе поставщика"
    jqWar("#stt_id option").eq(35).css('display','none'); //"Доставлен в точку выдачи"
	
});