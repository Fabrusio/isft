<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../controllers/TeacherController.php');
require ('../models/TeacherModel.php');


class TeacherAjax {

    
        public function newTeacher() {
            $teacher = new TeacherController();
            $result = $teacher->newTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function editTeacher() {
            $teacher = new TeacherController();
            $result = $teacher->editTeacher();
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }
        public function insertAttendance() {
            $teacher = new TeacherController();
            $result = $teacher->insertAttendance($_POST['id_subject'], $_POST['id_month'], $_POST['id_teacher'], $_POST['attendance']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

        public function editAttendance() {
            $teacher = new TeacherController();
            $result = $teacher->editAttendance($_POST['attendance'], $_POST['id_teacher_attendance']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

        public function insertStudentAttendance() {
            $teacher = new TeacherController();
            $result = $teacher->insertStudentAttendance($_POST['id_subject'], $_POST['id_month'], $_POST['id_student'], $_POST['attendance']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

        public function editStudentAttendance() {
            $teacher = new TeacherController();
            $result = $teacher->editStudentAttendance($_POST['attendance'], $_POST['id_student_attendance'],$_POST['id_subject'], $_POST['id_month']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newteacher'){
    $var = new TeacherAjax();
    $var->newTeacher();
}else if(isset($_POST['action']) && $_POST['action'] == 'editteacher'){

        $var = new TeacherAjax();
        $var->editTeacher();
}else if(isset($_POST['action']) && $_POST['action'] == 'insertattendance'){
    $var = new TeacherAjax();
    $var->insertAttendance();
}else if(isset($_POST['action']) && $_POST['action'] == 'editattendance'){
    $var = new TeacherAjax();
    $var->editAttendance();
}else if(isset($_POST['action']) && $_POST['action'] == 'insertstudentattendance'){
    $var = new TeacherAjax();
    $var->insertStudentAttendance();
}else if(isset($_POST['action']) && $_POST['action'] == 'editstudentattendance'){
    $var = new TeacherAjax();
    $var->editStudentAttendance();
}