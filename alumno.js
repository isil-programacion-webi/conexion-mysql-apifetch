//REGISTRAR
document.getElementById('registro').addEventListener('submit', async function(event) {
    event.preventDefault(); 

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

        document.getElementById('resultado').innerText = `Respuesta del servidor: ${result.message}`;

    } catch (error) {
        console.error('Error al enviar la solicitud:', error);
        document.getElementById('resultado').innerText = `Error: ${error.message}`;
    }
});

//BUSCAR POR ID
document.getElementById('buscar').addEventListener('click', async function() {

    const id = document.getElementById('id').value;
    const apellido = document.getElementById('apellido').value;
    // Construir la URL con parámetros



    let url = '';

    if(id){
        url = `alumnoController.php/id/${encodeURIComponent(id)}`;
    }else{
         url = `alumnoController.php/apellido/${encodeURIComponent(apellido)}`;
    }




    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const result = await response.json();
        const alumnos = result.data;

        const tbody = document.querySelector('#tablaAlumnos tbody');
        tbody.innerHTML = ''; // Limpiar tabla

        alumnos.forEach(alumno => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${alumno.idalumnos}</td>
            <td>${alumno.nombre}</td>
            <td>${alumno.apellido}</td>
        `;
        tbody.appendChild(fila);
        });


        document.getElementById('resultado').innerText = `Respuesta del servidor: ${result.data[0].nombre}`;
    } catch (error) {
        console.error('Error al enviar la solicitud:', error);
        document.getElementById('resultado').innerText = `Error: ${error.message}`;
    }
});

//MOSTRAR TODO
document.addEventListener('DOMContentLoaded', async function() {
  try {
    const response = await fetch('alumnoController.php');
    if (!response.ok) throw new Error(`Error: ${response.status}`);

    const result = await response.json();
    const alumnos = result.data;

    const tbody = document.querySelector('#tablaAlumnos tbody');
    tbody.innerHTML = ''; // Limpiar tabla

    alumnos.forEach(alumno => {
      const fila = document.createElement('tr');
      fila.innerHTML = `
        <td>${alumno.idalumnos}</td>
        <td>${alumno.nombre}</td>
        <td>${alumno.apellido}</td>
      `;
      tbody.appendChild(fila);
    });

  } catch (error) {
    console.error('Error al cargar alumnos:', error);
    const tbody = document.querySelector('#tablaAlumnos tbody');
    tbody.innerHTML = `<tr><td colspan="3">Error al cargar datos</td></tr>`;
  }
});