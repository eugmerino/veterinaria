var token = localStorage.getItem('jwt_token');
console.log(token);
// Crear los parámetros de consulta
const data = {
    jwt: token
};

    // Hacer la solicitud POST al archivo PHP
    fetch('/veterinaria/validarToken', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify(data) // Convertimos los datos en formato JSON
    })
    .then(response => response.json())  // Esperamos la respuesta en formato JSON
    .then(responseData => {
        console.log('Respuesta del servidor:', responseData);
        if(responseData.status =='failed'){
            window.location.href = '/veterinaria'
        }
    })
    .catch(error => console.error('Error en la solicitud:', error));

    // Función para cerrar sesión
    function logout() {
        // Eliminar el token del almacenamiento
        localStorage.removeItem('jwt_token');

        // Redirigir al usuario a la página de inicio de sesión
        window.location.href = '/veterinaria';
    }

    // Agregar evento al botón de cerrar sesión
    document.getElementById('logoutButton').addEventListener('click', logout);
