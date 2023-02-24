<html>
<head>
    <link href="/dist/output.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body class=" body h-screen w-screen justify-center items-center  text-center" getClickPosition(e)>


<?php
$year = $_GET['year'];
///**
// * @throws Exception
// */
if (strlen($year) !== 4 && !is_numeric($year) && $year !==null ){
    throw new Exception('les conditions ne sont pas toutes réunies');
}
if ($year === null) {
    $year = (int) (new DateTime())->format('Y');
    header('Location: /src/exo9.php?year='.$year);
}
$year = (int) $_GET['year'];
$today = new DateTime('today');
$currentYear = $today->format('Y');
if (($year > $currentYear+5) || ($year < $currentYear-5)) {
    header('Location: /src/exo9.php?year='.$currentYear);
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
<div class="global_container w-full h-full flex flex-col justify-center items-center  rounded-xl  bg-gray-200   justify-center relative  shadow-md  ">
    <div class=" ">
        <div class="nav w-1/2 flex mb-2 justify-between gap-1">
            <a class="container_btn_left bg-gray-900  <?php if ($year === ($currentYear-5)) { ?> cursor-not-allowed bg-zinc-300  <?php } ?> w-12 h-8 rounded-l-lg flex   top-0 right-0 justify-center items-center text-white " <?php if ($year === ($currentYear-5)) { ?> href="" <?php } ?> href="/src/exo9.php?year=<?php echo $year-1 ?> ">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M5 12l14 0"></path>
                    <path d="M5 12l6 6"></path>
                    <path d="M5 12l6 -6"></path>
                </svg>
            </a>
            <div  class="dropdownContainer cursor-pointer justify-center items-center   bg-red-500  relative flex  w-full">

                <?php
                $allowedYears = range($currentYear-5,$currentYear+5);
                ?>
                <div class=" cursor-pointer <?php if (($year == $currentYear)|| !$year){ $year = (int) (new DateTime())->format('Y'); ?>  text-red-500 <?php } ?> text-xl text-white "><?php echo $year; ?></div>
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
            <a class="container_btn_left bg-gray-900  <?php if ($year === ($currentYear+5)) { ?> cursor-not-allowed bg-zinc-300  <?php } ?> w-12 h-8 rounded-r-lg flex   top-0 right-0 justify-center items-center text-white " <?php if ($year === ($currentYear+5)) { ?> href="" <?php } ?> href="/src/exo9.php?year=<?php echo $year+1 ?> ">
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
        <div class="  grid grid-rows-3 grid-cols-4 gap-5">
            <?php
            foreach ($monthsNames as $monthNum=>$month) {
                $debut = new DateTime($year.'-'. $monthNum .'-01');
                $fin = clone $debut;
                $fin->modify('next month');
                $monthRange = new DatePeriod($debut, new DateInterval('P1D'), $fin);
                ?>
                <div class="">
<!--                     affichage valeur des clés du tableau des mois en francais-->
                    <div class="font-bold"><?php echo $month ?></div>
                        <div class="grid grid-rows-2 grid-cols-7 ">
<!--                            affichage valeurs des clés du tableau des jours en francais -->
                            <?php foreach ($daysNames as $daysNum => $day ) {
                             ?>
                            <div class=" text-xs days <?php if(in_array($day, ["Sam","Dim"])) { ?> font-bold text-slate-500 <?php } ?>"><?php echo $day ?></div>
                            <?php }  ?>
                        </div>
<!--                    init emplacement du premier du mois dans la premeire semaine (en num iso  de 1 a 7) de chaque mois  -->
                    <?php $col = $debut->format('N')-1;
                    ?>
                    <div class="grid grid-rows-5 grid-cols-7 ">
<!--                        si c'est true-->
                        <?php if ($col) {?>
<!--                                la colspan est integrée sinon on sort et rien ne se passe-->
                            <div class=" col-span-<?= $col?>" >&nbsp</div>
                        <?php } ?>
<!--                        affichage des jours numeriques de chaques mois de l'année -->
                        <?php foreach ($monthRange as $dayNumber ) {
                            $dateOfDay = $dayNumber->format('j');
                            $numDaysArray = $dayNumber->format('w');
                        ?>
                            <div class="  <?php if(in_array($numDaysArray, [0,6])) { ?>   font-bold <?php }  if(($today->format('y-m-d')) === ($dayNumber->format('y-m-d'))){ ?> bg-red-500 <?php } ?>" >
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