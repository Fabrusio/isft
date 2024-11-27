<?php if (isset($_GET['id_subject']) && isset($_GET['name_subject']) && isset($_GET['id_student'])): ?>
    <?php
    $dataMonths = TeacherController::getAllMonths();
    ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-bordered table-striped table-hover custom-table-container" style="width: 80%; margin: 0 auto;">
                    <thead class="bg-yellow text-white">
                        <tr class="text-center">
                            <th class="d-none">ID</th>
                            <th>Mes</th>
                            <th>Horas asistidas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataMonths as $month) : ?>
                            <?php
                                $dataAttendance = TeacherController::getAllStudentDataAttendance($_GET['id_subject'], $month['id_month'], $_GET['id_student']);
                            ?>
                            <tr>
                                <td class="d-none"><?php echo $month['id_month']; ?></td>
                                <td class="text-center"><?php echo $month['name_month']; ?></td>
                                <td class="text-center"><?php if($dataAttendance['monthly_attendance'] === null) {echo 'No ingresadas';}else{ echo $dataAttendance['monthly_attendance'] . ' horas';} ?></td>
                                <td class="text-center">
                                    <?php if($dataAttendance['monthly_attendance'] === null) {?>
                                    <a href="#assignAttendanceModal<?php echo $month['id_month']; ?>" class="btn btn-success view-month" data-toggle="modal" title="Ingresar horas">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <?php }else {?>

                                    <a href="#editAttendanceModal<?php echo $month['id_month']; ?>" class="btn btn-primary edit-month" data-toggle="modal" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <?php }?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>