<?php 
if (isset($_GET['id_career']) && isset($_GET['name_career']) && isset($_GET['state'])) {
    $info = CareerController::getNameCareer($_GET['id_career']);
}
?>
  <section class="container py-3">
        <h2 class="text-center mt-1 mb-3 py-2">Gestión de Carreras</h2>
        <div class="d-flex justify-content-center">
            <div class="card border-primary" style="width: 500px;">
                <div class="card-header bg-warning text-black">
                    <h3 class="card-title mb-0">Editar datos</h3>
                </div>
                <form class="needs-validation" novalidate method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="up_nombre">Nombre de la Carrera:</label>
                            <input type="text" class="form-control" placeholder="Ingrese nombre de la carrera" name="name_career" value="<?php echo htmlspecialchars($info['name_career'] ?? '') ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.- ]+" required maxlength="150">
                            <div class="invalid-feedback">Por favor ingrese un nombre válido.</div>
                        </div>
                        <div class="form-group">
                            <label for="up_titulo">Título de la Carrera:</label>
                            <input type="text" class="form-control" placeholder="Ingrese el título que se obtiene al finalizar la carrera" name="title" value="<?php echo htmlspecialchars($info['description'] ?? '') ?>" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ.\- ]+" required maxlength="200">
                            <div class="invalid-feedback">Por favor ingrese un título válido.</div>
                        </div>
                        <div class="form-group">
                            <label for="up_resolucion">Abreviatura:</label>
                            <input type="text" class="form-control" id="careerAbbreviation" name="abbreviation" pattern="[A-Za-z]{2}" title="Solo se permiten letras y máximo 2 caracteres" value="<?php echo htmlspecialchars($info['abbreviation'] ?? '') ?>" required>
                        </div>

                        <hr>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-warning" name="savechange">Actualizar</button>
                            <a href="index.php?pages=toolsCareer&id_career=<?php echo htmlspecialchars($_GET['id_career'] ?? '') ?>&name_career=<?php echo urlencode($_GET['name_career'] ?? '') ?>&state=<?php echo htmlspecialchars($_GET['state'] ?? '') ?>" class="btn btn-outline-danger">Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>

<?php
if (isset($_POST['savechange'])) {
    
        $id_career = $_GET['id_career'];
        $name_career = $_GET['name_career'];
        $state = $_GET['state'];
        
        CareerController::editCareer($id_career, $name_career, $state);
    }

?>