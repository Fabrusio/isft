<?php
//aqui iran todas las consultas relacionada a las asignaciones de profesores preceptores y docentes
class AssignmentModel {

	
	// Esta funcion trae toda la info de la materia
	static public function infoGetSubjectData($id)
		{
			$sql = "SELECT 
				asignament_teachers.id AS id_pivot,
				subjects.id_subject AS id_subject,
				subjects.name_subject AS name_subject,
				subjects.details AS details,
				yearSubject.year AS yearSubject,
				yearSubject.detail AS detail_year,
				users.id_user AS id_teacher,
				CONCAT(users.name, ' ', users.last_name) AS name_teacher,
				careers.career_name AS career_name,
				careers.id_career AS id_career  
			FROM 
				asignament_teachers
			JOIN 
				subjects ON asignament_teachers.fk_subject_id = subjects.id_subject 
			JOIN 
				yearSubject ON subjects.fk_year_subject = yearSubject.id_year_subject 
			JOIN 
				careers ON subjects.fk_career_id = careers.id_career 
			LEFT JOIN 
				users ON asignament_teachers.fk_user_id = users.id_user 
			WHERE 
				subjects.id_subject = ?
			";
			$stmt = model_sql::connectToDatabase()->prepare($sql);
			$stmt->bindParam(1, $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows
			} else {
				print_r($stmt->errorInfo());
			}
		
			$stmt = null;
		}

    // Esta consulta va a inserta en la tabla de person_career, para insertar a los estudiantes una carrera.

	static public function insertCareerPerson($careerId, $userId)
{
    $sql = "INSERT INTO career_person(fk_career_id, fk_user_id) VALUES (:fk_career_id, :fk_user_id)";
    $stmt = model_sql::connectToDatabase()->prepare($sql);

    $stmt->bindParam(":fk_career_id", $careerId, PDO::PARAM_INT);
    $stmt->bindParam(":fk_user_id", $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
    $stmt = null; // Liberar el statement
}
	static public function insertSubjectTeacher($subject_id, $userId)
{
    $sql = "INSERT INTO asignament_teachers(fk_subject_id, fk_user_id, state) VALUES (:fk_subject_id , :fk_user_id, 1)";
    $stmt = model_sql::connectToDatabase()->prepare($sql);

    $stmt->bindParam(":fk_subject_id", $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(":fk_user_id", $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return true;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
    $stmt = null; // Liberar el statement
}
//inserta los estudiantes a la materia
static public function insertSubjectStudent($subject_id, $userId)
{
    // Obtener una única conexión a la base de datos
    $db = model_sql::connectToDatabase();
    
    $sql = "INSERT INTO asignament_students(fk_subject_id, fk_user_id, state) VALUES (:fk_subject_id, :fk_user_id, 1)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(":fk_subject_id", $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(":fk_user_id", $userId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Recuperar el ID del registro recién insertado usando la misma conexión
        $lastId = $db->lastInsertId();
        return $lastId;
    } else {
        print_r($stmt->errorInfo());
        return false;
    }
    
    $stmt = null; // Liberar el statement
}



	static public function updateCareerStudent($id_career,$id_career_person){

		$sql = "UPDATE career_person SET fk_career_id = :fk_career_id WHERE id_career_person = :id_career_person";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(':fk_career_id', $id_career, PDO::PARAM_STR);
		$stmt->bindParam(':id_career_person', $id_career_person, PDO::PARAM_STR); 
		
	
		if ($stmt->execute()) {
			
			return true;
		} else {
			print_r($stmt->errorInfo());
			return false;
		}
		$stmt = null;
		
	}
	// PARA SABER SI ALGUN  PRECEPTOR NO ESTA ASIGNADO
	static public function preceptorNoAssig($id)
{
    $sql = "SELECT users.id_user, users.name, users.last_name, career_person.fk_career_id AS id_career
            FROM users
            LEFT JOIN career_person ON users.id_user = career_person.fk_user_id
            WHERE users.id_user = :id_user AND users.fk_rol_id = 2 AND career_person.fk_career_id IS NULL";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT); 
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    } else {
        print_r($stmt->errorInfo());
        return null; 
    }

    $stmt = null;
}

	static public function teacherSubejectNoAssig($id_teacher, $id_subject)
{
    $sql = "SELECT * 
            FROM asignament_teachers AS at
            WHERE at.fk_user_id = :id_teacher && at.fk_subject_id = :id_subject;";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT); 
    $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        if($stmt->rowCount() == 0) {
            return true; //
        }
        return false; 
    } else {
        print_r($stmt->errorInfo());
        return null; 
    }

    $stmt = null;
}

static public function studentSubejectNoAssig($id_student, $id_subject)
{
    $sql = "SELECT * 
            FROM asignament_students AS at
            WHERE at.fk_user_id = :id_student && at.fk_subject_id = :id_subject;";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);
    $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT); 
    
