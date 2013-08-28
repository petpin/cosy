<?php
$this->breadcrumbs=array(
	'Daily'=>array('dailyReport'),
    'Month',
    'Year'=>array('year'),
    'Supplier Booking'=>array('supplierBooking'),
    'Supplier Clients'=>array('supplierClients'),
    'Supplier Money'=>array('supplierMoney'),
    'Supplier Rate'=>array('supplierRate'),
);

$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://www.google.com/jsapi');
$cs->registerCoreScript('jquery');
$cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
$cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
$cs->registerCssFile($baseUrl.'/css/jquery.css');

$this->pageTitle=Yii::app()->name; 

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

isset($_GET["year"]) ? $yearToSearch = $_GET["year"] : $yearToSearch = $year;
isset($_GET["month"]) ? $monthToSearch = $_GET["month"] : $monthToSearch = $month;

$months = array(array("01","January"), array("02","February"), array("03","March"), array("04","April"), 
                array("05","May"), array("06","June"), array("07","July"), array("08","August"), 
                array("09","September"), array("10","October"), array("11","Novemeber"), array("12","December"),
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
    ?>

    <div class="span-13 last">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array('title'=>'Sold Day'));
        
        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $monthToSearch, $yearToSearch);
        $day_num = 1;
        ?>
        <div class="chart3">
            <div>
                <div class="text">
                    <table class="myChart">
                        <thead>
                            <tr>
                                <th></th>
                                <?php 
                                while ( $day_num <= $days_in_month )
                                {
                                        echo '<th>' . $day_num . '</th>';
                                        $day_num++;
                                }

                                $day_num = 1;
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Sold Days</th>
                                <?php
                                //count up the days, untill we've done all of them in the month
                                while ( $day_num <= $days_in_month )
                                {		
                                        $criteria = new CDbCriteria;
                                        $criteria->condition='day = :day';
                                        $criteria->params=array(':day'=> $yearToSearch . '-' . $monthToSearch . '-' .$day_num);

                                        echo '<td>' . $this->getTotalCamasVendidas($criteria) . '</td>';
                                        $day_num++;
                                }

                                $day_num = 1;
                                ?>
                            </tr>
                            <tr>
                                <th>Day Occupancy Tax</th>
                                <?php
                                //count up the days, untill we've done all of them in the month
                                while ( $day_num <= $days_in_month )
                                {		
                                        $criteria = new CDbCriteria;
                                        $criteria->condition='day = :day';
                                        $criteria->params=array(':day'=> $yearToSearch . '-' . $monthToSearch . '-' .$day_num);

                                        echo '<td>' . $this->getTaxaOcupacao($criteria) . '</td>';
                                        $day_num++;
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php $this->endWidget();?>
    </div>

    <div class="flash-notice span-8 last" style="margin-left: 20px;">
        <p><?php echo $yearComboBoxContent; ?> <b>Year</b> <?php echo $monthComboBoxContent; ?> <b>Month</b> </p>
        <table class="table_report_data">
            <tr>			
                <td>Sold beds</td>
                <td><?php echo $this->getTotalCamasVendidas($criteria1); ?></td>
            </tr>
            <tr>
                <td>Value </td>
                <td><?php echo $this->getTotalFaturado($criteria1); ?> €</td>
            </tr>
            <tr>	
                <td>Value without rates</td>
                <td><?php echo $this->getTotalFaturadoSemRate($criteria1); ?> €</td>
            </tr>
            <tr>	
                <td>Average beds rate</td>
                <td><?php echo $this->getAverageBedRate($criteria1); ?> € / bed</td>
            </tr>
            <tr>		
                <td>Day occupancy tax</td>
                <td><?php echo $this->getBedOccupancyTaxMonth($criteria1, $monthToSearch, $yearToSearch); ?> %</td>
            </tr>
        </table>
    </div>
<?php
}
?>