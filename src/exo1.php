<?php
//$toDay = new DateTime('today');
//
//echo $toDay->format('y-m-d') , PHP_EOL;
//
//$firstDayOfMonth = new DateTime('today');
//echo $firstDayOfMonth->format('y-m-d') , PHP_EOL;
//
//$firstDayOfMonth2 = $firstDayOfMonth->modify("last day of this month");
//$firstDayOfMonth1 = $firstDayOfMonth->modify("first day of this month");
//echo $firstDayOfMonth1->format('d'), PHP_EOL;
//echo $firstDayOfMonth2->format('d'), PHP_EOL;
//
//$firstDayOfMonth = new DateTime('last day of this month');
//echo $firstDayOfMonth->format('d') , PHP_EOL;
//
//$firstDayOfMonth = new DateTime('first day of this month');
//echo $firstDayOfMonth->format('d') , PHP_EOL;
//$a = new DateTime();
//$a->add(new DateInterval('P2D'));
//echo $a->format('y-m-d'), PHP_EOL;
//$b = new DateTime();
//$b->setDate('2024','02','04');
//echo $b->format('y-m-d') ,PHP_EOL;




//exo 1
//exo 1-a-> afficher la date du jour:
$date = new DateTime('2023');
echo $date->format('d/m/y') .PHP_EOL .PHP_EOL;

//exo 1-b -> afficher le 1° et le dernier jour du mois:
$firstDayOfMonth = (clone $date)->modify("first day of this month");
$lastDayOfMonth = (clone $date)->modify("last day of this month");
echo "Le premier jour du mois est le: ".$firstDayOfMonth->format('d/m/y').PHP_EOL;
echo nl2br("Le dernier jour du mois est le: ".$lastDayOfMonth->format('d/m/y')."\n\n");

//exo 1-c -> afficher le 1° et le dernier jour de cette année:
$firstDayOfYear = clone $date->modify("first day of january");
$lastDayOfYear = clone $date->modify("last day of december");
echo nl2br("Le premier jour de l'année est le: ".$firstDayOfYear->format('d/m/y')."\n\n");
echo nl2br("Le dernier jour de l'année est le: ".$lastDayOfYear->format('d/m/y')." \n");

//exo 1-d -> afficher le 1° et le dernier jour de cette semaine:
$firstDayOfThisWeek = clone $date->modify("monday this week");
$lastDayOfThisWeek = clone $date->modify("sunday this week");
echo nl2br("Le premier jour de la semaine en cours est le: ".$firstDayOfThisWeek->format('d/m/y')." \n");
echo nl2br("Le dernier jour de la semaine en cours  est le: ".$lastDayOfThisWeek->format('d/m/y')." \n");









