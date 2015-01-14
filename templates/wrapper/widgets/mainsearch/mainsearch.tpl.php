<?php $this->addMainCSS("templates/{$this->name}/css/my.css"); ?>
<?php $this->addMainJS("templates/{$this->name}/js/mainsearch.js"); ?>
<div class="mainsearch">
    <div id="textbanner"><h1>Как получить квалифицированную помощь?</h1></div>
    <section>
    <div class="button raised green">
        <div class="center" fit><?php echo LANG_WD_MAINSEARCH_FIND_SPESIALIST ?></div>
        <paper-ripple fit></paper-ripple>
    </div>
    <div class="button raised blue">
            <div class="center" fit><?php echo LANG_WD_MAINSEARCH_SEARCH?></div>
            <paper-ripple fit></paper-ripple>
    </div>
</section>
</div>