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
        }else if(isCardLoader){
            showCardOverlay(form);
        } else {
            showLoader();
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

                    if (form.attr('submit-datatable') != null) {
                        $('#' + form.attr('submit-datatable')).DataTable().ajax.reload();
                    }
                } else {
                    formError(form, response.message);
                }

                if (isModalLoader) {
                    hideModalOverlay($(form).attr('modal-loader'));
                }else if(isCardLoader){
                    hideCardOverlay(form);
                } else {
                    hideLoader();
                }
            },
            error: function () {
                formError(form, langErrorSystem);

                if (isModalLoader) {
                    hideModalOverlay($(form).attr('modal-loader'));
                }else if(isCardLoader){
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

    window.location.href = '#message';
}

function formSuccess(form, message) {
    $(form).find('#message').html('<div class="alert alert-success alert-dismissible">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
        '<h4><i class="icon fa fa-check"></i> ' + langSuccessTitle + '</h4>' + message +
        '</div>');

    window.location.href = '#message';
}

function showLoader() {
    //todo
}

function hideLoader() {
    //todo
}

function clearForm(form) {
    form = $(form);

    $(form.find('input')).each(
        function (index) {
            if (!($(this).attr('name') == 'call_category' || $(this).attr('name') == 'call_request')) {
                console.log($(this).attr('name'));
                console.log();
                $(this).val(''); //todo
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

function showModalOverlay(name) {
    $('#' + name).find('.modal-body').append(
        '<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
    );
}

function hideModalOverlay(name) {
    $('#' + name).find('.overlay').remove();
}

function loadInputsFromObject(formID, object, prefix = '', deleteKey = '') {
    form = $('#' + formID);

    $(form.find('input')).each(
        function (index) {
            if($(this).attr('type') == 'checkbox'){
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
                if(object[prefix + $(this).attr('name')] == 1){
                    $(this).prop('checked', true);
                }else{
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

    if(deleteKey != ''){
        $(form.find('.objectName')).html(object[prefix + deleteKey]);
    }
}

function showCardOverlay(form) {
    $($(form).parent().parent()).append(
        '<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
    );
}

function hideCardOverlay(form) {
    $($(form).parent().parent()).find('.overlay').remove();
}