    if ($stmt->execute()) {
        if($stmt->rowCount() == 0) {
            return true; //
        }
        return false;
    } else {
        print_r($stmt->errorInfo());
        return null; 
    }

    $stmt = null;
}

static public function deleteTeacherSubject($id_teacher, $id_subject){

    $sql = "DELETE FROM asignament_teachers
            WHERE fk_user_id = :id_teacher && fk_subject_id = :id_subject;";

$stmt = model_sql::connectToDatabase()->prepare($sql);
$stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT); 
$stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT); 

    if ($stmt->execute()) {
        return true; 
    } else {
       
        print_r($stmt->errorInfo());
        return false; 
    }
    $stmt = null;


}

//quitar estudiante
static public function deleteStudentSubject($id_student, $id_subject) {

    $sql = "DELETE FROM asignament_students 
            WHERE fk_user_id = :id_student AND fk_subject_id = :id_subject;";

    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT); 
    $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT); 

    if ($stmt->execute()) {
        return true; 
    } else {
        print_r($stmt->errorInfo());
        return false; 
    }
    $stmt = null; // Liberar el statement
}

//ASignar un preceptor
static public function preceptorAssig($id_career, $id_user)
{
    $sql = " SELECT users.id_user, users.name, users.last_name,career_person.fk_career_id AS id_career
            FROM users 
            INNER JOIN career_person ON users.id_user = career_person.fk_user_id
            WHERE users.id_user = :id_user AND users.fk_rol_id = 2 AND career_person.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }

    $stmt = null;
}



	// QUita el preceptor de la carrera asignada
	static public function deleteAssign($id){

		$sql = "DELETE FROM career_person WHERE id_career_person = :id_career_person";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_career_person', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; // Devolver true si la eliminación se realiza correctamente
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;


	}
	// CAPTURA EL ID DE CAREER PERSON
	static public function captureId_Career_Person($id_preceptor,$id_career)
{
    $sql = "SELECT career_person.id_career_person AS career_person,
			career_person.fk_user_id AS id_preceptor,
            career_person.fk_career_id AS id_career
			FROM career_person
			WHERE career_person.fk_user_id =:id_preceptor AND career_person.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_preceptor', $id_preceptor, PDO::PARAM_INT);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }

    $stmt = null;
}

