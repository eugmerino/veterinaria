console.log("entro hola");
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();
    enviar();
});

function enviar(){
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var data = {
        username: username,
        password: password
    };
        // Hacer la solicitud POST al archivo PHP
    fetch('/veterinaria/login/validar', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify(data) // Convertimos los datos en formato JSON
    })
    .then(response => response.json())  // Esperamos la respuesta en formato JSON
    .then(responseData => {
        console.log('Respuesta del servidor:', responseData);
        login(responseData);
    })
    .catch(error => console.error('Error en la solicitud:', error));
}

function login(json) {
    if (json.status === 'sucess') {

        localStorage.setItem('jwt_token', json.jwt);     // Guardar en localStorage
        console.log("Login exitoso, token guardado.");
        window.location.href = '/veterinaria/inicio';  // Redirigir a una página protegida
    } else {
        alert('Credenciales incorrectas');
    }
}