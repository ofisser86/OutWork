<?php
	$this->addBreadcrumb(LANG_FREELANCERS_CONTROLLER, $this->href_to(''));
	if ($do == 'add') { $page_title = LANG_FREELANCERS_ADD;}
	if ($do == 'edit') { $page_title = LANG_FREELANCERS_EDIT;}
	$this->setPageTitle($page_title);	
	$this->addBreadcrumb($page_title);
?>
<h1><?php echo $page_title; ?></h1> 
<?php
	$this->renderForm($form, $frel, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors);