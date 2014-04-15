<html>
<head>
	<title>pagination</title>
      <link rel="stylesheet" href="<?php echo base_url();?>css/style_pagination.css" type="text/css" media="screen" title="no title" charset="utf-8">

</head>
<body>

<div id="container">
<h1>pagination with CI</h1>
<?php 
echo $this->table->generate($records);
echo $this->pagination->create_links();
?>

</div>

</body>
</html>