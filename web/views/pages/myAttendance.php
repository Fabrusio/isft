<?php if (isset($_GET['id_subject']) && isset($_GET['name_subject']) && isset($_GET['id_teacher'])): ?>
    <?php
    $dataMonths = TeacherController::getAllMonths();
    ?>
    <section class="container-fluid py-3">
        <h1 class="text-center mt-1 mb-3 py-2"><?php echo $_GET['name_career'] ?></h1>
        <div class="row">
            <div class="col-10"></div>
            <div class="col text-center">
                <a href="index.php?pages=mySubjects" class="btn btn-info mb-3" title="Volver a Herramientas de la Carrera">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>

        <div class="row py-4">
            <?php foreach ($dataMonths as $key => $value): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="#assignAttendanceModal<?php echo $value['id_month']; ?>" title="<?php echo $value['name_month'] ?>" data-toggle="modal">
                        <div class="small-box bg-secondary h-100 d-flex flex-column justify-content-between">
                            <div class="inner flex-grow-1">
                                <h4 class="m-1 text-truncate" style="max-width: 100%;"><?php echo $value['name_month'] ?></h4>
                            </div>
                            <div class="icon text-center my-2">
                                <i class="bi bi-calendar3" style="font-size: 48px;"></i>
                            </div>
                            <div class="small-box-footer">
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<?php foreach ($dataMonths as $months) : ?>
    <div class="modal fade cierreModal" id="assignAttendanceModal<?php echo $months['id_month']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Editar profesor</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="assignattendance">
                        <?php
                        $dataAttendance = TeacherController::getAllDataAttendance($_GET['id_subject'], $months['id_month'], $_GET['id_teacher']);
                        ?>
                        <input type="hidden" name="id_month" value="<?php echo $months['id_month']; ?>">
                        <div class="form-group">
                            <label for="schedule">Cantidad total de horas asistidas en el mes</label>
                            <input type="number" min="0" max="75" class="form-control" id="attendance" name="attendance" value="<?php echo $dataAttendance; ?>">
                        </div>
                        <button type="submit" name="savechange" class="btn btn-warning ladda-button">Guardar cambios</button>
                        <div class="response-message text-center"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>