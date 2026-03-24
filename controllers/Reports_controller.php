<?php

declare(strict_types=1);

namespace WorldlangDict;

class Reports_controller
{
    public static function run(WorldlangDictConfig $config, Request $request, Page $page)
    {
        $arg = isset($request->arguments[0]) ? $request->arguments[0] : '';

        switch($arg) {
            case 'import':
                $page->setTitle($config->getTrans('report import title'));
                $page->description = $config->getTrans('report import description');
                $data = yaml_parse_file($config->api2Path.'reports/import_report.yaml');
                require_once('views/reports_import_view.php');
                break;
            case 'all-entries':
                require_once('models/Changelog.php');
                $data = Changelog::recent_changes($config);
                $defs = yaml_parse_file($config->basic_location . "{$config->lang}.yaml");
                $title = $config->getTrans('report all entries title');
                $description = $config->getTrans('report all entries description');
                $page->setTitle($title);
                $page->description = $description;
                require_once('views/reports_changelog_type_view.php');
                break;
            case 'new-entries':
                require_once('models/Changelog.php');
                $data = Changelog::new_terms($config);
                $defs = yaml_parse_file($config->basic_location . "{$config->lang}.yaml");
                $title = $config->getTrans('report new entries title');
                $description = $config->getTrans('report new entries description');
                $page->setTitle($title);
                $page->description = $description;
                require_once('views/reports_changelog_type_view.php');
                break;
            case 'removed-entries':
                require_once('models/Changelog.php');
                $data = Changelog::removed_terms($config);
                $title = $config->getTrans('report removed entries title');
                $description = $config->getTrans('report removed entries description');
                $page->setTitle($title);
                $page->description = $description;
                require_once('views/reports_changelog_type_view.php');
                break;
            case 'updated-entries':
                require_once('models/Changelog.php');
                $data = Changelog::updated_entries($config);
                $defs = yaml_parse_file($config->basic_location . "{$config->lang}.yaml");
                $title = $config->getTrans('report updated entries title');
                $description = $config->getTrans('report updated entries description');
                $page->setTitle($title);
                $page->description = $description;
                require_once('views/reports_changelog_type_view.php');
                break;
            case '':
                $page->setTitle($config->getTrans('report list title'));
                $page->description = $config->getTrans('report list description');
                require_once('views/reports_default_view.php');
                break;
            default:
                throw new Error_404_exception("Reports module not found.");
                break;
        }
    }
}