static public function preceptor_career($id_preceptor)
{
    $sql = "SELECT users.id_user AS id_preceptor,
                   CONCAT(users.name, ' ', users.last_name) AS full_name,
                   careers.career_name AS career
            FROM users
            LEFT JOIN career_person ON users.id_user = career_person.fk_user_id
            LEFT JOIN careers ON career_person.fk_career_id = careers.id_career
            WHERE users.fk_rol_id = 2
              AND users.id_user = :id_preceptor";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_preceptor', $id_preceptor, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
    } else {
        print_r($stmt->errorInfo());
        return null; // Handle error as needed
    }
}
//asignado a una carrera
static public function teacherSubject_career($id_teacher, $id_career)
{
    $sql = "SELECT DISTINCT c.name_subject  AS materias
        FROM subjects c
        JOIN asignament_teachers p ON c.id_subject = p.fk_subject_id
        JOIN users u ON p.fk_user_id = u.id_user
        JOIN career_person cp ON u.id_user = cp.fk_user_id
        WHERE u.id_user = :id_teacher AND c.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows as associative array
    } else {
        print_r($stmt->errorInfo());
        return null; // Handle error as needed
    }
}
//esta cuenta cuantas veces el mismo preceptor esta en una carrera
static public function preceptorAccountCareer($id_user)
{
    $sql = "SELECT COUNT(*) AS count_assigned FROM career_person WHERE fk_user_id = :id_user";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count_assigned'];
    } else {
        print_r($stmt->errorInfo());
        return -1; // Return -1 or handle error as needed
    }
}

//cuenta cuanto preceptores hay en una carrera
static public function preceptorAllAccountCareer($id_career)
{
    $sql = "SELECT COUNT(*) AS count_preceptors
            FROM career_person
            JOIN users ON career_person.fk_user_id = users.id_user
            WHERE users.fk_rol_id = 2
              AND career_person.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count_preceptors'];
    } else {
        print_r($stmt->errorInfo());
        return -1; // Return -1 or handle error as needed
    }
}

//para saber si un profesor no esta asignado a una carrera
static public function teacherNoAssig($id_teacher, $id_career)
{
    $sql = "SELECT users.id_user, users.name, users.last_name, career_person.fk_career_id AS id_career
            FROM users
            LEFT JOIN career_person ON users.id_user = career_person.fk_user_id AND career_person.fk_career_id = :id_career
            WHERE users.id_user = :id_user AND users.fk_rol_id = 4 AND career_person.fk_career_id IS NULL";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_user', $id_teacher, PDO::PARAM_INT);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT); // Bind career_id for comparison

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }
}

//teacher sobre carrera
static public function teacherAssig($id_teacher, $id_career)
{
    $sql = "SELECT users.id_user, users.name, users.last_name, career_person.fk_career_id AS id_career
            FROM users 
            INNER JOIN career_person ON users.id_user = career_person.fk_user_id
            WHERE users.id_user = :id_user AND career_person.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_user', $id_teacher, PDO::PARAM_INT);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }
}
static public function model_showTeacherSubejct($id_subject)
{
    $sql = "SELECT u.name, u.last_name, u.dni, u.email
    FROM asignament_teachers as ast
    JOIN users as u ON ast.fk_user_id = u.id_user
    WHERE ast.fk_subject_id = :id_subject";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch single row since we expect only one result
    } else {
        print_r($stmt->errorInfo());
        return null; // Return null or handle error as needed
    }
}


//modelo para ver esos alumnos que estan registrados en la materia
static public function model_showStudentSubejct($id_subject)
{
    $sql = "SELECT u.name, u.last_name, u.dni, u.email
    FROM asignament_students as ast
    JOIN users as u ON ast.fk_user_id = u.id_user
    WHERE ast.fk_subject_id = :id_subject";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } else {
        print_r($stmt->errorInfo());
        return null; 
    }
}

//pregunta mediante el id de estudiante y carrera que materias cursa
static public function studentSubject_career($id_teacher, $id_career)
{
    $sql = "SELECT DISTINCT c.name_subject  AS materias
        FROM subjects c
        JOIN asignament_students p ON c.id_subject = p.fk_subject_id
        JOIN users u ON p.fk_user_id = u.id_user
        JOIN career_person cp ON u.id_user = cp.fk_user_id
        WHERE u.id_user = :id_student AND c.fk_career_id = :id_career";
    
    $stmt = model_sql::connectToDatabase()->prepare($sql);
    $stmt->bindParam(':id_student', $id_teacher, PDO::PARAM_INT);
    $stmt->bindParam(':id_career', $id_career, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($stmt->errorInfo());
        return null; 
    }
}


}


?>