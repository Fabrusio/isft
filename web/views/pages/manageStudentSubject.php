<?php if ((isset($_GET['id_subject'])) && (isset($_GET['name_subject']))) : ?>
	<section class="container-fluid py-3">
		<h2 class="text-center mt-1 mb-3 py-2 lead">Gestionar materia: <?php echo $_GET['name_subject'] ?></h2>
		<ul class="nav nav-pills nav-justified mb-2">
			<?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'listMyStudents')) : ?>
				<li class="nav-item">
					<a class="nav-link active" href="index.php?pages=manageStudentSubject&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listMyStudents">Ver listado de alumnos</a>
				</li>
			<?php else : ?>
				<li class="nav-item">
					<a class="nav-link" href="index.php?pages=manageStudentSubject&id_subject=<?php echo $_GET['id_subject'] ?>&name_subject=<?php echo $_GET['name_subject'] ?>&subfolder=listMyStudents">Ver listado de alumnos</a>
				</li>
			<?php endif ?>

			<li class="nav-item">
				<a href="index.php?pages=mySubjects" class="nav-link">Volver atrás<i class="fas fa-arrow-circle-left ml-2"></i></a>
			</li>
		</ul>
		<?php
        if (isset($_GET['subfolder'])) {
            if ($_GET['subfolder'] == 'listMyStudents') {
                include "views/subfolder/" . $_GET['subfolder'] . ".php";
            }
			
        }else{
			include "views/subfolder/listMyStudents.php";
		}
        ?>
	</section>
<?php endif ?>

