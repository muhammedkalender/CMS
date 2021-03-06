//region Form Check

function checkForm(form) {
    form = $(form);

    var isValid = true;
    var isModalLoader = $(form).attr('modal-loader') == null ? false : true;
    var isCardLoader = $(form).attr('card-loader') == null ? false : true;

    $(form.find('input')).each(
        function (index) {


            //   $isValid = false;
        }
    );

    if (isValid) {
        if (isModalLoader) {
            showModalOverlay($(form).attr('modal-loader'));
        } else if (isCardLoader) {
            showCardOverlay(form);
        } else {
            //NOTE LOADER OLMAYACAK FULL PAGE İÇİN
        }

        $.ajax({
            'url': form.attr('action'),
            'method': form.attr('method'),
            'data': form.serializeArray(),
            success: function (response) {
                response = JSON.parse(response);

                if (response.status) {
                    formSuccess(form, response.message);

                    if (form.attr('submit-redirect') != null) {
                        if (form.attr('submit-delay') != null) {
                            setTimeout(function () {
                                window.location.href = form.attr('submit-redirect');
                            }, form.attr('submit-delay'));
                        } else {
                            window.location.href = form.attr('submit-redirect');
                        }
                    }

                    if (form.attr('submit-clear') != null) {
                        clearForm(form);
                    }

                    if(form.attr('call-function') != null){
                        window[form.attr('call-function')](response.data);
                    }

                    if (form.attr('submit-datatable') != null) {
                        $('#' + form.attr('submit-datatable')).DataTable().ajax.reload();
                    }
                } else {
                    formError(form, response.message);
                }

                if (isModalLoader) {
                    hideModalOverlay($(form).attr('modal-loader'));
                } else if (isCardLoader) {
                    hideCardOverlay(form);
                } else {
                    hideLoader();
                }
            },
            error: function () {
                formError(form, langErrorSystem);

                if (isModalLoader) {
                    hideModalOverlay($(form).attr('modal-loader'));
                } else if (isCardLoader) {
                    hideCardOverlay(form);
                } else {
                    hideLoader();
                }
            }
        });
    }

    return false;
}

function formError(form, message) {
    $(form).find('#message').html('<div class="alert alert-danger alert-dismissible">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
        '<h4><i class="icon fa fa-check"></i> ' + langErrorTitle + '</h4>' + message +
        '</div>');

    var formID = $(form).attr('id');

    if(formID == null){
        window.location.href = '#message';
    }else{
        window.location.href = '#'+formID;
    }
}

function formSuccess(form, message) {
    $(form).find('#message').html('<div class="alert alert-success alert-dismissible">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
        '<h4><i class="icon fa fa-check"></i> ' + langSuccessTitle + '</h4>' + message +
        '</div>');

    var formID = $(form).attr('id');

    if(formID == null){
        window.location.href = '#message';
    }else{
        window.location.href = '#'+formID;
    }
}

//endregion

//region Form Clear

function clearForm(form) {
    form = $(form);

    $(form.find('input')).each(
        function (index) {
            if (!($(this).attr('name') == 'call_category' || $(this).attr('name') == 'call_request' || $(this).attr('const'))){
                $(this).val('');
            }
        }
    );

    $(form.find('textarea')).each(
        function (index) {
            $(this).val('');
        }
    );

    $(form.find('select')).each(
        function (index) {
            if ($(this).attr('default-option') == null || $(this).attr('default-option') == '') {
                $(this).val('');
            } else {
                $(this).val($(this).attr('default-option'));
            }

        }
    );

    form.find('#message').html('');
}

//endregion

//region Form To View

function formToView(formID) {
    var form = $('#' + formID);

    $(form.find('input, textarea, select')).each(
        function (index) {
            if ($(this).attr('type') == 'submit') {
                $(this).remove();
                return true;
            }

            if ($(this).attr('type') == 'hidden') {
                $(this).remove();
                return true;
            }

            if ($(this).attr('type') == 'checkbox') {
                $(this).prop('disabled', 'true');
                return true;
            }

            if (!$(this).attr('name')) {
                return true;
            }

            var html = '<div class="form-control>"<label>' + ($(this).val() ? $(this).val() : '-') + '</label></div>';

            if ($(this).attr('data-inputmask-alias')) {
                $($(this).parent()).html(html);
            } else {
                $($(this).parent()).append(html);
            }

            $(this).remove();
        }
    );
}

//endregion

//region Form Load

function loadInputsFromObject(formID, object, prefix = '', deleteKey = '') {
    form = $('#' + formID);

    $(form.find('input')).each(
        function (index) {
            if ($(this).attr('type') == 'checkbox') {
                return true;
            }

            if (object[prefix + $(this).attr('name')] != null) {
                $(this).val(object[prefix + $(this).attr('name')]);
            }
        }
    );

    $(form.find('input[type=checkbox]')).each(
        function (index) {
            if (object[prefix + $(this).attr('name')] != null) {
                if (object[prefix + $(this).attr('name')] == 1) {
                    $(this).prop('checked', true);
                } else {
                    $(this).prop('checked', false);
                }
            }
        }
    );

    $(form.find('textarea')).each(
        function (index) {
            if (object[prefix + $(this).attr('name')] != null) {
                $(this).val(object[prefix + $(this).attr('name')]);
            }
        }
    );

    $(form.find('select')).each(
        function (index) {
            if (object[prefix + $(this).attr('name')] != null) {
                $(this).val(object[prefix + $(this).attr('name')]);
            }
        }
    );

    //[0, 1, 2, 3] => Nothing, Pending, Accept, Declined || [NULL, X] => Noting, Accept
    $(form.find('.inputStatus')).each(
        function (index) {
            if (object[prefix + $(this).attr('data-name')] != null) {
                if (object[prefix + $(this).attr('data-name')] === '0') {
                    $(this).html('<label class="badge badge-info">' + langStatusNothing + '</label>');
                } else if (object[prefix + $(this).attr('data-name')] == '1') {
                    $(this).html('<label class="badge badge-warning">' + langStatusPending + '</label>');
                } else if (object[prefix + $(this).attr('data-name')] == '2') {
                    $(this).html('<label class="badge badge-success">' + langStatusAccepted + '</label>');
                } else if (object[prefix + $(this).attr('data-name')] == '3') {
                    $(this).html('<label class="badge badge-danger">' + langStatusDeclined + '</label>');
                } else if (object[prefix + $(this).attr('data-name')]) {
                    $(this).html('<label class="badge badge-success">' + langStatusAccepted + '</label>');
                } else {
                    $(this).html('<label class="badge badge-info">' + langStatusNothing + '</label>');
                }
            } else {
                $(this).html('<label class="badge badge-info">' + langStatusNothing + '</label>');
            }
        }
    );


    if (deleteKey != '') {
        $(form.find('.objectName')).html(object[prefix + deleteKey]);
    }
}

