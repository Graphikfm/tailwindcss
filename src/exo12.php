<?php
//phpinfo(); die();
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);
// ton code ici

/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=calendar;host=localhost:3306';
$user = 'root';
$password = '';

$pdo = new \PDO('mysql:dbname=calendar;host=localhost:3306;charset=utf8', 'root', '');

$today = new DateTime('today');
//var_dump($today->format('Y-m-d'));
$currentYear = $today->format('Y');
$year = $_GET['year'] ?? $currentYear;
$minYear = $currentYear-5;
$maxYear = $currentYear+5;
$allowedYears = range($minYear,$maxYear);
if (strlen($year) !== 4 || !is_numeric($year)){
    throw new Exception('les conditions ne sont pas toutes réunies');
}
if ($year > $maxYear || $year < $minYear) {
    header('Location: /tailwindcss/src/exo12.php'); http://localhost/tailwindcss/src/exo12.php
}
$requestWeekNameOfYear = $pdo->prepare('
            SELECT MonthName
            FROM calendar.dim_date
            GROUP BY dim_date.MonthName
            ORDER BY dim_date.Month
    ');
$requestWeekNameOfYear->execute();
$monthsNames = [];
$f = $requestWeekNameOfYear->fetchAll(PDO::FETCH_ASSOC);
$arrayTest=[];
foreach ($f as $key ) {
    foreach ($key as $value) {
        $monthsNames[] = $value;
    }
}
//var_dump($monthsNames);

$month = [];
$monthprev = [];
//on crée une boucle foreach sur le [tableau: clé=>mois] des mois qui composent une année. et dans cette boucle on met en evidence la clé qui va parcourir les valeurs['mois'] de celui ci.
foreach ($monthsNames as $monthNum=>$monthName) {
    //pour chaque mois on defini un debut
    $monthNum = $monthNum+1;
    $debut = new DateTime($year . '-' . $monthNum . '-01');
    $prevmonthdays = $debut->format('N')-1; // egal à 1 du mois => jour de la semaine en format numerique
//    var_dump($prevmonthdays);
    // valeur finale de debut
    $debut->modify("-" . $prevmonthdays . " day"); // prends la base debut => premier jour du mois d'annee et fait une soustraction de celle ci avec le jour de la semaine
//    clone de debut pour le faire devenir la fin
    $fin = clone $debut;
    //pour chaque mois on defini une fin
    $fin->modify('+ 41 day');

    //à partir du debut et de la fin, on crée la periode definie pour chaque mois
    $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);




    $debut = $debut->format('y-m-d');
    $fin = $fin->format('y-m-d');

//var_dump($debut);
//var_dump($fin);



//var_dump($pdo);
//print_r($pdo);
//$stmt = $pdo->query('SELECT * FROM calendar ');

    // on vient appeler le tableau instancié en amont à vide et on y place en clé du tableau qui parcours les mois d'une année
    $month[$monthNum] = [
        'name'=>$monthName,
        'prevmonthdays' =>$prevmonthdays,
        'monthNum'=>$monthNum,
        'days' => [],
        'DaysName'=> [],


    ];

    $requestWeekNameOfYear = $pdo->prepare('
            SELECT MonthName
            FROM calendar.dim_date
            GROUP BY dim_date.MonthName
            ORDER BY dim_date.Month
    ');
    $requestWeekNameOfYear->execute();
    $month[$monthNum]['MonthName'] = $requestWeekNameOfYear->fetchAll(PDO::FETCH_ASSOC);

    $requestDaysNameOfWeek = $pdo->prepare('
            SELECT DayAbbrev
            FROM calendar.dim_date
            GROUP BY dim_date.DayAbbrev
            ORDER BY dim_date.DayOfWeek
    ');
    $requestDaysNameOfWeek->execute();
    $month[$monthNum]['DaysName'] = $requestDaysNameOfWeek->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('SELECT *,
       IF (calendar.dim_date.weekDayFlag = "n",1,0)
            AS is_weekend
            FROM calendar.dim_date
            WHERE dim_date.DateFull
            BETWEEN :debut
            AND :fin; '
        );
        $stmt->bindParam(':debut',$debut, PDO::PARAM_STR);
        $stmt->bindParam(':fin',$fin, PDO::PARAM_STR);
        $stmt->execute();
        $month[$monthNum]["days"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
//var_dump($month[$monthNum]);
}
// fin de ton code

// and somewhere later:

echo $twig->render('calendarDimDate.html.twig', [
    'months' =>$month,
    'monthsprev'=>$monthprev,
    'today'=>$today,
    'year'=>$year,
    'currentYear'=>$currentYear,
    'allowedYears'=> $allowedYears,
    'maxYear'=> $maxYear,
    'minYear'=> $minYear

]);


