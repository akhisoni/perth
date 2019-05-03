<?php $objads=new Advertise();
$alladds=$objads->getAllAdvertiseFront(1); ?>
<ul>
<?php foreach($alladds as $dth): ?><li><a href="<?php echo $dth["urllink"]; ?>" target="_blank"><img src="<?php echo PUBLICPATH;?>advertise/<?php echo $dth["imagename"]; ?>" width="155" height="107" alt="<?php echo $dth["name"]; ?>" title="<?php echo $dth["name"]; ?>"></a></li><?php endforeach; ?>
</ul>