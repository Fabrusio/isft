<?php
include_once 'config/MysqlDb.php'; // Asegúrate de incluir el archivo que contiene la clase model_sql

class StudentModel extends UserModel
{

    static public function newStudent($value1, $value2, $value3, $value4, $value5, $value6, $value7)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id, fk_career_id, fk_rol_id, state)
                                VALUES (:name, :lastName, :email, :dni, :dateYear, null, null, :gender, :carrer, 3, 2)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':dateYear', $value5, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value6, PDO::PARAM_INT);
        $stmt->bindParam(':carrer', $value7, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }

    static public function getAllStudent()
    {
        $sql = "SELECT
        users.id_user As id_student,
        users.name AS name_student,
        users.last_name AS last_name_student,
        users.email AS email_student,
        users.dni AS dni,
        users.startingYear AS startingYear,
        users.fk_rol_id AS fk_rol_id,
        careers.career_name AS career_name
        FROM users
        JOIN careers ON users.fk_career_id=careers.id_career
        WHERE 
        users.fk_rol_id = 3
        AND users.state IN (1, 2)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function updateStudentState($id)
    {
        $sql = "UPDATE users SET state = 0 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }
    static public function updateStudentData($name, $last_name, $email, $carrera, $id_student)
    {
        $sql = "UPDATE users SET name = :name, last_name = :last_name, email = :email, fk_career_id = :carrer_id WHERE id_user = :id_student";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':carrer_id', $carrera, PDO::PARAM_INT);
        $stmt->bindParam(':id_student', $id_student, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Devolver true si la actualización se realiza correctamente
            return true;
        } else {
            // Manejar cualquier error que pueda ocurrir durante la ejecución de la consulta
            print_r($stmt->errorInfo());
            return false; // Devolver false en caso de error
        }
        $stmt = null;
    }
}
