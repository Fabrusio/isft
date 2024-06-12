
<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class SubjectModel
{

	static public function showYearSubject()
	{
		$sql = " SELECT yearSubject.id_year_subject  AS id_year_subject ,
		yearSubject.year AS year,
        yearSubject.detail  AS detail 
		FROM yearSubject ;
		";
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if ($stmt->execute()) {

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {

			print_r($stmt->errorInfo());
		}

		$stmt = null;
	}
	static public function newSubject($value1, $value2, $value3, $value4)
	{
		$sql = "INSERT INTO subjects (name_subject, details, fk_year_subject, fk_career_id, create_data, state)
				VALUES (:name_subject, :details, :fk_year_subject, :fk_career_id, NOW(), 1)";
		$pdo = model_sql::connectToDatabase(); // Obtener la conexión PDO
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':name_subject', $value1, PDO::PARAM_STR);
		$stmt->bindParam(':details', $value2, PDO::PARAM_STR);
		$stmt->bindParam(':fk_year_subject', $value3, PDO::PARAM_INT);
		$stmt->bindParam(':fk_career_id', $value4, PDO::PARAM_INT);
		
		$success = $stmt->execute(); // Ejecutar la consulta de inserción
		
		if ($success) {
			// Obtener el ID generado después de la inserción
			$lastInsertedId = $pdo->lastInsertId();
			return $lastInsertedId; // Devolver el ID generado
		} else {
			print_r($stmt->errorInfo());
			return false;
		}
	}
	

	static public function showSubject($id) {
		$sql = "SELECT
subjects.id_subject AS id_subject,
subjects.name_subject,
subjects.details AS details,
yearSubject.year AS year_subject,
yearSubject.detail AS year_detail,
careers.career_name AS career_name
FROM subjects
JOIN yearSubject ON subjects.fk_year_subject=yearSubject.id_year_subject
JOIN careers ON subjects.fk_career_id=careers.id_career
WHERE 
careers.id_career = ? AND subjects.state=1";
		$stmt = model_sql::connectToDatabase()->prepare($sql);
		$stmt->bindParam(1, $id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			print_r($stmt->errorInfo());
		}
		$stmt = null;
	}
	

		

	
}