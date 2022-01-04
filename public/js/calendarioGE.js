var calendario_id = 0;
window.onload = load;
function load(){
  calendario_id = document.getElementById('calendario_id').value;
  console.log(calendario_id);
}
function calendario(grupoempresa_id) {
  let formulario = document.querySelector("#formularioEventos");
  var calendarEl = document.getElementById('calendario2');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    locale:'es',
    displayEventTime:false,
    headerToolbar:{
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,listWeek'
  },
  //events: baseURL+"/evento/mostrar",
  eventSources:{
    url: baseURL+"/calendarioGE/mostrar/"+grupoempresa_id,
    method:"POST",
    extraParams:{
      _token: formulario._token.value,
    }
  },

  dateClick:function(info){
    formulario.reset();
    formulario.start.value = info.dateStr;
    formulario.end.value = info.dateStr;
    $("#evento").modal("show");
  },
  eventClick:function(info){
    var evento = info.event;
    axios.post(baseURL+"/evento/editar/"+info.event.id).
    then(
        (respuesta)=>{
            formulario.id.value = respuesta.data.id;
            formulario.title.value = respuesta.data.title;
            formulario.description.value = respuesta.data.description;
            formulario.start.value = respuesta.data.start;
            formulario.end.value = respuesta.data.end;
            $("#evento").modal("show");
        }
        ).catch(
            error => {if(error.response){console.log(error.response.data);}
            } 
        )
  }
});
calendar.render();

document.getElementById("btn_guardar").addEventListener("click",function(){
  var input_id = document.getElementById('calendario_id').value;
  console.log(input_id);
  enviarDatos("/evento/agregar/"+input_id);
});
    
function enviarDatos(url){
    const datos = new FormData(formulario);
    const nuevaURL = baseURL+url;
    axios.post(nuevaURL,datos).
    then(
      (respuesta) => {
          calendar.refetchEvents();
          ("#evento").modal("hide");
      }  
    ).catch(
        error => {if(error.response){console.log(error.response.data);}
        }
    )
}
}

calendario()