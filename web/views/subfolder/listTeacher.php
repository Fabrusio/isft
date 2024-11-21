<?php $dataTeacher = TeacherController::getAllTeachers(); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr class="text-center">
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataTeacher as $teacher) : ?>
                        <tr>
                            <td class="text-center"><?php echo $teacher['last_name_teacher']; ?></td>
                            <td class="text-center"><?php echo $teacher['name_teacher']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageTeacher')) : ?>
                                <td class="text-center">
                                    <a href="#viewUserModal<?php echo $teacher['id_teacher']; ?>" class="btn btn-success view-user" data-toggle="modal" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#editUserModal<?php echo $teacher['id_teacher']; ?>" class="btn btn-primary edit-user" data-toggle="modal" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?pages=manageTeacher&id_teacher=<?php echo $teacher['id_teacher']; ?>&name_teacher=<?php echo $teacher['name_teacher']; ?>&subfolder=teacherCareer" class="btn btn-dark" title="Asignar Carrera"><i class="fas fa-user-tag"></i></a>

                                    <a href="#" class="btn btn-info" onclick="generateUserTeacher(<?php echo $teacher['id_teacher'] ?>)" title="Generar nuevo usuario">
                                                <i class="fas fa-user-plus"></i>
                                            </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php foreach ($dataTeacher as $teacher) : ?>


    <!-- Modal de edición de profesor -->
    <div class="modal fade cierreModal" id="editUserModal<?php echo $teacher['id_teacher']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Editar profesor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editteacher">

                        <input type="hidden" name="id_teacher" value="<?php echo $teacher['id_teacher']; ?>">
                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" maxlength="50" class="form-control" id="last_name_teacher"  name="last_name_teacher" value="<?php echo $teacher['last_name_teacher']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" maxlength="50" class="form-control" id="nam" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name_teacher" required value="<?php echo $teacher['name_teacher']; ?>">
                        </div>
                        <div class="form-group">
                                <label for="tel">Teléfono (Opcional)</label>
                                <input type="text" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '');" class="form-control" name="tel" placeholder="Formato 11 12345678" value="<?php echo $teacher['phone_contact']; ?>" >
                            </div>
                        <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar cambios</button>
                        <div class="response-message text-center"></div>  
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de vista de usuario -->
    <div class="modal fade" id="viewUserModal<?php echo $teacher['id_teacher']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-success">
                    <h5 class="modal-title" id="viewUserModalLabel"><strong>Detalles del profesor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Apellido:</strong> <?php echo $teacher['last_name_teacher']; ?></p>
                    <p><strong>Nombre:</strong> <?php echo $teacher['name_teacher']; ?></p>
                    <p><strong>Email:</strong> <?php echo $teacher['email_teacher']; ?></p>
                    <p><strong>DNI:</strong> <?php echo $teacher['dni']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


<?php endforeach; ?>

<?php 
if (isset($_GET['action'])) {
    if ($_GET['action'] == "activar_cuenta") {
        $controller = new TeacherController();
        $controller->generateAccountTeacher();
    }
}
?>