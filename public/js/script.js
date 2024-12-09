

document.addEventListener("DOMContentLoaded", () => {
    /* Script para consultaView */
    if (window.location.pathname === '/veterinaria/registrar-consulta') {
        const tabs = document.querySelectorAll('.nav-link'); 
        const expedienteTabContent = document.getElementById('expediente');

        // Función para actualizar el estado de los tabs
        const updateTabVisibility = () => {
                if (expedienteTabContent.classList.contains('active')) {
                    expedienteTabContent.style.display = 'block';
                } else {
                    expedienteTabContent.style.display = 'none'; 
                }
        };

        // Añade evento de clic a cada tab
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                setTimeout(updateTabVisibility, 50); // Espera un momento para que Bootstrap cambie las clases
            });
        });
        updateTabVisibility();
        

        const buscarPacienteBtn = document.getElementById("buscarPacienteBtn");
        const abrirRegistroModalBtn = document.getElementById("abrirRegistroModalBtn");
        const registroModal = document.getElementById("registroModal");
        const cerrarModalBtn = document.getElementById("cerrarModalBtn");
        const consultaForm = document.getElementById("registroConsultaForm");
        const consultaMessages = document.querySelectorAll(".consulta-message");
        const registroExpediente = document.getElementById("registroExpediente");
        const expedienteModal = document.getElementById("expedienteModal");
        const cerrarModalExpInfo = document.getElementById("cerrarModalExpInfo");
        

        // Buscar paciente
        buscarPacienteBtn.addEventListener("click", () => {
            const codigo = document.getElementById("codigoPaciente").value;
            fetch('veterinaria/buscar-paciente', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ codigo })
            })
            .then(response => response.json())
            .then(data => {
                const pacienteInfo = document.getElementById("pacienteInfo");
                if (data.success) {
                    pacienteInfo.innerHTML = "";
                    pacienteInfo.innerHTML = `
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Información del Paciente</h4>
                                <p><strong>Código:</strong> ${data.paciente.codigo}</p>
                                <p><strong>Paciente:</strong> ${data.paciente.nombre_paciente}</p>
                                <p><strong>Fecha de Nacimiento:</strong> ${data.paciente.fecha_nacimiento}</p>
                            </div>
                            <div class="col-md-6">
                            <h4>Información del Propietario</h4>
                                <p><strong>Propietario:</strong> ${data.paciente.nombre_propietario}</p>
                                <p><strong>Correo:</strong> ${data.paciente.correo}</p>
                                <p><strong>Teléfono:</strong> ${data.paciente.telefono}</p>
                            </div>
                        </div>
                    `;
                    localStorage.setItem("codigo", codigo);
                    consultaForm.classList.remove("d-none");
                    registroExpediente.classList.remove("d-none");
                    consultaMessages.forEach(message => {
                        message.classList.add("d-none");
                    });
                    fetch('veterinaria/buscar-consultas', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ codigo })
                    })
                    .then(response => response.json())
                    .then(data => {
                        const dataExpedientes = document.getElementById("dataExpedientes");
                        if (data.success) {
                            // Limpiar el contenido actual
                            dataExpedientes.innerHTML = "";
                    
                            // Recorrer los datos y construir las filas
                            data.consultasList.forEach(consulta => {
                                dataExpedientes.innerHTML += `
                                    <tr>
                                        <td>${consulta.fecha}</td>
                                        <td>${consulta.diagnostico}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-numero-expediente="${consulta.numero_expediente}">Ver</button>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            dataExpedientes.innerHTML = "<tr><td colspan='3'>El paciente no tiene expediente</td></tr>";
                        }
                    });
                } else {
                    pacienteInfo.innerHTML = `<p>${data.message}</p>`;
                    consultaForm.classList.add("d-none");
                    registroExpediente.classList.add("d-none");
                    consultaMessages.forEach(message => {
                        message.classList.remove("d-none");
                    });
                }
            });
        });

        // Delegación de eventos para los botones "Ver"
        dataExpedientes.addEventListener("click", (event) => {
            if (event.target.tagName === "BUTTON" && event.target.classList.contains("btn-info")) {
                const numero = event.target.dataset.numeroExpediente;
                fetch('veterinaria/buscar-expediente', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ numero })
                })
                .then(response => response.json())
                .then(data => {
                    const expedienteInfo = document.getElementById("expedienteInfo");
                    if (data.success) {
                        // Limpiar el contenido actual
                        expedienteInfo.innerHTML = "";
                        expedienteInfo.innerHTML += `
                            <div class="row">
                                <div class="mt-3">
                                    <h5>Diagnostico:</h5>
                                    <p>${data.expediente.diagnostico}</p>
                                </div>
                                <div class="mt-3">
                                    <h5>Tratamiento:</h5>
                                    <p>${data.expediente.tratamiento}</p>
                                </div>
                            </div>
                        `;
                    } else {
                        expedienteInfo.innerHTML = "<p>Nada</p>";
                    }
                });
                console.log(numero);
                expedienteModal.style.display = "block";
            }
        });

        // Cerrar modal
        cerrarModalExpInfo.addEventListener("click", () => {
            expedienteModal.style.display = "none";
        });

        // Abrir modal de registro
        abrirRegistroModalBtn.addEventListener("click", () => {
            registroModal.style.display = "block";
        });

        // Cerrar modal
        cerrarModalBtn.addEventListener("click", () => {
            registroModal.style.display = "none";
        });

        // Registrar paciente
        const registroForm = document.getElementById("registroPacienteForm");
        registroForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(registroForm);
            fetch('veterinaria/registrar-paciente', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    registroModal.style.display = "none";
                    registroForm.reset();
                }
            });
        });

        // Registrar expediente y consulta
        const expedienteForm = document.getElementById("registroExpedienteForm");
        expedienteForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(expedienteForm);
            console.log(formData);

            const inputs = consultaForm.querySelectorAll("input, select");
            let isValid = true;

            // Validar que los campos de consultaForm no estén vacíos
            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                alert("Por favor, completa todos los campos del formulario de consulta.");
                return;
            }

            //Validar que no exista el expediente x numero
            const numero = formData.get("numero");
            fetch('veterinaria/buscar-expediente', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ numero })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("El número de expediente ya existe");
                } else {
                    const formDataConsulta = new FormData(consultaForm);
                    const codigo = formDataConsulta.get("codigo");
                    fetch('veterinaria/buscar-consulta', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ codigo })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("El código de consulta ya existe");
                        } else {
                            //si llega hasta aca los datos son validos y guardaremos el expediente
                            fetch('veterinaria/registrar-expediente', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                const paciente = localStorage.getItem("codigo")//codigo de paciente
                                formDataConsulta.append("paciente", paciente);
                                formDataConsulta.append("expediente", numero);
                                if (data.success) {
                                    fetch('veterinaria/registrar-consulta-nueva', {
                                        method: 'POST',
                                        body: formDataConsulta
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            alert("La información de la consulta se guardo exitosamente.");
                                            location.reload(true);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });
    }

    /* Script para consultasView */
    if (window.location.pathname === '/veterinaria/consultas') {
        const buscarConsultaBtn = document.getElementById("buscarConsultaBtn");
        const updateDeleteModal = document.getElementById("updateDeleteModal");
        const cerrarUpdateDeleteModalBtn = document.getElementById("cerrarUpdateDeleteModalBtn");
        const updateDeleteModalForm = document.getElementById("updateDeleteModalForm");
        const deleteBtn = document.getElementById("deleteBtn");


        buscarConsultaBtn.addEventListener("click", () => {
            const codigo = document.getElementById("codigoConsultaBuscar").value;
            fetch('veterinaria/buscar-consulta', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ codigo })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('codigoConsulta').value = data.consulta.codigo;
                    document.getElementById('medicoSelect').value = data.consulta.medico;
                    document.getElementById('fechaConsulta').value = data.consulta.fecha;
                    document.getElementById('horaConsulta').value = data.consulta.hora;
                    document.getElementById('numeroExp').value = data.consulta.expediente;
                    const numero = data.consulta.expediente
                    fetch('veterinaria/buscar-expediente', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ numero })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('diagnosticoExp').value = data.expediente.diagnostico;
                            document.getElementById('tratamientoExp').value = data.expediente.tratamiento;
                            updateDeleteModal.style.display = "block";
                        }
                    });
                } else {
                    alert("No se encontró una consulta con ese código.")
                }
            });
        });

        //actualizar consulta y expediente
        updateDeleteModalForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const formData = new FormData(updateDeleteModalForm);
            formData.append('codigo', document.getElementById('codigoConsulta').value);
            formData.append('numero', document.getElementById('numeroExp').value);
            fetch('veterinaria/actualizar-consulta', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    fetch('veterinaria/actualizar-expediente', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                    });
                    location.reload(true);
                } else {
                    alert("Error al actulizar consulta");
                }
            });
        });
        //eliminar consulta y expediente
        deleteBtn.addEventListener("click", () => {
            const formData = new FormData(updateDeleteModalForm);
            formData.append('codigo', document.getElementById('codigoConsulta').value);
            formData.append('numero', document.getElementById('numeroExp').value);
            fetch('veterinaria/eliminar-consulta', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    fetch('veterinaria/eliminar-expediente', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    location.reload(true);
                } else {
                    alert("Error al eliminar consulta");
                }
            });
        });

        // Cerrar modal
        cerrarUpdateDeleteModalBtn.addEventListener("click", () => {
            updateDeleteModal.style.display = "none";
        });
    }
});
