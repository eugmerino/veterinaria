$(document).ready(function () {
    $("#validarPacienteForm").on("submit", function (e) {
        e.preventDefault();
        const codigo = $("#codigo").val();

        $.ajax({
            url: "/consulta/validarPaciente",
            type: "POST",
            data: { codigo },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#pacienteInfo").removeClass("d-none");
                    const data = response.data;
                    $("#infoList").html(`
                        <li class="list-group-item"><strong>Propietario:</strong> ${data.nombre_propietario}</li>
                        <li class="list-group-item"><strong>Correo:</strong> ${data.correo}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> ${data.telefono}</li>
                        <li class="list-group-item"><strong>Paciente:</strong> ${data.nombre_paciente}</li>
                        <li class="list-group-item"><strong>Fecha de Nacimiento:</strong> ${data.fecha_nacimiento}</li>
                    `);
                } else {
                    $("#nuevoPacienteModal").modal("show");
                }
            },
        });
    });

    $("#agregarPacienteForm").on("submit", function (e) {
        e.preventDefault();

        const formData = $(this).serialize();
        $.ajax({
            url: "/consulta/agregarPaciente",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("Paciente agregado exitosamente");
                    $("#nuevoPacienteModal").modal("hide");
                } else {
                    alert("Error al agregar paciente");
                }
            },
        });
    });
});
