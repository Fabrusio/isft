<?php

require ('../config/MysqlDb.php');
require ('../models/UserModel.php');
require ('../models/FinalModel.php');
require ('../controllers/FinalController.php');


class FinalAjax {
        public function newFinal() {
            $final = new FinalController();
            $result = $final->newFinal( $_POST['id_teacher_vocal'], $_POST['id_subject'], $_POST['first_date'], $_POST['second_date']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

        public function closeExamTable() {
            $final = new FinalController();
            $result = $final->closeExamTable($_POST['id_exam_table']);
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
        }

}

if(isset($_POST['action']) && $_POST['action'] == 'newfinal'){
    $var = new FinalAjax();
    $var->newFinal();
}else if(isset($_POST['action']) && $_POST['action'] == 'closeExamTable'){
    $var = new FinalAjax();
    $var->closeExamTable();
}