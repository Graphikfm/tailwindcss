<html>
    <head>
        <link href="/dist/output.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <?php
//        $year = 2023;
        $year = $_GET['year'];
//        var_dump(new \DateTime($year . '-01-01'));
//        var_dump(new \DateTime('first day of january 2024'));
    $begin = new DateTime('first day of january ' . $year);
//        if ($year) {
//            $begin = new DateTime($year.'-01-01');
//        } else {
//            $begin = new DateTime('first day of january');
//        }

        $end = clone $begin;
        $end->modify('next year ');

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval, $end);
        $today = new DateTime('today');
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
        foreach ($daterange as $date) {
            $day = $daysName[$date->format('w')];
            $month = $monthName[$date->format('n')];
            $dateOfDay = $date->format('d');
            $y = $date->format('Y');
            if (in_array($date->format("l"), ["Saturday", "Sunday"],true)){
                echo '<div class="font-bold text-gray-400">'.$day.' '.$dateOfDay.' '.$month.' '.$y.'</div>';
            } else if ($today->format('w l d F Y') === $date->format('w l d F Y')) {
                echo '<div class="font-bold text-red-500">'.$day.' '.$dateOfDay.' '.$month.' '.$y.'</div>';
            } else {
                echo '<div class="font-bold text-green-800">'.$day.' '.$dateOfDay.' '.$month.' '.$y.'</div>';
            }
        }

            ?>
    </body>
</html>



