<?php if (isset($_GET['id_subject']) && isset($_GET['name_subject']) && isset($_GET['id_teacher'])): ?>
    <?php
    $dataMonths = TeacherController::getAllMonths();
    ?>
    <div class="row pt-4">
                <div class="col-4">
                </div>
                <div class="col-4 text-center">
                    <h2 class="ml-4">Gestionar mi asistencia</h2>
                </div>
                <div class="col-4 text-center">
                    <a href="index.php?pages=mySubjects" class="btn btn-info mb-3" title="Volver atrás">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
    </div>
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
                                $dataAttendance = TeacherController::getAllDataAttendance($_GET['id_subject'], $month['id_month'], $_GET['id_teacher']);
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


<?php foreach ($dataMonths as $months) : ?>
    <div class="modal fade cierreModal" id="assignAttendanceModal<?php echo $months['id_month']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-success">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Ingresar asistencia</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insertattendance">
                        <?php
                        $dataAttendance = TeacherController::getAllDataAttendance($_GET['id_subject'], $months['id_month'], $_GET['id_teacher']);
                        ?>
                        <input type="hidden" name="id_subject" value="<?php echo $_GET['id_subject']; ?>">
                        <input type="hidden" name="id_month" value="<?php echo $months['id_month']; ?>">
                        <input type="hidden" name="id_teacher" value="<?php echo $_GET['id_teacher']; ?>">

                        <div class="form-group">
                            <label for="schedule">Cantidad total de horas asistidas en el mes</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9,.]/g, '').replace(/(,.*),/g, '$1');" class="form-control reset" name="attendance" value="<?php echo $dataAttendance['monthly_attendance']; ?>">
                        </div>
                        <button type="submit" class="btn btn-success ladda-button">Guardar cambios</button>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade cierreModal" id="editAttendanceModal<?php echo $months['id_month']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-primary">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Editar asistencia</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editattendance">
                        <?php
                        $dataAttendance = TeacherController::getAllDataAttendance($_GET['id_subject'], $months['id_month'], $_GET['id_teacher']);
                        ?>
                        <input type="hidden" name="id_teacher_attendance" value="<?php echo $dataAttendance['id_teacher_attendance']; ?>">

                        <div class="form-group">
                            <label for="schedule">Cantidad total de horas asistidas en el mes</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9,.]/g, '').replace(/(,.*),/g, '$1');" class="form-control reset" name="attendance" value="<?php echo $dataAttendance['monthly_attendance']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary ladda-button">Guardar cambios</button>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>