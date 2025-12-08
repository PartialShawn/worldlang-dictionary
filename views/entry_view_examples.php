<?php

use function WorldlangDict\array_first;

/**
  * Examples
  */


function display_example(array $example, string $lang) {
    
    if (empty($example) || empty($example['translations']))
        return;

    if (empty($example['cite']['text'])) {
        $citation = null;
    } elseif (isset($example['cite']['text'][$lang])) {
        $citation = $example['cite']['text'][$lang];
    } else {
        $citation = array_first($example['cite']['text']);
    }
    
    if (empty($example['cite']['link'])) {
        $link = null;
    } elseif (isset($example['cite']['link'][$lang])) {
        $link = $example['cite']['link'][$lang];
    } else {
        $link = array_first($example['cite']['link']);
    }
    if (isset($link) && empty($citation)) {
        $citation = $link;
    }
?>
        <blockquote>
            <p><?php
            foreach($example['translations'] as $segment) {
                if (empty($segment[$lang])) {
                    print($segment['text']);
                } else {
                    print("<span title=\"{$segment[$lang]}\" lang=\"".WL_CODE_FULL."\" tabindex=\"0\">{$segment['text']}</span>");
                }
            }
            ?></p>
            <?php if(isset($link)) : ?><cite>&mdash; <a href="<?= $link; ?>"><?= $citation; ?></a></cite>
            <?php elseif(isset($citation)) : ?><cite>&mdash; <?=$citation; ?></cite><? endif; ?>
        </blockquote>
<?php
}



if ($examples) :
?>
    <section class="examples">
    <details><summary>
        <h2><?=sprintf($config->getTrans('Example'), "")?></h2>
<?php
    if (count($examples) > 0) print('<span class="expand_icon">[+]</span><span class="collapse_icon">[-]</span>');
    for($i=0; $i<ENTRY_EXAMPLES_SHOW; $i++) :
        $example = array_shift($examples);
        if ($example === null) break;
        display_example($example, $config->lang);
    endfor;
?>
    </summary>
<?php
    for($i=ENTRY_EXAMPLES_SHOW; $i<ENTRY_EXAMPLES_MAX; $i++) :
        $example = array_shift($examples);
        if ($example === null) break;
        display_example($example, $config->lang);
    endfor;
?>
    </details>
    </section>
<?php
endif; /* file exists */