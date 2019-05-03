<?php $objads=new Advertise();
$alladds=$objads->getAllAdvertiseFront(3,4); ?>
<div class="bottombanner">
<ul>
<?php foreach($alladds as $dth): ?><li><div class="title"><a href="<?php echo $dth["urllink"]; ?>" target="_blank"><img src="<?php echo PUBLICPATH;?>advertise/<?php echo $dth["imagename"]; ?>" width="125"  alt="<?php echo $dth["name"]; ?>" title="<?php echo $dth["name"]; ?>"></a></div></li><?php endforeach; ?>
</ul>
</div>