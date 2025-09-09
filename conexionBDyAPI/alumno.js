
document.getElementById('registro').addEventListener('submit', async function(event) {
    event.preventDefault(); 
    console.log("hola");
    const form = event.target;
    const nombre = form.nombre.value;
    const apellido = form.apellido.value;

    
    const data = {
        nombre: nombre,
        apellido: apellido
    };

    try {

        const response = await fetch('alumnoController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify(data) 
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();

        document.getElementById('resultado').innerText = `Respuesta del servidor: ${result.status_message}`;

    } catch (error) {
        console.error('Error al enviar la solicitud:', error);
        document.getElementById('resultado').innerText = `Error: ${error.status_message}`;
    }
});