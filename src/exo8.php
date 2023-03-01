<html>
<head>
    <link href="/dist/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body class=" body flex justify-center items-center h-screen w-screen text-center font-bold" getClickPosition(e)>


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
    header('Location: /src/exo8.php?year='.$year);
}
$year = (int) $_GET['year'];
$begin = new DateTime('first day of january ' . $year);
$end = clone $begin;
$end->modify('next year ');
$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
$today = new DateTime('today');
$currentYear = $today->format('Y');
if (($year > $currentYear+5) || ($year < $currentYear-5)) {
    header('Location: /src/exo8.php?year='.$currentYear);
}
$daysNames = [
    0=>'Dimanche',
    1=>'Lundi',
    2=>'Mardi',
    3=>'Mercredi',
    4=>'Jeudi',
    5=>'Vendredi',
    6=>'Samedi'
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

?>
<div class="global_container rounded-xl w-1/3 h-3/5 bg-gray-200 flex flex-col m-7 justify-center relative  shadow-md  p-7">
    <div class="nav w-full flex mb-2 justify-between gap-1">
            <a class="container_btn_left text-white justify-center items-center items-center w-12 <?php if ($year === ($currentYear-5)) { ?> cursor-not-allowed bg-zinc-300 <?php } ?>  bg-gray-900 w-8 h-8 rounded-l-lg  top-0 left-0 flex" href="/src/exo8.php?year=<?php echo $year-1 ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                </svg>
            </a>
        <div  class="dropdownContainer justify-center items-center   bg-green-400  relative flex  w-full">

            <?php
                $allowedYears = range($currentYear-5,$currentYear+5);
            ?>
            <div class="  <?php if (($year == $currentYear)|| !$year){ $year = (int) (new DateTime())->format('Y'); ?>  text-red-500 <?php } ?> text-xl text-white"><?php echo $year; ?></div>
            <div id="dropDownList" class="dropDownList absolute hidden w-full shadow-gray-500 shadow-md rounded-r-md top-8  ">
                <?php
                foreach ($allowedYears as $yearInDropDown) { ?>
                    <a class=" listYear border border-gray-200 hover:border-green-500 hover:bg-green-500 hover:text-white  bg-white rounded-xs flex justify-center items-center <?php if($yearInDropDown == $currentYear ) { ?> text-red-500 <?php } ?> text-black" href="/src/exo8.php?year=<?php echo $yearInDropDown ?>"><?php echo $yearInDropDown ?></a>
                <?php
                } ?>
            </div>
            <div class=" arrowDownRight  w-6 rounded-lg text-white flex items-center absolute right-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 9l6 6l6 -6"></path>
                </svg>
            </div>
        </div>
        <a class="container_btn_left bg-gray-900  <?php if ($year === ($currentYear+5)) { ?> cursor-not-allowed bg-zinc-300  <?php } ?> w-12 h-8 rounded-r-lg flex   top-0 right-0 justify-center items-center text-white " href="/src/exo8.php?year=<?php echo $year+1 ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M13 18l6 -6"></path>
                <path d="M13 6l6 6"></path>
            </svg>
        </a>
    </div>
    <div class="day_list overflow-auto bg-green-100 flex  flex-col text-center shadow-inner-lg shadow-green-900 back-shadow-xl shadow-inner shadow-green">
        <?php
        foreach ($daterange as $date) {
            $dayKeys = (int)$daysNames[$date->format('w')];
            $day = $daysNames[$date->format('w')];
             $intIndateArray = (int)$date->format('w');
            $month = $monthsNames[$date->format('n')];
            $dateOfDay = $date->format('d');
            echo $dateOfDay;
            $y = $date->format('Y');
            echo $date->format('d');
 ?>
                <div class="td font-bold <?php if ($today == $date) { ?> text-red-500 <?php }  if (!in_array($intIndateArray, [0,1])){ ?> text-green-800 <?php } ?> text-gray-400 border-gray-200 border"><?php echo $day.' '.$dateOfDay.' '.$month.' '.' '.$y ?></div>
        <?php } ?>
    </div>
</div>
</div>
<script src="/src/dropdown.js"></script>
</body>
</html>