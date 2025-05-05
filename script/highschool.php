<script>
document.addEventListener('DOMContentLoaded', () => {
    const editModal2 = document.getElementById('editModal2');
    editModal2.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        document.getElementById('edit-hs-id').value = button.getAttribute('data-id');
        document.getElementById('edit-hs-name').value = button.getAttribute('data-name');
        document.getElementById('edit-hs-school').value = button.getAttribute('data-school');
        document.getElementById('edit-hs-gradelvl').value = button.getAttribute('data-gradelvl');
        document.getElementById('edit-hs-strand').value = button.getAttribute('data-strand');
        document.getElementById('edit-hs-brgy').value = button.getAttribute('data-brgy');
        document.getElementById('edit-hs-phone').value = button.getAttribute('data-phone');
    });
});

document.addEventListener('DOMContentLoaded', function () {
            var deleteModal = document.getElementById('deleteModal2');
            var confirmDelete = document.getElementById('confirmDelete2');

            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                confirmDelete.href = 'manageCollegeScholar.php?delete_hs=' + id + '&table=highschool';
            });
        });
</script>

