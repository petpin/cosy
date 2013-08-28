<?php $this->pageTitle=Yii::app()->name; 

    Yii::app()->clientScript->registerCoreScript('jquery'); 

    $ourscript = 'function redirect() {
            parent.location = \'index.php?r=report/month&month=\' + $(\'#month\').val() + \'&year=\' + $(\'#year\').val();
    }';

    Yii::app()->clientScript->registerScript('releaseRedirect',$ourscript,CClientScript::POS_HEAD);

    //This gets today's date
    $date = time() ;

    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);

    if(!isset($_GET["year"]))
            $yearToSearch = $year;
    else
            $yearToSearch = $_GET["year"];

    if(!isset($_GET["month"]))
            $monthToSearch = $month;
    else
            $monthToSearch = $_GET["month"];



    $months = array(array("01","January"), 
                                    array("02","February"), 
                                    array("03","March"), 
                                    array("04","April"), 
                                    array("05","May"), 
                                    array("06","June"), 
                                    array("07","July"), 
                                    array("08","August"), 
                                    array("09","September"), 
                                    array("10","October"), 
                                    array("11","Novemeber"), 
                                    array("12","December"),
                            );

    /*
    * 	Francisco Fernandes 2012	
    *
    *	Codigo responsavel pela população da combo de anos, o codigo vai preenchendo a combo consuante o ano do presente
    *
    */


            $yearComboBoxContent = '<select id="year" onchange="javascript:redirect()">';
            for ($yearFor=$yearToSearch-2; $yearFor <= $year; $yearFor++)
            {

                    $yearComboBoxContent .= '<option value="' . $yearFor . '"';

                    if($yearFor == $yearToSearch)
                            $yearComboBoxContent .= " selected='selected' "; 

                    $yearComboBoxContent .= '>' . $yearFor . '</option>';
            }
            $yearComboBoxContent .= '</select>';


/*
    * 	Francisco Fernandes 2012	
    *
    *	Codigo responsavel pela população da combo de meses, caso seja o Ano actual apenas mete meses até ao mês actual
    *	caso seja um ano anterior mete todos os meses do ano
    *
    */

                    $monthComboBoxContent = '<select id="month" onchange="javascript:redirect()">';
                    foreach ($months as $monthname)
                    {
                            if($yearToSearch < $year)
                            {

                                    $monthComboBoxContent .=  '<option value="' . $monthname[0] . '"';

                                    if($monthname[0] == $monthToSearch)
                                            $monthComboBoxContent .=  " selected='selected' ";

                                    $monthComboBoxContent .=  '>' . $monthname[1] . '</option>';
                            }
                            else
                            {
                                    if($monthname[0] <= $month)
                                    {
                                            $monthComboBoxContent .=  '<option value="' . $monthname[0] . '"';

                                            if($monthname[0] == $monthToSearch)
                                                    $monthComboBoxContent .=  " selected='selected' ";

                                            $monthComboBoxContent .=  '>' . $monthname[1] . '</option>';

                                    }	
                            }
                    }
                    $monthComboBoxContent .=  '</select>';

?>


<div style="padding: 20px;">

    <p><?php echo $yearComboBoxContent; ?> <b>Year</b> <?php echo $monthComboBoxContent; ?> <b>Month</b> </p>
    <?php
    if(!Yii::app()->user->isGuest)
    {

            if($yearToSearch==$year && $monthToSearch==$month)
            {
                    $criteria1 = new CDbCriteria;
                    $criteria1->condition='day>=:day_start AND day<:day_end';
                    $criteria1->params=array(':day_start'=> $yearToSearch . '-' . $monthToSearch . '-01',
                                                            ':day_end'=> $yearToSearch . '-' . ($monthToSearch) . '-'.$day.'');

            }
            else
            {
                    $criteria1 = new CDbCriteria;
                    $criteria1->condition='day>=:day_start AND day<:day_end';
                    $criteria1->params=array(':day_start'=> $yearToSearch . '-' . $monthToSearch . '-01',
                                                            ':day_end'=> $yearToSearch . '-' . ($monthToSearch+1) . '-01');
            }	

            echo '<table class="table_report_data">';
                            echo '<tr>';			
                                    echo '<td>Sold Beds</td>';
                                    echo '<td>'.$this->getTotalCamasVendidas($criteria1) .'</td>';
                            echo '</tr>';
                            echo '<tr>';			
                                    echo '<td>Value </td>';
                                    echo '<td>'.$this->getTotalFaturado($criteria1) .' €</td>';
                            echo '</tr>';
                            echo '<tr>';			
                                    echo '<td>Value without rates</td>';
                                    echo '<td>'.$this->getTotalFaturadoSemRate($criteria1) .' €</td>';
                            echo '</tr>';
                            echo '<tr>';			
                                    echo '<td>Average Bed Rate</td>';
                                    echo '<td>'.$this->getAverageBedRate($criteria1) .' € / bed</td>';
                            echo '</tr>';
                            echo '<tr>';			
                                    echo '<td>Bed Occupancy Tax</td>';
                                    echo '<td>'.$this->getBedOccupancyTaxMonth($criteria1, $monthToSearch, $yearToSearch) .' %</td>';
                            echo '</tr>';
            echo "</table>";
    }
    ?>

</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Days');
    data.addColumn('number', 'Sold Beds');
    data.addColumn('number', 'Taxa de Ocupação');
    //data.addColumn('number', 'Total Faturado');
    data.addRows([
            <?php
            //We then determine how many days are in the current month
            $days_in_month = cal_days_in_month(0, $monthToSearch, $yearToSearch);

            $day_num = 1;

            //count up the days, untill we've done all of them in the month
            while ( $day_num <= $days_in_month )
            {		
                    $criteria = new CDbCriteria;
                    $criteria->condition='day = :day';
                    $criteria->params=array(':day'=> $yearToSearch . '-' . $monthToSearch . '-' .$day_num);

                    //print_r($criteria);
                    echo "['$day_num', ";
                    echo $this->getTotalCamasVendidas($criteria);
                    echo ", " . $this->getTaxaOcupacao($criteria);
                    //echo ", " . echo $this->getTotalFaturado($criteria);
                    echo "], ";
                    $day_num++;
            }
    ?>	 
    ]);

    var options = {
        title: 'Month',
        hAxis: {title: 'Month View',titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div')).draw(data, {lineType: "function",
                width: 1000, height: 400,
                vAxis: {maxValue: 10}}
        );;
    chart.draw(data, options);
  }
</script>
<div id="chart_div" style="width: 900px; height: 500px;"></div>