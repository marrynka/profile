<div id="listedUsers">
<h3><?php echo $data['title'];?></h3>
<?php 

if(count($data['users']) > 1)
{
	
	echo $this->table->generate($data['users']);
	echo $this->pagination->create_links();
}
else
{
	echo "Nenašli sa žiadni užívatelia spĺňajúci zadané kritérium";
}
?>
</div>
