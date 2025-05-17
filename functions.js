
function validar() {
  
  const email = document.getElementById('email').value.trim();
  
  const sinCaracteresEspeciales = /^[a-zA-Z0-9@._-]+$/.test(email);

  if ( email.length < 7 ) {
    alert("Email tiene menos de 7 caracteres");
    return false;
  }
  if ( email[0] == "." || email[email.length - 1] == "." ) {
    alert("Email tiene punto en inicio o final");
    return false;
  }
  if ( !email.includes(".") ) {
    alert("Email no incluye .");
    return false;
  }

  if ( email[0] == "@" || email[email.length - 1] == "@" ) {
    alert("Email tiene @ en inicio o final");
    return false;
  }
  if ( !email.includes("@") ) {
    alert("Email no incluye @");
    return false;
  }
  
  if (!sinCaracteresEspeciales){
    alert("Email contiene caracteres especiales");
    return false;
  }

  // Verifica si se seleccionó algún equipo
  const equipos = document.getElementsByName('equipo');
  let equipoSeleccionado = false;

  for (let i = 0; i < equipos.length; i++) {
    if (equipos[i].checked) {
      equipoSeleccionado = true;
      break;
    }
  }

  if (!equipoSeleccionado) {
    alert("No se selecciono un equipo");
    return false;
  }

  return true;
}


function actualizar_votacion() {
  fetch('/correo_votos.json')
    .then(response => {
      if (!response.ok) throw new Error("No se pudo cargar el JSON");
      return response.json();
    })
    .then(data => {

      let contador = 0;
      for (const correo in data) {
        if (data[correo] === "Otro") {
          contador++;
        }
      }
      
      const span = document.getElementById("Otro_span");
      if (span) {
        span.textContent += contador;
      }

      console.log("✅ Datos recibidos desde el servidor:", data);
    })
    .catch(error => {
      console.error("Error al obtener el JSON:", error);
    });
}


console.log("Inicio Proceso --->>>")
actualizar_votacion();