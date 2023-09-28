<?php

$notas = [];
$aprobados = [];
$aplazados = [];
$maximo = [];

//  N tarjetas de datos
for ($i = 0; $i < $_POST['N']; $i++) {
    $notas[] = [
        'cedula' => $_POST['cedula' . $i],
        'nombre' => $_POST['nombre' . $i],
        'matematicas' => $_POST['matematicas' . $i],
        'fisica' => $_POST['fisica' . $i],
        'programacion' => $_POST['programacion' . $i],
    ];
}

// Calculamos el promedio de cada materia
foreach ($notas as $nota) {
    $aprobados[$nota['materia']] += ($nota['nota'] >= 7) ? 1 : 0;
    $aplazados[$nota['materia']] += ($nota['nota'] < 7) ? 1 : 0;
    $maximo[$nota['materia']] = max($maximo[$nota['materia']], $nota['nota']); //maxima nota
}

// Calculamos el número de alumnos que aprobaron todas las materias
$aprobados_todas = 0;
foreach ($notas as $nota) {
    if ($nota['matematicas'] >= 7 && $nota['fisica'] >= 7 && $nota['programacion'] >= 7) {
        $aprobados_todas++;
    }
}

// Calculamos el número de alumnos que aprobaron una sola materia
$aprobados_una = 0;
foreach ($notas as $nota) {
    if ($nota['matematicas'] >= 7) {
        $aprobados_una++;
    } else if ($nota['fisica'] >= 7) {
        $aprobados_una++;
    } else if ($nota['programacion'] >= 7) {
        $aprobados_una++;
    }
}

// Calculamos el número de alumnos que aprobaron dos materias
$aprobados_dos = 0;
foreach ($notas as $nota) {
    if ($nota['matematicas'] >= 7 && $nota['fisica'] < 7 && $nota['programacion'] < 7) {
        $aprobados_dos++;
    } else if ($nota['matematicas'] < 7 && $nota['fisica'] >= 7 && $nota['programacion'] < 7) {
        $aprobados_dos++;
    } else if ($nota['matematicas'] < 7 && $nota['fisica'] < 7 && $nota['programacion'] >= 7) {
        $aprobados_dos++;
    }
}

// Imprimimos los resultados
echo "Promedio de cada materia:";
foreach ($maximo as $materia => $nota) {
    echo "   $materia: $nota";
}

echo "Número de alumnos aprobados en cada materia:";
foreach ($aprobados as $materia => $cantidad) {
    echo "   $materia: $cantidad";
}

echo "Número de alumnos aplazados en cada materia:";
foreach ($aplazados as $materia => $cantidad) {
    echo "   $materia: $cantidad";
}

echo "Número de alumnos que aprobaron todas las materias: $aprobados_todas";
echo "Número de alumnos que aprobaron una sola materia: $aprobados_una";
echo "Número de alumnos que aprobaron dos materias: $aprobados_dos";

?>