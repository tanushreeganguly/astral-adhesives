<?php
$urlname=$_SERVER["REQUEST_URI"];
$page_name=explode("/",$urlname);
$total_link=count($page_name);
$id=$total_link-1;
$pg=$total_link-2;

if(($page_name[$id]=="tapes-42") && ($page_name[$pg]=="p")){

	header("location:".base_url."p/paper-pvc-adhesive-tapes-42");
}
if(($page_name[$id]=="tile-adhesives-grouts-and-repair-mortars-41") && ($page_name[$pg]=="p")){

	header("location:".base_url."p/tile-adhesive-41");
}

if(($page_name[$id]=="plumbing-36") && ($page_name[$pg]=="p")){

	header("location:".base_url."p/plumbing-pvc-cpvc-pipe-glue-36");
}
if(($page_name[$id]=="maintenance-33") && ($page_name[$pg]=="p")){

	header("location:".base_url."p/anaerobic-adhesive-33");
}
if(($page_name[$id]=="woodcare-28") && ($page_name[$pg]=="p")){

	header("location:".base_url."p/furniture-wood-care-glue-28");
}
?>