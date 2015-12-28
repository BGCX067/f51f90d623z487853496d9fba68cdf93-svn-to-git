<?php
$posicion_chd = $obj_indicators->getValorActualEntregado();
$min_chds = $obj_indicators->getValorMinimo();
$optimo_chds = $obj_indicators->getValorOptimo();

//armar la url
 $url = 'chart?chs=280x150&amp;cht=gom&amp;chd=t:'.$posicion_chd.'&amp;chds='.$min_chds.','.$optimo_chds.'&amp;chl=Valor%20Optenido%201&amp;chco=00ff00,ffff00,ff0000&amp;chxt=y&amp;chxl=0:|'.$min_chds.'|'.$optimo_chds.'"';

 ?>

<img class="alignnone" src="http://chart.apis.google.com/<?php echo $url ?>" alt="" width="225" height="125" />

