<?php
$today = new DateTime('today');
$currentYear = $today->format('Y');
$year = $_GET['year'] ?? $currentYear;
$minYear = $currentYear-5;
$maxYear = $currentYear+5;
$allowedYears = range($minYear,$maxYear);
///**
// * @throws Exception
// */
if (strlen($year) !== 4 || !is_numeric($year)){
    throw new Exception('les conditions ne sont pas toutes réunies');
}
if ($year > $maxYear || $year < $minYear) {
    header('Location: /src/exo9.php');
}
$daysNames = [
    0=>'Lun',
    1=>'Mar',
    2=>'Mer',
    3=>'Jeu',
    4=>'Ven',
    5=>'Sam',
    6=>'Dim'
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

<html>
<head>
    <link href="/dist/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body class=" body h-screen w-screen justify-center items-center  text-center">



<div class="global_container w-full h-full flex flex-col justify-center items-center  rounded-xl  bg-gray-200   justify-center relative  shadow-md  ">
    <div class=" w-full flex justify-center ">
        <div class="nav w-1/5 mb-5 flex mb-2 justify-between gap-1">
            <a href="/src/exo9.php?year=<?php echo $year-1 ?>"  class="container_btn_left bg-gray-900 cursor-pointer  w-12 h-8 rounded-l-lg flex   top-0 right-0 justify-center items-center text-white " <?php if ($year == $minYear) { ?>  cursor-not-allowed bg-zinc-300" href="" <?php } ?> >
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                </svg>
            </a>
            <div  class="dropdownContainer w-full cursor-pointer justify-center items-center   bg-red-500  relative flex  w-full">
                <div class=" select-none pointer-events-none  <?php if ($year == $currentYear){  ?>  text-red-500 <?php } ?> select-none text-xl text-white "><?php echo $year ?></div>
                <div id="dropDownList" class="dropDownList absolute hidden w-full shadow-gray-500 shadow-md rounded-r-md top-8  ">
                    <?php
                    foreach ($allowedYears as $yearInDropDown) { ?>
                        <a class=" listYear border border-gray-200 hover:border-red-500 hover:bg-red-500 hover:text-white  bg-white rounded-xs flex justify-center items-center <?php if($yearInDropDown == $currentYear ) { ?> text-red-500 <?php } ?> text-black" href="/src/exo9.php?year=<?php echo $yearInDropDown ?>"><?php echo $yearInDropDown ?></a>
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
            <a  class="container_btn_left bg-gray-900   w-12 h-8 rounded-r-lg flex   top-0 right-0 justify-center items-center text-white"  <?php if ($year == $maxYear) { ?>  cursor-not-allowed bg-zinc-300" href="" <?php } ?> href="/src/exo9.php?year=<?php echo $year+1 ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M13 18l6 -6"></path>
                    <path d="M13 6l6 6"></path>
                </svg>
            </a>
        </div>
    </div>
<!--    <div class="w-full flex justify-center">-->
        <div class=" grid grid-cols-4 gap-5">
            <?php
            foreach ($monthsNames as $monthNum=>$monthName) {
                $debut = new DateTime($year.'-'. $monthNum .'-01');
                $fin = clone $debut;
                $fin->modify('next month');
                $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);
                ?>
                <div class="">
<!--                     affichage valeur des clés du tableau des mois en francais-->
                    <div class="font-bold text-xl text-black"><?php echo $monthName ?></div>
                        <div class="grid  grid-cols-7 ">
<!--                            affichage valeurs des clés du tableau des jours en francais -->
                            <?php foreach ($daysNames as $daysNum => $dayName ) {
                             ?>
                            <div class=" text-md font-semibold days <?php if(in_array($dayName, ["Sam","Dim"])) { ?> font-bold text-slate-500 <?php } ?>"><?php echo $dayName ?></div>
                            <?php }  ?>
<!--                    init emplacement du premier du mois dans la premeire semaine (en num iso  de 1 a 7) de chaque mois  -->
                    <?php $prevmonthdays = $debut->format('N')-1;
                    ?>
<!--                        si c'est true-->
                        <?php if ($prevmonthdays) {?>
<!--                                la colspan est integrée sinon on sort et rien ne se passe-->
                            <div class=" col-span-<?= $prevmonthdays?>" >&nbsp</div>
                        <?php } ?>
<!--                        affichage des jours numeriques de chaques mois de l'année -->
                        <?php foreach ($monthRange as $dayNumber ) {
                            $dateOfDay = $dayNumber->format('j');
                            $numInDays = $dayNumber->format('w');
                        ?>
                            <div class="  <?php if(in_array($numInDays, [0,6])) { ?>   font-bold <?php } ?> <?php if( $today == $dayNumber ){ ?> bg-red-500 <?php } ?>" >
                                <?php echo $dateOfDay ?></div><?php  }?>
                            </div>
                    </div>
                <?php
            }  ?>
<!--        </div>-->
    </div>
</div>
</div>


<script src="/src/dropdown.js"></script>
</body>
</html>