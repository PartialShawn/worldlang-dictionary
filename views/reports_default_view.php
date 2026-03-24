<?php

declare(strict_types=1);

namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="features">

<h1><?=$config->getTrans('report list title');?></h1>
<p><?=$config->getTrans('report list description');?></p>

<section>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'import', request:$request);?>"><?=$config->getTrans('report import title');?></a></h2>
        <p><?=$config->getTrans('report import description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'new-entries', request:$request);?>"><?=$config->getTrans('report new entries title');?></a></h2>
        <p><?=$config->getTrans('report new entries description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'updated-entries', request:$request);?>"><?=$config->getTrans('report updated entries title');?></a></h2>
        <p><?=$config->getTrans('report updated entries description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'removed-entries', request:$request);?>"><?=$config->getTrans('report removed entries title');?></a></h2>
        <p><?=$config->getTrans('report removed entries description');?></p>
    </div>
    <div>
        <h2><a href="<?=WorldlangDictUtils::makeUri(config:$config, controller:'report', arg:'all-entries', request:$request);?>"><?=$config->getTrans('report all entries title');?></a></h2>
        <p><?=$config->getTrans('report all entries description');?></p>
    </div>
</section>

</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
        
