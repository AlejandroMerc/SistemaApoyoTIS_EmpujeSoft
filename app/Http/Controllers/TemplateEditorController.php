<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TemplateEditorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_type = Session::get('type');
        $id = Session::get('id');

        $title = 'Asesor';
        if($user_type == 'estudiante')
        {
            $row = Estudiante::where('user_id',$id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else
            {
                $row = Grupoempresa::where('id',$ge_id)->first();
                $title = $row->nombre_largo;
            }
        }
        $doc = '
        <html>
<head>
<title>D:\uploadedFiles\bd6fb049ec3c37b4c868f1147baf3fda-613cb11d1fddcb78\p1fka7lrfotj51ia31fv43jq1hsu4.pdf</title>
<style type="text/css">
<!--
body { font-family: Arial; font-size: 20.4px }
.pos { position: absolute; z-index: 0; left: 0px; top: 0px }
-->
</style>
</head>
<body>
<nobr><nowrap>
<div class="pos" id="_0:0" style="top:0">
<img name="_1100:850" src="page_001.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
<div class="pos" id="_385:52" style="top:52;left:385">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
IBM Watson</span>
</div>
<div class="pos" id="_49:83" style="top:83;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
&#191;Qui&#233;n es IBM Watson? </span>
</div>
<div class="pos" id="_49:114" style="top:114;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Watson es una aplicaci&#243;n de tecnolog&#237;as avanzadas dise&#241;adas para el procesamiento de lenguajes naturales, la </span>
</div>
<div class="pos" id="_49:134" style="top:134;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
recuperaci&#243;n de informaci&#243;n, la representaci&#243;n del conocimiento, el razonamiento autom&#225;tico, y el aprendizaje </span>
</div>
<div class="pos" id="_49:154" style="top:154;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
autom&#225;tico al campo abierto de b&#250;squedas de respuestas. </span>
</div>
<div class="pos" id="_49:186" style="top:186;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
&#191;Qu&#233; tareas realiza?</span>
</div>
<div class="pos" id="_49:217" style="top:217;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Watson es capaz de realizar diversas tareas como:</span>
</div>
<div class="pos" id="_49:237" style="top:237;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Actuar como asistente</span>
</div>
<div class="pos" id="_49:257" style="top:257;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Recolectar, organizar y analizar datos</span>
</div>
<div class="pos" id="_49:277" style="top:277;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Crear y entrenar otras IA</span>
</div>
<div class="pos" id="_49:297" style="top:297;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Descubrir informaci&#243;n valiosa</span>
</div>
<div class="pos" id="_49:317" style="top:317;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Etiquetar y clasificar im&#225;genes (ya que cuenta con reconocimiento visual)</span>
</div>
<div class="pos" id="_49:337" style="top:337;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
- Entender el tono y estado emocional del interlocutor (para dar una respuesta m&#225;s adaptada al estado emocional del </span>
</div>
<div class="pos" id="_49:358" style="top:358;left:49">
<span id="_14.8" style=" font-family:Arial; font-size:14.8px; color:#000000">
interlocutor)</span>
</div>
<div class="pos" id="_49:389" style="top:389;left:49">
<span id="_13.6" style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
&#191;Qu&#233; a&#241;o se ha creado?</span>
</div>
<div class="pos" id="_49:420" style="top:420;left:49">
<span id="_13.6" style=" font-family:Arial; font-size:13.6px; color:#000000">
La idea surgi&#243; en 2004. En 2005, David Ferrucci acept&#243; el nuevo reto de IBM de crear un sistema capaz de jugar a </span>
</div>
<div class="pos" id="_49:440" style="top:440;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
jeopardy, pero no fue hasta 2011 que lograron su objetivo, cuando Watson venci&#243; a los dos mejores jugadores de </span>
</div>
<div class="pos" id="_49:460" style="top:460;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
jeopardy. </span>
</div>
<div class="pos" id="_49:492" style="top:492;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
&#191;Qu&#233; capacidad de almacenamiento tiene?</span>
</div>
<div class="pos" id="_49:523" style="top:523;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Durante el juego de jeopardy, se utiliz&#243; la memoria RAM como medio de almacenamiento por que los datos </span>
</div>
<div class="pos" id="_49:543" style="top:543;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
almacenados en discos duros son demasiado lentos para acceder. El sistema de Watson cuenta con un total de 16 </span>
</div>
<div class="pos" id="_49:563" style="top:563;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Terabytes de RAM.</span>
</div>
<div class="pos" id="_49:594" style="top:594;left:49">
<span id="_13.6" style="font-weight:bold; font-family:Arial; font-size:13.6px; color:#000000">
&#191;Cu&#225;l es su objetivo?</span>
</div>
<div class="pos" id="_49:625" style="top:625;left:49">
<span id="_14.2" style=" font-family:Arial; font-size:14.2px; color:#000000">
Adem&#225;s de simplemente jugar jeopardy, el objetivo de Watson es la posibilidad de que las maquinas interact&#250;en de </span>
</div>
<div class="pos" id="_49:646" style="top:646;left:49">
<span id="_14.2" style=" font-family:Arial; font-size:14.2px; color:#000000">
forma natural con los humanos, comprendiendo las preguntas que los humanos les formulen y dando respuestas que los </span>
</div>
<div class="pos" id="_49:666" style="top:666;left:49">
<span id="_14.2" style=" font-family:Arial; font-size:14.2px; color:#000000">
humanos puedan entender.</span>
</div>
<div class="pos" id="_49:697" style="top:697;left:49">
<span id="_13.7" style="font-weight:bold; font-family:Arial; font-size:13.7px; color:#000000">
&#191;Qui&#233;nes crearon a Watson?</span>
</div>
<div class="pos" id="_49:728" style="top:728;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Watson era principalmente un esfuerzo de IBM, pero su equipo de desarrollo incluye profesores y estudiantes de la </span>
</div>
<div class="pos" id="_49:748" style="top:748;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Universidad Carnegie Mellon, la Universidad de Massachusetts en Amherst, el Instituto para Ciencias de Informaci&#243;n de </span>
</div>
<div class="pos" id="_49:768" style="top:768;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
la Universidad del Sur de California, la Universidad de Texas en Austin, el Instituto Tecnol&#243;gico de Massachusetts, la </span>
</div>
<div class="pos" id="_49:789" style="top:789;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
Universidad de Trento, y el Instituto Polit&#233;cnico Rensselaer.</span>
</div>
<div class="pos" id="_49:820" style="top:820;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
&#191;En qu&#233; &#225;reas trabaja Watson para solucionar problemas?</span>
</div>
<div class="pos" id="_49:851" style="top:851;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
IBM ha centrado sus esfuerzos en el desarrollo de tres grandes ramas de crecimiento: </span>
</div>
<div class="pos" id="_49:882" style="top:882;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
 &#149; <span style="font-weight:bold"> Watson Discovery Advisor:</span> trabaja en proyectos de investigaci&#243;n relaci&#243;n con la industria farmac&#233;utica y la </span>
</div>
<div class="pos" id="_49:902" style="top:902;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
biotecnol&#243;gica.</span>
</div>
<div class="pos" id="_49:923" style="top:923;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
 &#149; Watson Engagement Advisor:<span style="font-weight:normal"> &#225;rea desde el que se desarrollan aplicaciones self-service (chatbots, asistentes </span></span>
</div>
<div class="pos" id="_49:943" style="top:943;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
virtuales, etc.) para a partir de la interpretaci&#243;n del lenguaje natural, dar respuesta a las necesidades de los usuarios de </span>
</div>
<div class="pos" id="_49:963" style="top:963;left:49">
<span id="_15.0" style=" font-family:Arial; font-size:15.0px; color:#000000">
empresa.</span>
</div>
<div class="pos" id="_49:983" style="top:983;left:49">
<span id="_14.1" style="font-weight:bold; font-family:Arial; font-size:14.1px; color:#000000">
 &#149; Watson Explorer:<span style="font-weight:normal"> ayuda a los usuarios a descubrir, estructurar y compartir informaci&#243;n a partir de enormes </span></span>
</div>
<div class="pos" id="_49:1003" style="top:1003;left:49">
<span id="_14.1" style=" font-family:Arial; font-size:14.1px; color:#000000">
vol&#250;menes de datos.</span>
</div>
<div class="pos" id="_0:0" style="top:1100">
<img name="_1100:850" src="page_002.jpg" height="1100" width="850" border="0" usemap="#Map"></div>
<div class="pos" id="_50:1152" style="top:1152;left:50">
<span id="_13.8" style="font-weight:bold; font-family:Arial; font-size:13.8px; color:#000000">
Cualquier persona puede usar este software, por qu&#233;?</span>
</div>
</nowrap></nobr>
</body>
</html>
';
        // $doc = str_replace('&', '&amp', $doc);
        return view('templateeditor',['user_type' => $user_type, 'title' => $title, 'dochtml' => $doc]);
    }
}
