<div class="widget<?php if ($widget['class']) { ?> <?php echo $widget['class'];  } ?>">

    <?php if ($widget['title'] && $is_titles){ ?>
        <div class="title">
            <span class="title_wrap"><?php echo $widget['title']; ?></span>
            <?php if (!empty($widget['links'])) { ?>
                <div class="links">
                    <?php $links = string_parse_list($widget['links']); ?>
                    <?php foreach($links as $link){ ?>
                        <a href="<?php echo (mb_strpos($link['value'], 'http://')===0) ? $link['value'] : href_to($link['value']); ?>"><?php echo $link['id']; ?></a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <div class="body<?php if ($widget['class']) { ?> <?php echo $widget['class'];  } ?>">
        <?php echo $widget['body']; ?>
    </div>

</div>
