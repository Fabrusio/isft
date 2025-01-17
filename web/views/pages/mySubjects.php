<?php 
$dataSubjects = TeacherController::getMySubjects($_SESSION['id_user']); 
?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                        <thead class="bg-yellow text-white">
                            <tr class="text-center">
                                <th>Carrera</th>
                                <th>Materia</th>
                                <th>Año</th>
                                <th>Administrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataSubjects as $subjects) : ?>
                                <tr>
                                    <td class="text-center"><?php echo $subjects['career_name']; ?></td>
                                    <td class="text-center"><?php echo $subjects['name_subject']; ?></td>
                                    <td class="text-center"><?php echo $subjects['year']; ?></td>

                                    <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'mySubjects')) : ?>
                                        <td class="text-center">
                                            <a href="index.php?pages=myAttendance&id_subject=<?php echo $subjects['fk_subject_id']; ?>&name_subject=<?php echo $subjects['name_subject']; ?>&id_teacher=<?php echo $_SESSION['id_user']; ?>" class="btn btn-primary" title="Mi asistencia">
                                                <i class="fas fa-clock"></i>
                                            </a>
                                            <a href="index.php?pages=manageStudentSubject&id_subject=<?php echo $subjects['fk_subject_id']; ?>&name_subject=<?php echo $subjects['name_subject']; ?>" class="btn btn-dark" title="Administrar">
                                                <i class="fas fa-user-tag"></i>
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
