<?php
$dataStudent = TeacherController::getAllSubjectStudents($_GET['id_subject']);
?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr class="text-center">
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>Legajo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataStudent as $student) : ?>
                        <tr>
                            <td class="text-center"><?php echo $student['last_name_student']; ?></td>
                            <td class="text-center"><?php echo $student['name_student']; ?></td>
                            <?php if(!empty($student['file_number'])):?>
                            <td class="text-center"><?php echo $student['file_number']; ?></td>
                            <?php else:?>
                            <td class="text-center">Sin legajo</td>
                            <?php endif; ?>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageStudentSubject')) : ?>
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
    <!-- Modal para ver las notas del alumno seleccionado. -->
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
                    <p><strong>Parcial 1:</strong>
                        <span class="<?php echo ($student['nota1'] === null) ? 'text-dark' : (($student['nota1'] < 4) ? 'text-danger' : (($student['nota1'] == 10) ? 'text-success' : '')); ?>">
                            <?php echo ($student['nota1'] === null) ? 'Nota no asignada' : $student['nota1'] . ' (' . CourseController::numeroATexto($student['nota1']) . ')'; ?>
                        </span>
                    </p>
                    <?php if ($student['nota1'] < 4 && $student['nota1'] !== null): ?>
                        <p><strong>Recuperatorio 1:</strong>
                            <span class="<?php echo ($student['recuperatorio1'] === null) ? 'text-dark' : (($student['recuperatorio1'] < 4) ? 'text-danger' : (($student['recuperatorio1'] == 10) ? 'text-success' : '')); ?>">
                                <?php echo ($student['recuperatorio1'] === null) ? 'Nota no asignada' : $student['recuperatorio1'] . ' (' . CourseController::numeroATexto($student['recuperatorio1']) . ')'; ?>
                            </span>
                        </p>
                    <?php endif; ?>

                    <p><strong>Parcial 2:</strong>
                        <span class="<?php echo ($student['nota2'] === null) ? 'text-dark' : (($student['nota2'] < 4) ? 'text-danger' : (($student['nota2'] == 10) ? 'text-success' : '')); ?>">
                            <?php echo ($student['nota2'] === null) ? 'Nota no asignada' : $student['nota2'] . ' (' . CourseController::numeroATexto($student['nota2']) . ')'; ?>
                        </span>
                    </p>
                    <?php if ($student['nota2'] < 4 && $student['nota2'] !== null): ?>
                        <p><strong>Recuperatorio 2:</strong>
                            <span class="<?php echo ($student['recuperatorio2'] === null) ? 'text-dark' : (($student['recuperatorio2'] < 4) ? 'text-danger' : (($student['recuperatorio2'] == 10) ? 'text-success' : '')); ?>">
                                <?php echo ($student['recuperatorio2'] === null) ? 'Nota no asignada' : $student['recuperatorio2'] . ' (' . CourseController::numeroATexto($student['recuperatorio2']) . ')'; ?>
                            </span>
                        </p>
                    <?php endif; ?>

                    <!-- Condición para mostrar mensaje "Deberá rendir integrador" -->
                    <?php
                    $debeIntegrador = false;
                    if (($student['recuperatorio1'] !== null && $student['recuperatorio1'] < 4) ||
                        ($student['recuperatorio2'] !== null && $student['recuperatorio2'] < 4)
                    ) {
                        $debeIntegrador = true;
                    }
                    ?>

                    <?php if ($debeIntegrador): ?>
                        <div class="alert alert-warning mt-3">
                            <strong>Deberá rendir integrador.</strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal para hacer la carga de notas -->
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
                    <form id="addNote" method="post">
                        <input type="hidden" name="id_student" value="<?php echo $student['id_student']; ?>">
                        <input type="hidden" name="id_subject" value="<?php echo $_GET['id_subject']; ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="note_one">Parcial 1</label>
                                    <input type="number" min="1" max="10" maxlength="2" class="form-control" id="note_one" name="note1" value="<?php echo $student['nota1']; ?>">
                                </div>
                            </div>
                            <!-- Solo mostrar el recuperatorio 1 si note1 no es null y es menor que 4 -->
                            <?php if (!is_null($student['nota1']) && $student['nota1'] < 4): ?>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recuperatory_one">Recuperatorio 1</label>
                                        <input type="number" min="1" max="10" maxlength="2" class="form-control" id="recuperatory_one" name="recuperatory1" value="<?php echo $student['recuperatorio1']; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="note_two">Parcial 2</label>
                                    <input type="number" min="1" max="10" maxlength="2" class="form-control" name="note2" value="<?php echo $student['nota2']; ?>">
                                </div>
                            </div>
                            <!-- Solo mostrar el recuperatorio 2 si note2 no es null y es menor que 4 -->
                            <?php if (!is_null($student['nota2']) && $student['nota2'] < 4): ?>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="recuperatory_two">Recuperatorio 2</label>
                                        <input type="number" min="1" max="10" maxlength="2" class="form-control" name="recuperatory2" value="<?php echo $student['recuperatorio2']; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- Condición para mostrar mensaje "Deberá rendir integrador" -->

                        </div>
                        <?php
                        $debeIntegrador = false;
                        if (($student['recuperatorio1'] !== null && $student['recuperatorio1'] < 4) ||
                            ($student['recuperatorio2'] !== null && $student['recuperatorio2'] < 4)
                        ) {
                            $debeIntegrador = true;
                        }
                        ?>

                        <?php if ($debeIntegrador): ?>
                            <div class="alert alert-warning mt-3">
                                <strong>Deberá rendir integrador.</strong>
                            </div>
                        <?php endif; ?>
                        <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar</button>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>