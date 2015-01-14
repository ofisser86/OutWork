<?php

	$this->addBreadcrumb(LANG_FREELANCERS_CONTROLLER, $this->href_to(''));
	$this->addBreadcrumb(LANG_FREELANCERS_ADDPROECT);
	
	$this->setPageTitle(LANG_FREELANCERS_ADDPROECT);

?>

<h1><?php echo LANG_FREELANCERS_ADDPROECT; ?></h1> 

<?php
	$this->renderForm($form, $proekt, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors);