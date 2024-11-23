<?php if ($_SESSION['fk_rol_id'] == 1) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Panel de Administración Académica ISFT 177</h3>
        <img src="public/img/isft177_H.png" class="img-fluid mb-3">
        <p class="lead">Bienvenido a la sección de administración. Aquí puede gestionar todos los aspectos relacionados con carreras, materias y usuarios. 
        
        <div class="container mt-4">
        <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="alert alert-info text-center">
                        <p class="mb-0 py-2"><b>NOTA: </b>Para descargar el manual de usuario, hacer clic en su nombre arriba a la derecha junto al botón de cerrar sesión.</p>
                    </div>
                </div>
            </div>
        </div>
        
        Las siguientes funcionalidades están disponibles:</p>
        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-graduation-cap"></i>Gestión de carreras</h4>
                <ul>
                    <li>Crear nuevas carreras.</li>
                    <li>Editar detalles de las carreras.</li>
                    <li>Crear o acceder a la lista de materias.</li>
                    <li>Asignar materias a las carreras.</li>
                    <li>Asignar materias a los alumnos.</li>
                    <li>Actualizar información de las carreras.</li>
                </ul>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-book"></i>Gestión de materias</h4>
                <p>Mostrar todas las materias disponibles en las carreras.</p>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-users"></i>Gestión de usuarios</h4>
                <ul>
                    <li>Registrar nuevos alumnos o personal administrativo.</li>
                    <li>Asignar alumnos a las carreras.</li>
                    <li>Ver y gestionar todos los usuarios existentes.</li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($_SESSION['fk_rol_id'] == 2) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Panel de Administración Académica ISFT 177</h3>
        <img src="public/img/isft177_H.png" class="img-fluid mb-3">
        <p class="lead">Bienvenido a la sección de Preceptores. Aquí puede gestionar todos los aspectos relacionados con los Alumnos.
            <div class="container mt-4">
            <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="alert alert-info text-center">
                            <p class="mb-0 py-2"><b>NOTA: </b>Para descargar el manual de usuario, hacer clic en su nombre arriba a la derecha junto al botón de cerrar sesión.</p>
                        </div>
                    </div>
                </div>
            </div>
        </p>

        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-graduation-cap"></i>Gestión de carreras</h4>
                <ul>
                    <li>Podrá ver la carrera o carreras en las cuales esté a cargo.</li>
                    <li>Podrá ver las materias de éstas.</li>
                    <li>Ver y administrar a los profesores.</li>
                    <li>Asignar alumnos a la carrera que administre.</li>
                    <li>Darle legajos a los alumnos, entre otras funciones.</li>
                </ul>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-users"></i> Gestionar alumnos</h4>
                <ul>
                    <li>Podrá ver a todos los alumnos de la carrera que administre.</li>
                    <li>Podrá habilitarle un usuario para que entren a la plataforma.</li>
                    <li>Pasarle notas y asistencias.</li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($_SESSION['fk_rol_id'] == 4) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Panel de Administración Académica ISFT 177</h3>
        <img src="public/img/isft177_H.png" class="img-fluid mb-3">
        <p class="lead">Bienvenido a la sección de Profesores. Aquí puede gestionar todos los aspectos relacionados con los Alumnos.
            <div class="container mt-4">
            <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="alert alert-info text-center">
                            <p class="mb-0 py-2"><b>NOTA: </b>Para descargar el manual de usuario, hacer clic en su nombre arriba a la derecha junto al botón de cerrar sesión.</p>
                        </div>
                    </div>
                </div>
            </div>
        </p>

        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-book"></i>Gestión de materias</h4>
                <ul>
                    <li>Podrá ver la materia o materias en las cuales esté a cargo.</li>
                    <li>Podrá agrupar materias buscando por nombre, carrera o año de la misma.</li>
                    <li>Podrá dar asistencia a los alumnos mensualmente.</li>
                    <li>Podrá asignar las notas a los alumnos en las distintas instancias de exámen.</li>
                </ul>
                <span>Para más información leer el <a href="#">manual de usuario</a>.</span>
            </div>
        </div>
    </section>
<?php endif; ?>