<?php
$dataStudent = [
    [
        'id_student' => 1,
        'last_name_student' => 'González',
        'name_student' => 'Carlos',
    ],
    [
        'id_student' => 2,
        'last_name_student' => 'Pérez',
        'name_student' => 'María',
    ]
];
?>
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
                    <?php foreach ($dataStudent as $student) : ?>
                        <tr>
                            <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                            <td class="text-center"><?php echo $student['name_student']; ?></td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageCourse')) : ?>
                                <td class="text-center">
                                    <a href="#viewStudentModal<?php echo $student['id_student']; ?>" class="btn btn-success view-student" data-toggle="modal" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="#addNoteModal<?php echo $student['id_student']; ?>" class="btn btn-primary add-note-student" data-toggle="modal" title="Asignar nota">
                                        <i class="fas fa-plus"></i>
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

<?php foreach ($dataStudent as $student) : ?>
    <!-- Modal de vista de usuario -->
    <div class="modal fade" id="viewStudentModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="viewStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-success">
                    <h5 class="modal-title" id="viewStudentModalLabel"><strong>Notas del estudiante</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Parcial 1:</strong> <?php echo $student['note1']; ?></p>
                    <p><strong>Recuperatorio 1:</strong> <?php echo $student['note2']; ?></p>
                    <p><strong>Parcial 2:</strong> <?php echo $student['recuperatory1']; ?></p>
                    <p><strong>Recuperatorio 2:</strong> <?php echo $student['recuperatory2']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade cierreModal" id="addNoteModal<?php echo $student['id_student']; ?>" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="addNoteModalLabel"><strong>Asignar notas</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addNote">
                        <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="note_one">Parcial 1</label>
                                    <input type="number" maxlength="2" class="form-control" id="note_one" name="note_one" value="<?php echo $student['note_one']; ?>" title="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="recuperatory_one">Recuperatorio</label>
                                    <input type="number" maxlength="2" class="form-control" id="recuperatory_one" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="recuperatory_one" required value="<?php echo $student['recuperatory_one']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="note_two">Parcial 2</label>
                                    <input type="number" maxlength="2" class="form-control" name="note_two" value="<?php echo $student['note_two']; ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="note_two">Recuperatorio 2</label>
                                    <input type="number" maxlength="2" class="form-control" name="recuperatory_two" value="<?php echo $student['recuperatory_two']; ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar</button>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>