const abrirRegistroModalBtn = document.getElementById("abrirRegistroModalBtn");
const registroModal = document.getElementById("modalUsuario");
const cerrarModalBtn = document.getElementById("cerrarModalBtn");
const username = document.getElementById("username");
const codigo = document.getElementById("registroCodigo");
const password = document.getElementById("password");
const op = document.getElementById("op");
document.addEventListener("DOMContentLoaded", () => {
    // Abrir modal de registro
    abrirRegistroModalBtn.addEventListener("click", () => {
        registroModal.style.display = "block";
    });

    // Cerrar modal
    cerrarModalBtn.addEventListener("click", () => {
        registroModal.style.display = "none";
        registroForm.reset();
        codigo.disabled=false;
    });

    // Registrar paciente
    const registroForm = document.getElementById("registroUsuarioForm");
    registroForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const formData = new FormData(registroForm);
        if(op.value =='ingresar'){
            fetch('/veterinaria/usuario/registrar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status=='succes') {
                    alert("Registro exitoso");
                    registroModal.style.display = "none";
                    registroForm.reset();
                    window.location.href = '/veterinaria/usuarios';
                }else{
                    alert("No se pudo registrar codigo o user repetidos");
                }
            });
        }else{
            fetch('/veterinaria/usuario/editar', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status=='succes') {
                    alert("Edición exitosa");
                    registroModal.style.display = "none";
                    registroForm.reset();
                    codigo.disabled=false;
                    window.location.href = '/veterinaria/usuarios';
                }else{
                    alert("No se pudo editar codigo o user repetidos");
                }
            });
        }
        
        
    });
});
function handleAction(action, id) {
    if (action === 'edit') {
        // Lógica para edición
        obtenerUsuario(id);
    } else if (action === 'delete') {
        if (confirm(`¿Estás seguro de eliminar el elemento con ID: ${id}?`)) {
            eliminar(id);
        }
    }
}

function obtenerUsuario(id){
    var data = {
        opcion: 'obtener',
        codigo: id
    };
    fetch('/veterinaria/usuario/obtener', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify(data) // Convertimos los datos en formato JSON
    })
    .then(response => response.json())  // Esperamos la respuesta en formato JSON
    .then(responseData => {
        console.log('Respuesta del servidor:', responseData);
        if(responseData.status=='succes'){
            registroModal.style.display = "block";
            username.value=responseData.nombre;
            codigo.value =responseData.codigo;
            codigo.disabled=true;
            password.value = responseData.password;
            op.value = "editar";
        }else{
            alert("No se pudo editar");
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
}

function eliminar(id){
    var data = {
        opcion: 'eliminar',
        codigo: id
    };
    fetch('/veterinaria/usuario/eliminar', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify(data) // Convertimos los datos en formato JSON
    })
    .then(response => response.json())  // Esperamos la respuesta en formato JSON
    .then(responseData => {
        console.log('Respuesta del servidor:', responseData);
        if(responseData.status=='sucess'){
            alert("Elemento eliminado");
            window.location.href = '/veterinaria/usuarios';
        }else{
            alert("No se pudo eliminar");
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));
}