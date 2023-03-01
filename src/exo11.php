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
    header('Location: /src/exo11.php');
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

$month = [];
$monthprev = [];
//on crée une boucle foreach sur le [tableau: clé=>mois] des mois qui composent une année. et dans cette boucle on met en evidence la clé qui va parcourir les valeurs['mois'] de celui ci.
foreach ($monthsNames as $monthNum=>$monthName) {
    //pour chaque mois on defini un debut
    $debut = new DateTime($year . '-' . $monthNum . '-01');
    $fin = clone $debut;
    //pour chaque mois on defini une fin
    $fin->modify('next month');
    //à partir du debut et de la fin, on crée la periode definie pour chaque mois
    $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);
    // on remplis une variable de valeurs "debut de mois" (x12) grace à la boucle  qui parcours les 12 mois d'une année

    // periode pour trouver les derniers jours du mois dernier:
    $prevDebut = new DateTime($year . '-' . $monthNum . '-01');
    $prevmonthdays = $prevDebut->format('N')-1;
    $prevFin = clone $prevDebut;
    $prevDebut->modify("-" . $prevmonthdays . " day");
    $prevMonthRange = new DatePeriod($prevDebut, new DateInterval('P1D'), $prevFin);

    // periode pour trouver les premiers jours du mois prochain:
    $FirstDayOfFirstMonth = new DateTime($year . '-' . $monthNum . '-01');
    $FristDayOfNexMonth = $FirstDayOfFirstMonth->modify('next month');
    $endOfWeek = clone $FirstDayOfFirstMonth;
    $NumberOfDayWeek = $endOfWeek->format('N');
    $endOfWeek->modify('first sunday of this month + 1 day');
    $nextMonthRange = new DatePeriod($FristDayOfNexMonth, new DateInterval('P1D'), $endOfWeek);

    // on vient appeler le tableau instancié en amont à vide et on y place en clé du tableau qui parcours les mois d'une année
    $month[$monthNum] = [
        'name'=>$monthName,
        'prevmonthdays' =>$prevmonthdays
    ];
    echo '<pre class="text-left">';
    var_dump($NumberOfDayWeek);
    echo '</pre>';

    echo '<pre class="text-left">';
    var_dump($endOfWeek);
    echo '</pre>';

// on crée une boucle qui parcours le tableau periode debut -> fin d'un mois et sa clé $day permet de parcourir tous les jours contenus dans un mois. et cela x12 grace a la premiere boucle des mois d'une année
    foreach ($monthRange as $day) {
        $month[$monthNum]['days'][$day->format("Y-m-d")] = [
            'numInDay' => $day->format('w'),
            'dayNumber'=> $day,
            'fullDate' => $day,
            'prevmonthdays' => $prevmonthdays
        ];
    }

    foreach ($prevMonthRange as $day) {
        $month[$monthNum]['earlierDays'][$day->format("Y-m-d")] = [
            'numInDay' => $day->format('w'),
            'dayNumber'=> $day,
            'fullDate' => $day,
            'prevmonthdays' => $prevmonthdays
        ];
    }

    foreach ($nextMonthRange as $day) {
        $month[$monthNum]['nextDays'][$day->format("Y-m-d")] = [
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
    'monthsprev'=>$monthprev,
    'daysNames'=>$daysNames,
    'today'=>$today,
    'year'=>$year,
    'currentYear'=>$currentYear,
    'allowedYears'=> $allowedYears,
    'maxYear'=> $maxYear,
    'minYear'=> $minYear,
]);