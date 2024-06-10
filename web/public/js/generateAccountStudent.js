function generateUser(userId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas generar un nuevo usuario para este Alumno?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, generarlo'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php?pages=manageStudent&action=activar_cuenta&id_student=' + userId;
        }
    });
}