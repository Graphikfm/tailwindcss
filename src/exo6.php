<html>
<head>
    <link href="/dist/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body class="flex justify-center items-center h-screen w-screen text-center font-bold">


<?php
$year = $_GET['year'];
/**
 * @throws Exception
 */
if (strlen($year) !== 4 && !is_numeric($year) && $year !==null ){
    throw new Exception('les conditions ne sont pas toutes réunies');
}
if ($year === null) {
    $year = (int) (new DateTime())->format('Y');
    header('Location: /src/exo6.php?year='.$year);
}

$year = (int) $_GET['year'];
$add = $year+1;
$sub = $year-1;
$begin = new DateTime('first day of january ' . $year);
$end = clone $begin;
$end->modify('next year ');
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval, $end);
$today = new DateTime('today');

$dateFixe = $today->format('Y');
var_dump($year+5);
if (($year > $dateFixe+5) || ($year < $dateFixe-5)) {
    header('Location: /src/exo6.php?year='.$dateFixe);
}
$daysName = [
    0=>'Dimanche',
    1=>'Lundi',
    2=>'Mardi',
    3=>'Mercredi',
    4=>'Jeudi',
    5=>'Vendredi',
    6=>'Samedi'
];
$monthName = [
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

$date = new DateTime();
$date = $date->format('Y');
$yearDate = $today->format('Y');
?>
<div class="global_container rounded-xl w-1/3 h-3/5 bg-gray-200 flex m-7 justify-between relative shadow-md  p-7">
    <?php
    if (($year == $date)|| !$year){
        $year = (int) (new DateTime())->format('Y');
//     var_dump($year);
//     var_dump($date);
        ?>
        <div class="absolute top-0 right-50 text-red-500"><?php echo $year; ?></div>
        <?php
    } else { ?>
        <div class="absolute top-0 right-50 text-green-800"><?php echo $year ?></div>
    <?php } ?>
    <div class="h-full flex items-center justify-center flex-col ">
        <?php if ($sub == $date) { ?>
            <div class="td font-bold text-red-500"><?php echo $sub ?></div>
        <?php } else { ?>
            <div class="td font-bold text-green-800" ><?php echo $sub ?></div >
        <?php } ?>
        <a class="  container_btn_left shadow-black shadow-md bg-gray-900 w-16 h-16 rounded-lg flex justify-center items-center text-white" href="/src/exo6.php?year=<?php echo $sub ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
        </a>
    </div>
    <div class="day_list overflow-auto bg-green-100 flex  flex-col text-center inner-shadow-xl back-shadow-xl shadow-inner shadow-green">
        <?php
        foreach ($daterange as $date) {
            $day = $daysName[$date->format('w')];
            $month = $monthName[$date->format('n')];
            $dateOfDay = $date->format('d');
            $y = $date->format('Y');

            if ($today->format('w l d F Y') === $date->format('w l d F Y')) { ?>
                <div class="td font-bold text-red-500 border-gray-200 border"><?php echo $day.' '.$dateOfDay.' '.$month.' '.' '.$y ?></div>
            <?php } else if (!in_array($date->format("l"), ["Saturday", "Sunday"])){ ?>
                <div class="td font-bold text-green-800 border-gray-200 border"><?php echo $day.' '.$dateOfDay.' '.$month.' '.' '.$y ?></div>
            <?php } else { ?>
                <div class="td font-bold text-gray-400 border-gray-200 border"><?php echo $day.' '.$dateOfDay.' '.$month.' '.' '.$y ?></div>
            <?php }
        } ?>
    </div>
    <?php
    $date = new DateTime();
    $date = $date->format('Y');
    ?>
    <div class="h-full flex justify-center  flex-col">
        <?php
        if ($add == $date) { ?>
            <div class="td font-bold text-red-500"><?php echo $add ?></div>
        <?php } else { ?>
            <div class="td font-bold text-green-800"><?php echo $add ?></div>
        <?php } ?>
        <a class=" container_btn_right shadow-black shadow-md bg-gray-900 w-16 h-16 rounded-lg flex justify-center items-center text-white" href="/src/exo6.php?year=<?php echo $add ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M13 18l6 -6"></path>
                <path d="M13 6l6 6"></path>
            </svg>
        </a>
    </div>
</div>

</div>
<!--<a href="/src/exo4.php?year=--><?php //echo $add ?><!--">ICI</a>-->
<!--<a href="/src/exo4.php?year=--><?php //echo $sub ?><!--">ICI</a>-->




</body>
</html>