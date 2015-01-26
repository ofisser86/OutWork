<?php
    $config = cmsConfig::getInstance();
    $core = cmsCore::getInstance();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php $this->title(); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-text.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-layout.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-gui.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-widgets.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-content.css"); ?>
    <?php $this->addMainCSS("templates/{$this->name}/css/theme-modal.css"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/jquery.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/jquery-modal.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/core.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/modal.js"); ?>
    <?php $this->addMainJS("templates/{$this->name}/js/messages.js"); ?>
    <?php $this->addHead("<!--[if IE 7]><link rel='stylesheet' href='templates/{$this->name}/css/ie7.js'><![endif]-->"); ?>
	<?php $this->addHead("<!--[if lt IE 9]><script src='templates/{$this->name}/js/html5.js'></script><![endif]-->"); ?>
    <?php $this->head(); ?>
    <style><?php include('options.css.php'); ?></style>
</head>
<body>
	
	<div id="wrapper">
		<?php if (!$config->is_site_on){ ?>
            <div id="site_off_notice"><?php printf(ERR_SITE_OFFLINE_FULL, href_to('admin', 'settings', 'siteon')); ?></div>
        <?php } ?>
		
		<header id="header">
			<div class="header_top">
				<div class="limiter">
					<?php if($this->hasWidgetsOn('wide1')) { ?>
						<div class="wide">
							<?php $this->widgets('wide1'); ?>
						</div>
					<?php } ?>
					<div class="logo"><a href="<?php echo href_to_home(); ?>"></a></div>
					<?php if($this->hasWidgetsOn('header')) { ?>
						<div class="log">
							<?php $this->widgets('header', false, 'wrapper_plain'); ?>
						</div>
					<?php } ?>
				</div>
			</div>
			
			<?php if($this->hasWidgetsOn('wide2')) { ?>
				<div class="wide abovemenu limiter">
					<?php $this->widgets('wide2'); ?>
				</div>
			<?php } ?>
			
			<nav id="topmenu">
				<div class="limiter">
					<?php $this->widgets('topmenu', false, 'wrapper_plain'); ?>
				</div>
			</nav>

		</header>
		
		<main id="main" class="clear">
			<?php
                $messages = cmsUser::getSessionMessages();
                if ($messages){
                    ?>
                    <div class="sess_messages">
                        <?php
                            foreach($messages as $message){
                                echo $message;
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>
				
			<?php if($this->hasWidgetsOn('wide3')) { ?>
				<div class="wide top">
					<?php $this->widgets('wide3'); ?>
				</div>
			<?php } ?>
			
			<div class="col_wrapper clear">
				
				<div id="center"<?php if($this->hasWidgetsOn('right')) { ?> class="has_sidebar"<?php } ?>>

					<?php if ($this->isBreadcrumbs()){ ?>
						<div id="breadcrumbs">
							<?php $this->breadcrumbs(array('strip_last'=>false)); ?>
						</div>
					<?php } ?>

					<?php if($this->hasWidgetsOn('center_top')) { ?>
						<div class="widget_section">
							<?php $this->widgets('center_top'); ?>
						</div>
					<?php } ?>

					<?php if ($this->isBody()){ ?>
						<article>
							<?php $this->body(); ?>
						</article>
					<?php } ?>

					<?php if($this->hasWidgetsOn('center_middle_left', 'center_middle_right')) { ?>
						<div class="widget_section clear">

							<?php if($this->hasWidgetsOn('center_middle_left')) { ?>
								<div class="widget_left">
									<?php $this->widgets('center_middle_left'); ?>
								</div>
							<?php } ?>

							<?php if($this->hasWidgetsOn('center_middle_right')) { ?>
								<div class="widget_right">
									<?php $this->widgets('center_middle_right'); ?>
								</div>
							<?php } ?>

						</div>
					<?php } ?>

					<?php if($this->hasWidgetsOn('center_bottom')) { ?>
						<div class="widget_section">
							<?php $this->widgets('center_bottom'); ?>
						</div>
					<?php } ?>

				</div>

				<?php if($this->hasWidgetsOn('right')) { ?>
					<div id="right">
						<?php $this->widgets('right'); ?>
					</div>
				<?php } ?>
				
			</div>

			<?php if($this->hasWidgetsOn('wide4')) { ?>
				<div class="wide bottom clear">
					<?php $this->widgets('wide4'); ?>
				</div>
			<?php } ?>

		</main>
		
		<footer id="footer">
			<?php if($this->hasWidgetsOn('footer')) { ?>
				<div class="footer_top clear">
					<div class="limiter">
						<div class="clear">
							<?php $this->widgets('footer'); ?>
						</div>
						
						<?php if($this->hasWidgetsOn('wide5')) { ?>
							<div class="wide clear">
								<?php $this->widgets('wide5'); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<div class="footer_bottom">
				<div class="limiter">
					<div class="copyright">&copy; 2015 "OutWork"</div>
					
					<?php if ($config->debug && cmsUser::isAdmin()){ ?>
						<div id="sql_debug" style="display:none">
							<div id="sql_queries">
								<?php foreach($core->db->query_list as $sql) { ?>
									<div class="query">
										<div class="src"><?php echo $sql['src']; ?></div>
										<?php echo nl2br($sql['sql']); ?>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					
					<?php if ($config->debug && cmsUser::isAdmin()){ ?>
                        <span class="item">
                            SQL: <a href="#sql_debug" class="ajax-modal"><?php echo $core->db->query_count; ?></a>
                        </span>
                        <span class="item">
                            Cache: <?php echo cmsCache::getInstance()->query_count; ?></a>
                        </span>
                        <span class="item">
                            Mem: <?php echo round(memory_get_usage()/1024/1024, 2); ?> Mb
                        </span>
                    <?php } ?>
				</div>
			</div>
		</footer>
		
	</div>
<!--============================================Analitics===========================================-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53379234-1', 'auto');
  ga('send', 'pageview');

</script>
<!--================================================Metrika===============================================-->
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ua/stat/?id=25461983&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/25461983/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0; margin-left:-1100px;" alt="������.�������" title="������.�������: ��� �� �������  (���������, ����� �� ������� ���������)" onclick="try{Ya.Metrika.informer({i:this,id:25461983,lang:'ua'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25461983 = new Ya.Metrika({id:25461983,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25461983" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
