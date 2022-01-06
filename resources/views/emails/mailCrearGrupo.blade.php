<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>docente: {{$user->name}} {{$user->lastname}} sigla:{{$request->sigla}} codigo de inscripcion: {{$request->codigoInscripcion}} </p>
    <p>semestre{{$semestre->periodo}}-{{$semestre->year}}</p>
    
</body>
</html>