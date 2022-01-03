document.addEventListener('DOMContentLoaded', function() {
    
    let formulario = document.querySelector("#formularioEventos");
    var calendarEl = document.getElementById('calendario');
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
        url: baseURL+"/evento/mostrar",
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
        console.log(evento);
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
       enviarDatos("/evento/agregar/"+formulario.calendario_id.value);
    });

    document.getElementById("btn_eliminar").addEventListener("click",function(){
        enviarDatos("/evento/borrar/"+formulario.id.value);
    });
    //document.getElementById("btn_modificar").addEventListener("click",function(){
    //    enviarDatos("/evento/actualizar/"+formulario.id.value);
    //});
    
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
  });