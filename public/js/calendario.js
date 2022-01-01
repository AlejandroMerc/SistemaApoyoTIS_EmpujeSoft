document.addEventListener('DOMContentLoaded', function() {
    
    let formulario = document.querySelector("form");
    var calendarEl = document.getElementById('calendario');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale:'es',
      headerToolbar:{
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      events: baseURL+"/evento/mostrar",

      dateClick:function(info){
        formulario.reset();
        formulario.start.value = info.dateStr;
        formulario.end.value = info.dateStr;  
        $("#evento").modal("show");
      }
    
    });
    calendar.render();

    document.getElementById("btn_guardar").addEventListener("click",function(){
        const datos = new FormData(formulario);
        //console.log(datos);
        axios.post(baseURL+"/evento/agregar",datos).
        then(
            (respuesta)=>{
                $("#evento").modal("hide");
            }
            ).catch(
                error => {if(error.response){console.log(error.response.data);}
                } 
            )
    });

   
    function enviarDatos(url){
        const datos = new FormData(formulario);
        const nuevaURL = baseURL+url; 
        axios.post(nuevaURL,datos);
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