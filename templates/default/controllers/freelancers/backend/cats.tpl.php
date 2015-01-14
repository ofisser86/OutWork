<?php

	$this->addBreadcrumb('Фрилансер', $this->href_to(''));

	 $page_title = 'Разделы'; 
	
	
	
	$this->setPageTitle($page_title);
		
	$this->addBreadcrumb($page_title);

?>
<?php
	$this->renderForm($form, $b, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors);
$this->renderForm($form2, $b, array(
		'action' => '',
		'method' => 'post',
		'toolbar' => false
	), $errors);	
	echo'<br><h1>'.LANG_FREELANCERS_CATS.'</h1> ';

	 if ($cats){

 foreach ($cats as $con) {

echo'<div>';

echo '<b style="font-size: 15px; ">'.$con['name'].'</b>' ;
echo'<a style="margin-left:10px" href="'.$this->href_to('deletcat', $con['id']).'">';
echo'<img src="/templates/default/images/icons/cancel.png"/>';
echo'</a>';

echo '</div>';
if($con['uslug']){
 foreach ($con['uslug'] as $co) {
echo'<div>';
echo '<c style="font-size: 15px; margin-left:15px;">'.$co['name'].'</c>' ;
echo'<a style="margin-left:10px" href="'.$this->href_to('deletus', $co['id']).'">';
echo'<img src="/templates/default/images/icons/cancel.png"/>';
echo'</a>';

echo '</div>';
}
}
}}
