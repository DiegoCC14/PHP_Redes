
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

      let contador_Boca_Junior = 0;
      let contador_River_Plate = 0;
      let contador_San_Lorenzo = 0;
      let contador_Racing = 0;
      let contador_Independiente = 0;
      let contador_Otro = 0;

      for (const correo in data) {
        if (data[correo] === "Boca Juniors") {
          contador_Boca_Junior++;
        }
        if (data[correo] === "River Plate") {
          contador_River_Plate++;
        }
        if (data[correo] === "San Lorenzo") {
          contador_San_Lorenzo++;
        }
        if (data[correo] === "Racing") {
          contador_Racing++;
        }
        if (data[correo] === "Independiente") {
          contador_Independiente++;
        }
        if (data[correo] === "Otro") {
          contador_Otro++;
        }

      }
      
      let span = document.getElementById("Boca Juniors_span");
      if (span) {
        span.innerHTML = `<span id="Boca Juniors_span">${contador_Boca_Junior}</span>` 
      }

      span = document.getElementById("River Plate_span");
      if (span) {
        span.innerHTML = `<span id="River Plate_span">${contador_River_Plate}</span>` 
      }

      span = document.getElementById("San Lorenzo_span");
      if (span) {
        span.innerHTML = `<span id="San Lorenzo_span">${contador_San_Lorenzo}</span>` 
      }

      span = document.getElementById("Racing_span");
      if (span) {
        span.innerHTML = `<span id="Racing_span">${contador_Racing}</span>` 
      }

      span = document.getElementById("Independiente_span");
      if (span) {

        span.innerHTML = `<span id="Independiente_span">${contador_Independiente}</span>` 
      }

      span = document.getElementById("Otro_span");
      if (span) {
        span.innerHTML = `<span id="Otro_span">${contador_Otro}</span>` 
      }

    })
    .catch(error => {
      console.error("Error al obtener el JSON:", error);
    });
}


console.log("Inicio Proceso --->>>")
actualizar_votacion();