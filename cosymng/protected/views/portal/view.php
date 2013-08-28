<?php
$this->breadcrumbs=array(
	'Portals'=>array('index'),
	$model->name,
);
?>

<h1>View Portal <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'connection_string',
		'user_bd',
		'password_bd',
		'id_state',
		'validity',
		'id_package',
	),
)); ?>

<br />

<?php
function read_backward_line($filename, $lines, $revers = false)
{
    $offset = -1;
    $c = '';
    $read = '';
    $i = 0;
    $fp = @fopen($filename, "r");
    while( $lines && fseek($fp, $offset, SEEK_END) >= 0 ) {
        $c = fgetc($fp);
        if($c == "\n" || $c == "\r"){
            $lines--;
            if( $revers ){
                $read[$i] = strrev($read[$i]);
                $i++;
            }
        }
        if( $revers ) $read[$i] .= $c;
        else $read .= $c;
        $offset--;
    }
    fclose ($fp);
    if( $revers ){
        if($read[$i] == "\n" || $read[$i] == "\r")
            array_pop($read);
        else $read[$i] = strrev($read[$i]);
        return implode('',$read);
    }
    return strrev(rtrim($read,"\n\r"));
}

$appName = strtolower(str_replace(' ', '', $model->name));


?>

<textarea cols="200" rows="10">
<?php 

$logFile = Yii::app()->basePath . '/../../' . $appName . '/protected/runtime/application.log';

if( file_exists($logFile) )
{
	echo read_backward_line($logFile, 100); 
}
else
{
	echo "Log file doesn't exists.";
}

?>
</textarea>