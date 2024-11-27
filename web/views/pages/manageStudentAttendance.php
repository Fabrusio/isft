<?php if ((isset($_GET['id_subject'])) && (isset($_GET['name_subject'])) && (isset($_GET['id_student']))) : ?>
	<section class="container-fluid py-3">
		<h2 class="text-center mt-1 mb-3 py-2 lead">Gestionar horario de: <?php echo $_GET['name_student'] ?></h2>
		<ul class="nav nav-pills nav-justified mb-2">
			<?php if ((isset($_GET['subfolder'])) && ($_GET['subfolder'] == 'monthAttendance')) : ?>
				<li class="nav-item">
					<a class="nav-link active" href="index.php?pages=manageStudentAttendance&id_subject=<?php echo $_GET['id_subject'];?>&name_subject=<?php echo $_GET['name_subject']; ?>&id_student=<?php echo $_GET['id_student'];?>&name_student=<?php echo $_GET['name_student'];?>&subfolder=monthAttendance">Ver asistencias</a>
				</li>
			<?php else : ?>
				<li class="nav-item">
                    <a class="nav-link" href="index.php?pages=manageStudentAttendance&id_subject=<?php echo $_GET['id_subject']; ?>&name_subject=<?php echo $_GET ['name_subject']; ?>&id_student=<?php echo $_GET['id_student'];?>&name_student=<?php echo $_GET['name_student'];?>&subfolder=monthAttendance">Ver asistencias</a>
				</li>
			<?php endif; ?>

			<li class="nav-item">
				<a href="index.php?pages=manageStudentSubject&id_subject=<?php echo $_GET['id_subject']; ?>&name_subject=<?php echo $_GET['name_subject']; ?>" class="nav-link">Volver atrás<i class="fas fa-arrow-circle-left ml-2"></i></a>
			</li>
		</ul>
		<?php
        if (isset($_GET['subfolder'])) {
            if ($_GET['subfolder'] == 'monthAttendance') {
                include "views/subfolder/" . $_GET['subfolder'] . ".php";
            }
			
        }else{
			include "views/subfolder/monthAttendance.php";
		}
        ?>
	</section>
<?php endif ?>

