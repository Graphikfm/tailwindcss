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
    $prevmonthdays = $debut->format('N')-1; // egal à 1 du mois => jour de la semaine en format numerique

    // valeur finale de debut
    $debut->modify("-" . $prevmonthdays . " day"); // prends la base debut => premier jour du mois d'annee et fait une soustraction de celle ci avec le jour de la semaine
//    clone de debut pour le faire devenir la fin
    $fin = clone $debut;
    //pour chaque mois on defini une fin
    $fin->modify('+ 42 day');

    //à partir du debut et de la fin, on crée la periode definie pour chaque mois
    $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);

    // on vient appeler le tableau instancié en amont à vide et on y place en clé du tableau qui parcours les mois d'une année
    $month[$monthNum] = [
        'name'=>$monthName,
        'prevmonthdays' =>$prevmonthdays,
        'monthNum'=>$monthNum
    ];

// on crée une boucle qui parcours le tableau periode debut -> fin d'un mois et sa clé $day permet de parcourir tous les jours contenus dans un mois. et cela x12 grace a la premiere boucle des mois d'une année
    foreach ($monthRange as $day) {
        $month[$monthNum]['days'][$day->format("Y-m-d")] = [
            'numInDay' => $day->format('w'),
            'MonthDays'=>$day->format('m'),
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