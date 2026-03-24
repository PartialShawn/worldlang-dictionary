<?php

declare(strict_types=1);

namespace WorldlangDict;

?>
<!doctype html>
<html class="no-js" lang="<?= $request->lang; ?>">
<? require_once($config->templatePath . "partials/html-head.php"); ?>
<body>


<? require_once($config->templatePath . "partials/page-header.php"); ?>

<main id="parse_report">

<h1><?= $config->getTrans('report import title') ?></h1>
<p><?= $config->getTrans('report import description') ?></p>

<ol>
<? foreach($data as $notice) { ?>
  <li><strong><?= $notice['term']; ?></strong>: <?= $notice['msg']; ?></li>
<? } ?>
</ul>


</main>

<? require_once($config->templatePath . "partials/page-footer.php"); ?>

</body>

</html>
