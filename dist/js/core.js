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
                //todo

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
                //todo

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
}

function formSuccess(form, message) {
    $(form).find('#message').html('<div class="alert alert-success alert-dismissible">' +
        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
        '<h4><i class="icon fa fa-check"></i> ' + langSuccessTitle + '</h4>' + message +
        '</div>');
}

function showLoader() {
    //todo
}

function hideLoader() {
    //todo
}