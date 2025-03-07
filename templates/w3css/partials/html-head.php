<?php
namespace WorldlangDict;

$dtime = date("zGi", filemtime($config->templatePath.'css/default.css'));
$ctime = date("zGi", filemtime($config->templatePath.'css/'.$config->custom_id.'.css'));


?>
<head>
  <meta charset="utf-8">
  <title><?php echo $page->title; ?></title>
  <meta name="description" content="<?php echo $page->description; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="<?=$config->site_logo_url;?>">
  <link rel="icon" type="image/png" href="<?=$config->site_logo_url;?>">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/normalize.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/main.css">
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/default.css?<?= $dtime; ?>">
<? if ($config->custom_id != "default") : ?>
  <link rel="stylesheet" href="<?php echo $config->templateUri; ?>css/<?= $config->custom_id ?>.css?<?= $ctime; ?>">
<? endif; ?>
  <link href="https://fonts.googleapis.com/css?family=Literata|Merriweather&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fork-awesome@1.1.7/css/fork-awesome.min.css" integrity="sha256-gsmEoJAws/Kd3CjuOQzLie5Q3yshhvmo7YNtBG7aaEY=" crossorigin="anonymous">
  <script src="<?php echo $config->siteUri; ?>assets/ipa.js?02-08"></script>
  <script src="<?php echo $config->siteUri; ?>assets/browse.js?2023-12-18"></script>

</head>