//endregion

//region Date Format

function formatOnlyDate(datetime) {
    if (datetime == null || datetime == '') {
        return '-';
    }

    var _arrDate = datetime.split(' ');

    if (_arrDate.length != 2) {
        return '-';
    }

    return _arrDate[0];
}

function formatDMYOnlyDate(datetime, splitter = '-') {
    var _dateTime = formatOnlyDate(datetime);

    if (_dateTime == '-') {
        return '-';
    }

    var _arrDateTime = _dateTime.split('-');

    if (_arrDateTime.length != 3) {
        return '-';
    }

    return _arrDateTime[2] + splitter + _arrDateTime[1] + splitter + _arrDateTime[0];
}

//endregion

//region Modal Overlay

function showModalOverlay(name) {
    $('#' + name).find('.modal-body').append(
        '<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
    );
}

function hideModalOverlay(name) {
    $('#' + name).find('.overlay').remove();
}

//endregion

//region Card Overlay

function showCardOverlay(form) {
    $($(form).parent().parent()).append(
        '<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
    );
}

function hideCardOverlay(form) {
    $($(form).parent().parent()).find('.overlay').remove();
}

//endregion

//region Dialog Error

var lockDialogError = false;

function dialogError(message, title = '', redirect = '') {
    $($('#modal-dialog-error').find('.modal-body')[0]).html(message);

    if (title) {
        $($('#modal-dialog-error').find('.modal-title')[0]).html(title);
    } else {
        $($('#modal-dialog-error').find('.modal-title')[0]).html(langDialogErrorTitle);
    }

    if (redirect != '' || redirect != null) {
        for (var i = 0; i < 2; i++) {
            $($('#modal-dialog-error').find('button')[i]).on('click', function () {
                lockDialogError = true;
                window.location.href = redirect;
            });
        }
    }
    $('#modal-dialog-error').modal();
}

//endregion

//region Initialize

function initialize() {
    $("#modal-dialog-error").on('hide.bs.modal', function () {
        if (lockDialogError) {
            return;
        }

        $($(this).find('button')[0]).trigger('click');
    });
}

//endregion

//region URL

function internalURL(category, request, additionalValue = '') {
    return "/" + category + "/" + request + (additionalValue ? "/" + additionalValue : "");
}

//endregion

//region Collapse Card

function collapseCard(obj){
    if($(obj).parent().parent().parent().hasClass("collapsed-card")){
        if($(obj).attr('call-function-show') != null){
            window[$(obj).attr('call-function-show')]();
        }

        if($(obj).attr('data-tables')){
            $('#' + $(obj).attr('data-tables')).DataTable().ajax.reload();
        }
    }else{
        if($(obj).attr('call-function-hide') != null){
            window[$(obj).attr('call-function-hide')]();
        }
    }

    if($(obj).parent().parent().find(".card-body").hasClass("show")){
        $(obj).parent().parent().find(".card-body").collapse("hide");
        $(obj).find(".fa-arrow-up").removeClass('fa-arrow-up').addClass("fa-arrow-down");

        if($(obj).attr('call-function-show') != null){
           window[$(obj).attr('call-function-show')]();
        }
    }else{
        $(obj).parent().parent().find(".card-body").collapse("show");
        $(obj).find(".fa-arrow-down").addClass('fa-arrow-up').removeClass("fa-arrow-down");

        if($(obj).attr('call-function-hide') != null){
            window[$(obj).attr('call-function-hide')]();
        }

        if($(obj).attr('data-tables')){
            $('#' + $(obj).attr('data-tables')).DataTable().ajax.reload();
        }
    }

}

//endregion

//region Language

function loadLanguage(select, defaultOption = false){
    var html = "";

    if(defaultOption){
        html = "<option value=''>" + langDefaultOption + "</option>"
    }

    $.ajax({
        'url': '/constants/languages.json',
        'type': 'get',
        'dataType': 'json',
        'success': function(response){
            for(var i = 0; i < response.length; i++){
                html += "<option value='" + response[i].id +"'>"+response[i].text+"</option>";
            }

            $("#" + select).html(html);
        }
    });
}

function loadCountries(select, defaultOption = false){
    var html = "";

    if(defaultOption){
        html = "<option value=''>" + langDefaultOption + "</option>"
    }

    $.ajax({
        'url': '/constants/countries/'+LANG_CODE+'.json',
        'type': 'get',
        'dataType': 'json',
        'success': function(response){
            for(var i = 0; i < response.length; i++){
                html += "<option value='" + response[i].id +"'>"+response[i].text+"</option>";
            }

            $("#" + select).html(html);
        }
    });
}

//endregion