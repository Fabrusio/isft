function generateUserTeacher(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas generar un nuevo usuario para este docente?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, generarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php?pages=manageTeacher&action=activar_cuenta&id_teacher=' + userId;
        }
    });
}