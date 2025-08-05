document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (e) {
        if (e.target.closest('.show-confirm-delete')) {
            const button = e.target.closest('.show-confirm-delete');
            const action = button.dataset.action;
            const form = document.getElementById('deleteForm');

            if (form) {
                form.action = action;
                $('#confirmDeleteModal').modal('show');
            }
        }
    });
});
