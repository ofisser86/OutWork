<?php

    $this->setPageTitle('Фрилансер', $profile['nickname']);

    $this->addBreadcrumb(LANG_USERS, href_to('users'));
    $this->addBreadcrumb($profile['nickname'], href_to('users', $profile['id']));
    $this->addBreadcrumb('Фрилансер');

?>

<?php if ($frel){?>
 <link type="text/css" href="/templates/default/controllers/freelancers/styles.css" rel="stylesheet">
<script src="/templates/default/controllers/freelancers/js/freelancers.js" type="text/javascript"></script>
<div>
<a href="/freelancers/item/<?php echo $frel['id']; ?>"><h2>Анкета</h2></a>
<?php if ($myprofile){ ?>(<a href="/freelancers/edit/<?php echo $frel['id']; ?>"> настроить анкету </a>)<?php } ?> 
		<div>
		<div class="fs-item">
               <div class="fl-item-info">
<c style="color:#999999; font-size: 14px;">Я оказываю услуги: </c>
			   
                      <span><?php echo $frel['cname']; ?> &rarr; <?php echo $frel['uname']; ?></span>
               </div>
		</div>
                        <div>
                        <?php if ($frel['hom'] == 'f'){ ?>   Работ в порфолио: <?php } ?>
						<?php if ($frel['hom'] == 'z'){ ?>Проектов: <?php }
						echo $frel['portfolio']; ?>
                        </div>
                        <div>
                            Раббота по договору:   <?php echo $frel['predoplata']; ?>
                        </div>
                        <div>
                            Организация:   <?php echo $frel['organisazia']; ?>
                        </div>
                        <div>
                            Отзывы/Притензии:  <a href="#" onclick="getotziv('<?php echo $frel['id']; ?>'); return false;">(<?php echo $frel['ot']; ?>/<?php echo $frel['pr']; ?>)</a>
                        </div>
<div>
<?php echo $frel['messag']; ?>
</div>

</div>
<?php } else if ($myprofile){ ?>
<a href="/freelancers/add">создать анкету</a>

<?php } ?>
