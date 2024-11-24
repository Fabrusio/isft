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