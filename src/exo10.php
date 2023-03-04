<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);
// ton code ici
$today = new DateTime('today');
$currentYear = $today->format('Y');
$year = $_GET['year'] ?? $currentYear;
$minYear = $currentYear-5;
$maxYear = $currentYear+5;
$allowedYears = range($minYear,$maxYear);
if (strlen($year) !== 4 || !is_numeric($year)){
    throw new Exception('les conditions ne sont pas toutes réunies');
}
if ($year > $maxYear || $year < $minYear) {
    header('Location: /src/exo10.php');
}
$daysNames = [
    1=>'Lun',
    2=>'Mar',
    3=>'Mer',
    4=>'Jeu',
    5=>'Ven',
    6=>'Sam',
    7=>'Dim'
];
$monthsNames = [
    1=>'Janvier',
    2=>'Fevrier',
    3=>'Mars',
    4=>'Avril',
    5=>'Mais',
    6=>'Juin',
    7=>'Juillet',
    8=>'Aout',
    9=>'Septembre',
    10=>'Octobre',
    11=>'Novembre',
    12=>'Decembre'
];
$prevmonthdays = [];
$month = [];
foreach ($monthsNames as $monthNum=>$monthName) {
    $debut = new DateTime($year . '-' . $monthNum . '-01');
    $fin = clone $debut;
    $fin->modify('next month');
    $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);
    $prevmonthdays = $debut->format('N')-1;
$month[$monthNum] = [
    'name'=>$monthName,
    'prevmonthdays' =>$prevmonthdays
];
    foreach ($monthRange as $day) {
        $month[$monthNum]['days'][$day->format("Ymd")] = [
            'numInDay' => $day->format('w'),
            'dayNumber'=> $day,
            'fullDate' => $day,
            'prevmonthdays' => $prevmonthdays
        ];
    }
}
// fin de ton code
echo $twig->render('calendar.html.twig', [
    'monthsNames' =>$month,
    'daysNames'=>$daysNames,
    'today'=>$today,
    'year'=>$year,
    'currentYear'=>$currentYear,
    'allowedYears'=> $allowedYears,
    'maxYear'=> $maxYear,
    'minYear'=> $minYear,
    ]);