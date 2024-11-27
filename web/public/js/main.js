$(document).ready(function () {
  $(".modal").on("hidden.bs.modal", function () {
    // Reinicia el contenido de todos los elementos con la clase response-message
    $(".response-message").html("");
  });
  
  function handleFormSubmit(formId, actionUrl, action) {
    $(document).on("submit", formId, function (e) {
      e.preventDefault();
     // Usa el botón dentro del contexto del formulario actual
     var laddaButton = Ladda.create(this.querySelector(".ladda-button"));
     laddaButton.start();

      var formData = $(this).serialize();
      if (typeof idCareer !== "undefined" && idCareer !== "") {
        formData += "&idCareer=" + encodeURIComponent(idCareer);
      }
      formData += "&action=" + encodeURIComponent(action);
      $.ajax({
        type: "POST",
        url: actionUrl,
        data: formData,
        dataType: "json",
        success: function (response) {
          var messageContainer = $(".response-message");
          var messageContainer2 = $(".response-message2");
          if (response.status === "successLoad") {
            $(".cierreModal").modal("hide"); // Cierra el modal
            setTimeout(function () {
              toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: "slideDown",
                timeOut: 1500,
                onHidden: function () {
                  location.reload();
                },
              };
              toastr.success(response.message, response.title);
            });
            
          } else if (response.status === "successReset") {
            $(".cierreModal").modal("hide"); // Cierra el modal
            setTimeout(function () {
              toastr.options = {
                closeButton: true,
                progressBar: true,
                showMethod: "slideDown",
                timeOut: 1500,
              };
              toastr.success(response.message, response.title);
            });
            resetForm();
            laddaButton.stop(); // Detener el spinner en cualquier caso
            messageContainer.html("");
          } else if (response.status === "successCareer") {
            laddaButton.stop(); // Detener el spinner en cualquier caso
            $(".cierreModal").modal("hide"); // Cierra el modal
            window.location.href = "index.php?pages=allCareers";
          } else {
            if (response.status === "error2") {
              laddaButton.stop(); // Detener el spinner en cualquier caso
              messageContainer2.html(
                '<div class="alert alert-danger mt-2">' +
                  response.message +
                  "</div>"
              );
            } else {
              laddaButton.stop(); // Detener el spinner en cualquier caso
              messageContainer.html(
                '<div class="alert alert-danger mt-2">' +
                  response.message +
                  "</div>"
              );
            }
          }
        },
        error: function (xhr, status, error) {
          laddaButton.stop(); // Detener el spinner en cualquier caso
          console.log(xhr.responseText);
          $(".response-message").html(
            '<div class="alert alert-danger">Error en la solicitud: ' +
              error +
              "</div>"
          );
        },
      
      });
    });
    function resetForm() {
      $(".reset").val("");
    }
  }
  //edición del profesor
  handleFormSubmit("#editteacher", "/ajax/teacherAjax.php", "editteacher");
  //nuevo profesor
  handleFormSubmit("#newteacher", "/ajax/teacherAjax.php", "newteacher");

  //edición del alumno
  handleFormSubmit("#editstudent", "/ajax/studentAjax.php", "editstudent");
  //nuevo alumno
  handleFormSubmit("#newstudent", "/ajax/studentAjax.php", "newstudent");
  //assignar legajo a alumno
  handleFormSubmit("#assignlegajo", "/ajax/studentAjax.php", "assignlegajo");

  //nuevo user
  handleFormSubmit("#newuser", "/ajax/userAjax.php", "newuser");
  //editar user
  handleFormSubmit("#edituser", "/ajax/userAjax.php", "edituser");

  //nueva carrera
  handleFormSubmit("#createCareerForm", "/ajax/careerAjax.php", "newcareer");
  //edit carrera
  handleFormSubmit("#editcareer", "/ajax/careerAjax.php", "editcareer");

  //nueva materia
  handleFormSubmit("#newsubject", "/ajax/subjectAjax.php", "newsubject");
  //edit materia
  handleFormSubmit("#editsubject", "/ajax/subjectAjax.php", "editsubject");
  
  //nueva correlaticva
  handleFormSubmit(
    "#newcorrelative",
    "/ajax/correlativeAjax.php",
    "newcorrelative"
  );
  //edit correlaticva
  handleFormSubmit(
    "#editcorrelative",
    "/ajax/correlativeAjax.php",
    "editcorrelative"
  );

  //cambiar contraseña
  handleFormSubmit("#changepassword", "/ajax/userAjax.php", "changepassword");
  handleFormSubmit("#addNote", "/ajax/courseAjax.php", "addNote");

  
  //New final
  handleFormSubmit("#newfinal", "/ajax/finalAjax.php", "newfinal");
  //cerrar mesa de examen
  handleFormSubmit("#closeExamForm", "/ajax/finalAjax.php", "closeExamTable");

  handleFormSubmit("#finish", "/ajax/courseAjax.php", "finish");

  handleFormSubmit("#insertattendance", "/ajax/teacherAjax.php", "insertattendance");

  handleFormSubmit("#editattendance", "/ajax/teacherAjax.php", "editattendance");
});
