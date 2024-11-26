<?php
class TeacherModel extends UserModel
{
    static public function newTeacher($value1, $value2, $value3, $value4, $value5, $value6)
    {
        $sql = "INSERT INTO users (name, last_name, email, dni, startingYear, file, password, 
                                fk_gender_id,fk_rol_id, state, phone_contact)
                                VALUES (:name, :lastName, :email, :dni, null, null, null, :gender, 4, 2, :phone)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $value1, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $value2, PDO::PARAM_STR);
        $stmt->bindParam(':email', $value3, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $value4, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $value5, PDO::PARAM_INT);
        $stmt->bindParam(':phone', $value6, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }

    static public function getAllTeachers()
    {
        $sql = "SELECT
        users.id_user As id_teacher,
        users.name AS name_teacher,
        users.last_name AS last_name_teacher,
        users.email AS email_teacher,
        users.dni AS dni,
        users.phone_contact AS phone_contact,
        users.fk_rol_id AS fk_rol_id
        FROM users
        WHERE 
        users.fk_rol_id = 4
        AND users.state IN (1, 2)";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function updateTeacherData($name, $last_name, $telephone, $id_teacher)
    {
        $sql = "UPDATE users SET name = :name, last_name = :last_name, phone_contact=:phone_contact WHERE id_user = :id_teacher";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':phone_contact', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null;
    }

    static public function changeStateTeacher($id)
    {
        $sql = "UPDATE users SET state = 1 WHERE id_user = ?";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {

            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null;
    }
    static public function getMySubjects($id)
    {
        $sql = "SELECT ate.fk_subject_id, ate.state, s.name_subject, ys.year, c.career_name
                FROM asignament_teachers AS ate
                INNER JOIN subjects AS s ON ate.fk_subject_id = s.id_subject
                INNER JOIN yearSubject AS ys ON s.fk_year_subject = ys.id_year_subject
                INNER JOIN careers AS c ON s.fk_career_id = c.id_career
                WHERE ate.fk_user_id = ?";
        
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null;
    }

    static public function getAllSubjectStudents($id_subject)
    {
        $currentYear = date('Y'); 
        $sql = "SELECT
            users.id_user AS id_student,
            users.name AS name_student,
            users.last_name AS last_name_student,
            c.note1 as nota1,
            c.note2 as nota2,
            c.recuperatory1 as recuperatorio1,
            c.recuperatory2 as recuperatorio2,
            c.cycle_year as ciclo_lectivo,
            c.state as estado_cursada,
            users.fk_rol_id AS fk_rol_id,
             users.file as file_number
            FROM users
            JOIN asignament_students as ass ON ass.fk_user_id = users.id_user
            JOIN cursada as c ON c.id_asignementStudent = ass.id
            WHERE 
            users.fk_rol_id = 3
            AND users.state IN (1, 2) 
            AND c.state = 1 
            AND c.cycle_year = :currentYear 
            AND ass.fk_subject_id = :fk_subject_id";
    
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':fk_subject_id', $id_subject, PDO::PARAM_INT);
        $stmt->bindParam(':currentYear', $currentYear, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            print_r($stmt->errorInfo());
        }
    
        $stmt = null;
    }

    static public function getAllMonths()
    {
        $sql = "SELECT
        months.id_month AS id_month,
        months.name AS name_month
        FROM months";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function getSchedule($id_subject){
        $sql = "SELECT
        subjects.details AS hs_subject
        FROM subjects
        WHERE
        subjects.id_subject = :id_subject";

        $stmt = model_sql::connectToDatabase()->prepare($sql);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    public static function fetchAttendance($idSubject, $idMonth, $idTeacher) {
        $sql = "SELECT monthly_attendance, id_teacher_attendance
                FROM teacher_attendances
                WHERE fk_subject_id = :id_subject 
                  AND fk_month_id = :id_month 
                  AND fk_teacher_id = :id_teacher";
    
        try {
            $stmt = model_sql::connectToDatabase()->prepare($sql);
            $stmt->bindParam(':id_subject', $idSubject, PDO::PARAM_INT);
            $stmt->bindParam(':id_month', $idMonth, PDO::PARAM_INT);
            $stmt->bindParam(':id_teacher', $idTeacher, PDO::PARAM_INT);
    
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $stmt = null;
            return $result;
        } catch (PDOException $e) {
            error_log("Error en fetchAttendance: " . $e->getMessage());
            return null;
        }
    }
    
    public static function insertAttendance($id_subject, $id_month, $id_teacher, $attendance){
        $sql = "INSERT INTO teacher_attendances (fk_subject_id, fk_month_id, fk_teacher_id, monthly_attendance)
        VALUES (:id_subject, :id_month, :id_teacher, :attendance)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id_subject', $id_subject, PDO::PARAM_INT);
        $stmt->bindParam(':id_month', $id_month, PDO::PARAM_INT);
        $stmt->bindParam(':id_teacher', $id_teacher, PDO::PARAM_INT);
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }
    }
    
    static public function editAttendance($attendance, $id)
    {
        $sql = "UPDATE teacher_attendances SET monthly_attendance = :attendance 
                WHERE id_teacher_attendance = :id";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':attendance', $attendance, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            print_r($stmt->errorInfo());
            return false;
        }
        $stmt = null;
    }

}
