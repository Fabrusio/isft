<?php
class TeacherController
{
    static public function newTeacher()
    {

        if (
            (!empty($_POST['name'])) && (!empty($_POST['lastName'])) &&
            (!empty($_POST['mail'])) && (!empty($_POST['dni'])) &&
            (!empty($_POST['gender']))
        ) {

            $name = ucwords(strtolower(trim($_POST['name'])));
            $lastname = ucwords(strtolower(trim($_POST['lastName'])));
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $name) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $lastname)) {
                $response["status"] = "error";
                $response["message"] = "El nombre y/o apellido solo pueden contener letras, espacios y tildes.";
                return $response;
            }

            if (strlen($name) > 70 || strlen($lastname) > 70) {
                $response["status"] = "error";
                $response["message"] = "El nombre y/o apellido no pueden tener más de 50 caracteres.";
                return $response;
            }
            $telephone = trim($_POST['tel']);
            $telephone = empty($telephone) ? null : $telephone;

            if (!empty($telephone)) {
                if (!ctype_digit($telephone) || strlen($telephone) != 10 || intval(substr($telephone, 0, 2)) < 11) {
                    $response["status"] = "error";
                    $response["message"] = "Número de teléfono inválido. Debe tener 10 dígitos y comenzar con un código de área válido.";
                    return $response;
                }

                $checkCountTel = UserModel::checkForDuplicatesTel($telephone);

                if ($checkCountTel !== false) {
                    $response["status"] = "error";
                    $response["message"] = "El teléfono ya está registrado.";
                    return $response;
                }
            }

            $email = strtolower(trim($_POST['mail']));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                $response["status"] = "error";
                $response["message"] = "Email invalido";
                return $response;
            }

            if (strlen($email) > 255) {
                $response["status"] = "error";
                $response["message"] = "El email no puede tener más de 255 caracteres.";
                return $response;
            }

            $dni = trim($_POST['dni']);
            if (!ctype_digit($dni) || strlen($dni) > 8 || strlen($dni) < 6 || intval($dni) < 5000000) {
                $response["status"] = "error";
                $response["message"] = "DNI inválido. Debe ser un número entre 6 y 8 dígitos.";
                return $response;
            }

            $gender = $_POST['gender'];

            // Filtra el duplicado del DNI
            $checkCountDniOrEmail = TeacherModel::checkForDuplicates($dni, $email);

            if ($checkCountDniOrEmail !== false) {
                $response["status"] = "error";
                $response["message"] = "Ya existe el Email o el DNI";
                return $response;
            }
            $execute = TeacherModel::newTeacher($name, $lastname, $email, $dni, $gender, $telephone);

            if ($execute) {
                $response['title'] = "¡Éxito!";
                $response["status"] = "successReset";
                $response["message"] = "Se guardó los datos correctamente";
                return $response;
            } else {
                $response["status"] = "error";
                $response["message"] = "Hubo un problema al crearlo";
                return $response;
            }
        } else {

            $response["status"] = "error";
            $response["message"] = "Debes completar los campos";
        }
        return $response;
    }

    static public function getAllTeachers()
    {
        return TeacherModel::getAllTeachers();
    }

    static public function editTeacher()
    {
        $name = ucwords(strtolower(trim($_POST['name_teacher'])));
        $lastname = ucwords(strtolower(trim($_POST['last_name_teacher'])));

        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $name) || !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/u", $lastname)) {
            $response["status"] = "error";
            $response["message"] = "El nombre y/o apellido solo pueden contener letras, espacios y tildes.";
            return $response;
        }
        if (strlen($name) > 70 || strlen($lastname) > 70) {
            $response["status"] = "error";
            $response["message"] = "El nombre y/o apellido no pueden tener más de 50 caracteres.";
            return $response;
        } 

        $telephone = trim($_POST['tel']);
        $telephone = empty($telephone) ? null : $telephone;

        if (!empty($telephone)) {
            if (!ctype_digit($telephone) || strlen($telephone) != 10 || intval(substr($telephone, 0, 2)) < 11) {
                $response["status"] = "error";
                $response["message"] = "Número de teléfono inválido. Debe tener 10 dígitos y comenzar con un código de área válido.";
                return $response;
            }

            $checkCountTel = UserModel::checkForDuplicatesTel($telephone);

            if ($checkCountTel !== false) {
                $response["status"] = "error";
                $response["message"] = "El teléfono ya está registrado.";
                return $response;
            }
        }


        $id_teacher = $_POST['id_teacher'];

        $execute = TeacherModel::updateTeacherData($name, $lastname, $telephone,$id_teacher);
        if ($execute) {
            $response['title'] = "¡Actualizado!";
            $response["status"] = "successLoad";
            $response["message"] = "Se guardó los datos correctamente";
            return $response;
        } else {
            $response["status"] = "error";
            $response["message"] = "Hubo un problema al crearlo";
            return $response;
        }

    }


    //no borrar por el momento no se usara
    static public function generateAccountTeacher()
    {
        if (isset($_GET['id_teacher'])) {
            $id_teacher = $_GET['id_teacher'];

            $dataTeacher = TeacherModel::dataUser($id_teacher);

            $name = $dataTeacher['name_user'];
            $lastname = $dataTeacher['last_name_user'];
            $email = $dataTeacher['email'];
            $state = $dataTeacher['state'];
            $generatePassword = UserController::generateRandomPassword(14);
            $hashedPassword = password_hash($generatePassword, PASSWORD_DEFAULT);
            $changeState = TeacherModel::changeStateTeacher($id_teacher);
            if ($state == 1) {
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                alert("No se pudo crear el usuario, ya existe.")</script>';
                return;
            }
            if ($changeState) {
                $newPassword = TeacherModel::updatePassword($id_teacher, $hashedPassword);
                if ($newPassword) {
                    $execute = MailerController::sendNewUser($generatePassword, $email, $name, $lastname);
                    if ($execute) {
                        echo '<script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                            window.location="../index.php?pages=manageTeacher&message=correcto";
                            </script>';
                    } else {
                        echo '<script>
                            if (window.history.replaceState) {
                                window.history.replaceState(null, null, window.location.href);
                            }
                            alert("No se pudo enviar el email.");
                            </script>';
                    }
                } else {
                    echo '<script>
                        if (window.history.replaceState) {
                            window.history.replaceState(null, null, window.location.href);
                        }
                        alert("No se pudo actualizar la contraseña.");
                        </script>';
                }
            } else {
                echo '<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                    alert("No se pudo cambiar el estado del profesor.");
                    </script>';
            }
        }
    }
}
