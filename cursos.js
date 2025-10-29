document.addEventListener('DOMContentLoaded', async function() {
  try {
    const response = await fetch('cursosController.php');
    if (!response.ok) throw new Error(`Error: ${response.status}`);
    const result = await response.json();
    const cursos = result.data;
    const tbody = document.querySelector('#tablaCursos tbody');
    tbody.innerHTML = ''; // Limpiar tabla

    cursos.forEach(curso => {
      const fila = document.createElement('tr');
      fila.innerHTML = `
        <td>${curso.idcurso}</td>
        <td>${curso.curso}</td>
        <td>${curso.descripcion}</td>
        <td>${curso.horario}</td>
        <td>${curso.docente}</td>
      `;
      tbody.appendChild(fila);
    });

  } catch (error) {
    console.error('Error al cargar cursos:', error);
    const tbody = document.querySelector('#tablaCursos tbody');
    tbody.innerHTML = `<tr><td colspan="3">Error al cargar datos</td></tr>`;
  }

});