<?php
//esta clase va a servir para manejar  todas las asignacion preceptores/profesores/alumnos
class AssignmentController {
    // Trae datos de la materia
    static public function infoDataSubject($id)
    {
        return AssignmentModel::infoGetSubjectData($id);
    }
    // agrega un preceptor a la carrera en curso
    static public function assignPreceptor($career, $name, $state)
{
    $id_career = $career;
    $name_career = $name;
    $state_career = $state;

    if (!empty($_POST['id_career_post']) && !empty($_POST['id_preceptor'])) {
        $id_career_post = $_POST['id_career_post'];
        $id_preceptor = $_POST['id_preceptor'];

        // Verificar cantidad de carreras asignadas
        $assigned_count = AssignmentModel::preceptorAccountCareer($id_preceptor);
        $count_preceptors =  AssignmentModel::preceptorAllAccountCareer($id_career);
         

        if ($assigned_count >= 2) { // Verificar si es mayor o igual a 2
            echo ' <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">No se puede asignar al mismo preceptor mas de 2 carreras</div>
                    </div>
                </div>';
            return; // Salir de la función si ya tiene dos carreras asignadas
        }

        if ($count_preceptors  >=2) { 
            echo ' <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">No se puede asignar a mas de 2 Preceptores en una Carrera</div>
                    </div>
                </div>';
                   
            return; 
        }

        // Insertar asignación si no tiene dos carreras asignadas aún
        $insert = AssignmentModel::insertCareerPerson($id_career_post, $id_preceptor);

        if ($insert) {
            echo '<script>
            window.location.href = "index.php?pages=managePreceptor&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listPreceptor&message=correcto";
            </script>';
        } else {
            echo "No se pudo asignar Preceptor.";
        }
    }
}



        // Borra un preceptor de la carrera en curso

        static public function quitPreceptor($career,$name,$state){


            $id_career= $career;
            $name_career=$name;
    
            if(!empty($_POST['id_preceptor'])){
    
                
                $id_preceptor=$_POST['id_preceptor'];
    
                $delete=AssignmentModel::deleteAssign($id_preceptor);
    
                if ($delete) {
                  
                    echo '<script>
                    window.location.href = "index.php?pages=managePreceptor&id_career=' . $id_career . '&name_career=' . $name_career . '&state=' . $state . '&subfolder=listPreceptor&message=correcto";
                    </script>';
                } else {
                    // Manejo de error si la inserción falla
                    echo "No se pudo quitar Preceptor.";
                }
    
            }


        }

        static public function show_career_preceptor($id){

            return AssignmentModel::preceptor_career($id);


        }

        
    
    }

    
?>