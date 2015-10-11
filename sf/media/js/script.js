function confirmDelete() {
    if (confirm("Подтверждаете удаление?")) {
        return true;
    } else {
        return false;
    }
}

$(document).ready(function() {
    $('#db-check').click(function(e) {
        e.preventDefault();

        $.post('/newcrm/admin/object/check', $('#object-form input'), function(data) {
            $('.alert').html(data.message);
            $('.alert').removeClass('alert-danger alert-success');

            if (data.result) {
                $('.alert').addClass('alert-success');
            } else {
                $('.alert').addClass('alert-danger');
            }

            $('.alert').removeClass('hidden');

            $('.alert').fadeIn();
        }, 'json');
    })
});