<?php namespace WorldlangDict; ?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>

<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main>


<h1><?= $config->getTrans('browse title') ?></h1>

<div class="filter">
    <header>
        <h2><?= $config->getTrans('browse filters header') ?></h2>
    </header>
    <section class="alphabet">
        <h3><?= $config->getTrans('browse filter by letter header') ?></h3>
        <div>
            <input type="radio" name="letter" id="letter-a" value="a">
            <label for="letter-a" class="">a</label>
            <input type="radio" name="letter" id="letter-b" value="b">
            <label for="letter-b" class="">b</label>
            <input type="radio" name="letter" id="letter-c" value="c">
            <label for="letter-c" class="">c</label>
            <input type="radio" name="letter" id="letter-d" value="d">
            <label for="letter-d" class="">d</label>
            <input type="radio" name="letter" id="letter-e" value="e">
            <label for="letter-e" class="">e</label>
            <input type="radio" name="letter" id="letter-f" value="f">
            <label for="letter-f" class="">f</label>
            <input type="radio" name="letter" id="letter-g" value="g">
            <label for="letter-g" class="">g</label>
            <input type="radio" name="letter" id="letter-h" value="h">
            <label for="letter-h" class="">h</label>
            <input type="radio" name="letter" id="letter-i" value="i">
            <label for="letter-i" class="">i</label>
            <input type="radio" name="letter" id="letter-j" value="j">
            <label for="letter-j" class="">j</label>
            <input type="radio" name="letter" id="letter-k" value="k">
            <label for="letter-k" class="">k</label>
            <input type="radio" name="letter" id="letter-l" value="l">
            <label for="letter-l" class="">l</label>
            <input type="radio" name="letter" id="letter-m" value="m">
            <label for="letter-m" class="">m</label>
            <input type="radio" name="letter" id="letter-n" value="n">
            <label for="letter-n" class="">n</label>
            <input type="radio" name="letter" id="letter-o" value="o">
            <label for="letter-o" class="">o</label>
            <input type="radio" name="letter" id="letter-p" value="p">
            <label for="letter-p" class="">p</label>
            <input type="radio" name="letter" id="letter-r" value="r">
            <label for="letter-r" class="">r</label>
            <input type="radio" name="letter" id="letter-s" value="s">
            <label for="letter-s" class="">s</label>
            <input type="radio" name="letter" id="letter-t" value="t">
            <label for="letter-t" class="">t</label>
            <input type="radio" name="letter" id="letter-u" value="u">
            <label for="letter-u" class="">u</label>
            <input type="radio" name="letter" id="letter-v" value="v">
            <label for="letter-v" class="">v</label>
            <input type="radio" name="letter" id="letter-w" value="w">
            <label for="letter-w" class="">w</label>
            <input type="radio" name="letter" id="letter-x" value="x">
            <label for="letter-x" class="">x</label>
            <input type="radio" name="letter" id="letter-y" value="y">
            <label for="letter-y" class="">y</label>
            <input type="radio" name="letter" id="letter-z" value="z">
            <label for="letter-z" class="">z</label>
            <input type="radio" name="letter" id="letter-all" value="all">
            <label for="letter-all" class="filter-all" id="letter-all-label"><?= $config->getTrans('letter all') ?></label>
        </div>
    </section>

    <section class="categories">
        <h3 class=""><?= $config->getTrans('browse filter by category header') ?></h3>
        <div>
            <input id="cat-affix" type="radio" name="category" value="affix">
            <label for="cat-affix" class=""><?= $config->getTrans('affix') ?></label>
            <input id="cat-root" type="radio" name="category" value="root">
            <label for="cat-root" class=""><?= $config->getTrans('root') ?></label>
            <input id="cat-bound-root" type="radio" name="category" value="bound root">
            <label for="cat-bound-root" class=""><?= $config->getTrans('bound root') ?></label>
            <input id="cat-proper-noun" type="radio" name="category" value="proper word">
            <label for="cat-proper-noun" class=""><?= $config->getTrans('proper noun') ?></label>
            <input id="cat-derived" type="radio" name="category" value="derived">
            <label for="cat-derived" class=""><?= $config->getTrans('derived word') ?></label>
            <input id="cat-phrase" type="radio" name="category" value="phrase">
            <label for="cat-phrase" class=""><?= $config->getTrans('phrase') ?></label>
            <input id="cat-all" type="radio" name="category" value="all">
            <label for="cat-all" class="filter-all"><?= $config->getTrans('category all') ?></label>
        </div>
    </section>
</div>



<dl class="dictionaryList browse">

<?php foreach ($dict as $term=>$data) :
        $letter = ctype_alpha($term[0]) ? $term[0] : $term[1];
        $attributes = " data-class=\"{$data['class']}\" data-category=\"{$data['category']}\" data-char=\"{$letter}\" ";
?>
    <div>
        <dt <?=$attributes;?>><?=
            WorldlangDictUtils::makeLink(text:$data['term'],
                config:$config, request:$request,
                controller:'word', arg:urlencode($term),
            );?>
        </dt>
        <dd <?=$attributes;?>>
<? if (isset($data['class']) && !empty($data['class'])) : ?>
            <span class="wordClass">(<a href="<?=$config->grammar_url;?>"><?=$data['class'];?></a>)</span>
<? endif; ?>
            <?=$data['translation']?>
        </dd>
    </div>
<? endforeach; ?>

</dl>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>