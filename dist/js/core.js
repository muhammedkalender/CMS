function checkForm(form) {
    form = $(form);

    $isValid = true;

    form.find('input').each(
        function (index) {
            var obj = $(this);
//            console.log(obj.attr('type'));

            //   $isValid = false;
        }
    );

    if ($isValid) {
        showLoader();

        console.log(form.serializeArray());
        console.log(form.attr('action'));
        console.log(form.attr('submit-delay'));
        console.log(form.attr('submit-redirect'));
        console.log(form.attr('method'));

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
                } else {
                    formError(form, response.message);
                }

                hideLoader();
            },
            error: function () {
                formError(form, langErrorSystem);

                hideLoader();
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

    form.find('input').each(
        function (index) {
            $(this).val(''); //todo
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