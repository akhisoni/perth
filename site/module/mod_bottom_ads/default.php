<?php $objads=new Advertise();
$alladds=$objads->getAllAdvertiseFront(2); ?>
<div id="add_container">
<article><?php foreach($alladds as $dth): ?><a href="<?php echo $dth["urllink"]; ?>" target="_blank"><img src="<?php echo PUBLICPATH;?>advertise/<?php echo $dth["imagename"]; ?>" width="165" height="107" alt="<?php echo $dth["name"]; ?>" title="<?php echo $dth["name"]; ?>"></a><?php endforeach; ?></article>
</div>