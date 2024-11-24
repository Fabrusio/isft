<?php
class CourseController
{
    public static function getCourseDataStudentSubject($id_subject)
    {
        $data = CourseModel::getAllCoursesSubjectStudent($id_subject);
        return $data;
    }

    public static function getAllCourseDataStudentSubject($id_subject)
    {
        $data = CourseModel::getHistoryCoursesSubjectStudent($id_subject);
        return $data;
    }

    public static function asinngNotesCoursesSubjectStudent($id_subject, $id_student, $note1, $note2, $recuperatory1, $recuperatory2) {
        $note1 = empty($note1) ? null : $note1;
        $note2 = empty($note2) ? null : $note2;
        $recuperatory1 = empty($recuperatory1) ? null : $recuperatory1;
        $recuperatory2 = empty($recuperatory2) ? null : $recuperatory2;
    
        // Cambiar recuperatorios a null si las notas son >= 4
        if ($note1 !== null && $note1 >= 4) {
            $recuperatory1 = null;
        }
        if ($note2 !== null && $note2 >= 4) {
            $recuperatory2 = null;
        }
    
        try {
            // Validar cada nota solo si no es null
            if ($note1 !== null) {
                self::validateGrade($note1, 'Parcial 1');
            }
            if ($note2 !== null) {
                self::validateGrade($note2, 'Parcial 2');
            }
            if ($recuperatory1 !== null) {
                self::validateGrade($recuperatory1, 'Recuperatorio 1');
            }
            if ($recuperatory2 !== null) {
                self::validateGrade($recuperatory2, 'Recuperatorio 2');
            }
    
            // Llamada al modelo para guardar las notas
            $execute = CourseModel::asinngNotesCoursesSubjectStudent($id_subject, $id_student, $note1, $note2, $recuperatory1, $recuperatory2);
    
            // Responder según el resultado de la ejecución
            if ($execute) {
                return [
                    'title' => "¡Actualizado!",
                    "status" => "successLoad",
                    "message" => "Se guardaron los datos correctamente"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Hubo un problema al asignar las notas"
                ];
            }
        } catch (Exception $e) {
            // Capturar y devolver el error de validación
            return [
                "status" => "error",
                "message" => $e->getMessage()
            ];
        }
    }
    
    private static function validateGrade($grade, $fieldName) {
        if (!is_numeric($grade)) {
            throw new Exception("El valor de {$fieldName} debe ser numérico.");
        }
        if ($grade < 0 || $grade > 10) {
            throw new Exception("El valor de {$fieldName} debe estar entre 0 y 10.");
        }
    }
    

        public static function numeroATexto($numero) {
        $numerosEnTexto = [
            1 => 'Uno',
            2 => 'Dos',
            3 => 'Tres',
            4 => 'Cuatro',
            5 => 'Cinco',
            6 => 'Seis',
            7 => 'Siete',
            8 => 'Ocho',
            9 => 'Nueve',
            10 => 'Diez'
        ];

        return isset($numerosEnTexto[$numero]) ? $numerosEnTexto[$numero] : $numero;
    }
    static public function finishCourse($id_career) {
        $year = date('Y');
        
      
        $studentsAssigned = CourseModel::checkAssignedStudents($id_career, $year);
        
        if ($studentsAssigned) {
           
            $execute = CourseModel::deleteAllAssignStudents($id_career);
            
            if ($execute) {
               
                $changeState = CourseModel::changeCourseState($id_career, $year);
                
                if ($changeState) {
                    $response['title'] = "¡Actualizado!";
                    $response["status"] = "successLoad";
                    $response["message"] = "Se cerró correctamente la cursada";
                    return $response;
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Hubo un problema al actualizar el estado de cursada";
                    return $response;
                }
            } else {
                $response["status"] = "error";
                $response["message"] = "Hubo un problema al borrar alumnos";
                return $response;
            }
        } else {
           
            $response["status"] = "error";
            $response["message"] = "La cursada Actual ya ha sido limpiada, no hay estudiantes para borrar.";
            return $response;
        }
    }
    
    

}