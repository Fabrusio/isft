<?php if ( (isset($_GET['id_career'])) && (isset($_GET['name_career'])) && (isset($_GET['state'])) ):?>
<section class="container-fluid py-3">
    <h2 class="text-center mt-1 mb-3 py-2 lead">Herramientas de la Carrera:  <?php echo base64_decode($_GET['name_career'])  ?></h2>
    <div class="row">
    <?php if (base64_decode($_GET['state']) == 0): ?>
    <div class="col-lg-6">
            <a href="index.php?pages=manageSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>Materias</h3>
                        <p>Agregar o Editar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>                
                    <div class="small-box-footer">
                        Gestionar Materias<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>

        <div class="col-lg-6">
            <a href="index.php?pages=manageCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>Correlativas</h3>
                        <p>Crear árbol de materias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-network-wired"></i>
                    </div>                
                    <div class="small-box-footer">
                        Gestionar Correlativas<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>
                </div>            
            </a>
        </div>
        <div class="col-lg-6">
    <a href="index.php?pages=assignamentPreceptor&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
        <div class="small-box badge-danger">
            <div class="inner">
                <h3>Asignar Preceptores</h3> 
                <p>Gestionar Preceptores para la Carrera</p> 
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i> 
            </div>
            <div class="small-box-footer">
                Gestionar Preceptores<i class="fas fa-arrow-circle-right ml-2"></i>
            </div>
        </div>
    </a>
</div>

        <?php else:?>
            <div class="col-lg-6">
            <a href="index.php?pages=viewsSubject&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>Materias</h3>
                        <p>Ver Materias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>                
                    <div class="small-box-footer">
                        Ver Materias<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>

        <div class="col-lg-6">
            <a href="index.php?pages=viewsCorrelatives&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&estate=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>Correlativas</h3>
                        <p>Ver Correlativas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-network-wired"></i>
                    </div>                
                    <div class="small-box-footer">
                        Gestionar Correlativas<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>
                </div>            
            </a>
        </div>

        <div class="col-lg-6">
        <div class="small-box badge-danger">
            <div class="inner">
                <?php $dataPreceCareer=UserController::dataUserCareer($_GET['id_career'])?>
                <h3>Preceptor asignado</h3> 
                <p><?php echo $dataPreceCareer['name_user']." ".$dataPreceCareer['last_name_user']?></p> 
            </div>
            <div class="icon">
                <i class="fas fa-user-tie"></i> <!-- Icono modificado -->
            </div>
            <div class="small-box-footer">
                Gestionar Preceptores<i class="fas fa-arrow-circle-right ml-2"></i>
            </div>
        </div>
    </a>
</div>
        
        <?php endif?>
        <?php if (base64_decode($_GET['state']) == 0): ?>
        <div class="col-lg-6">
            <a href="index.php?pages=careerFinishReview&id_career=<?php echo $_GET['id_career'] ?>&name=<?php echo $_GET['name_career'] ?>&estate=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Carrera en Revisión</h3>
                        <p>En proceso de creación</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="small-box-footer">
                        Finalizar Revisión<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>
        <div class="col-lg-6">
            <a href="index.php?pages=careerEdit&id_carrera=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-light">                
                    <div class="inner">
                        <h3>Editar</h3>
                        <p>Editar información de la carrera</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="small-box-footer">
                        ir a Edición<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>
        <?php else: ?>
        
        <div class="col-lg-6">
            <a href="index.php?pages=careerVerifyCheck&id_carrera=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['name_career'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Estado</h3>
                        <p>Verificar estado de la carrera</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-retweet"></i>
                    </div>                
                    <div class="small-box-footer">
                        Modificar estado<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>
        <div class="col-lg-6">
            <a href="index.php?pages=careerInfo&id_career=<?php echo $_GET['id_career'] ?>&name_career=<?php echo $_GET['career_name'] ?>&state=<?php echo $_GET['state'] ?>">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>Info</h3>
                        <p>Ver información de la carrera</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-info"></i>
                    </div>
                    <div class="small-box-footer">
                        Ver Info<i class="fas fa-arrow-circle-right ml-2"></i>
                    </div>                
                </div>
            </a>
        </div>
        <?php endif ?>
    </div>
</section>
<?php endif ?>