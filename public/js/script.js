document.addEventListener("DOMContentLoaded", () => {
    const buscarPacienteBtn = document.getElementById("buscarPacienteBtn");
    const abrirRegistroModalBtn = document.getElementById("abrirRegistroModalBtn");
    const registroModal = document.getElementById("registroModal");
    const cerrarModalBtn = document.getElementById("cerrarModalBtn");

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
            } else {
                pacienteInfo.innerHTML = `<p>${data.message}</p>`;
                abrirRegistroModalBtn.style.display = "block";
            }
        });
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
});
