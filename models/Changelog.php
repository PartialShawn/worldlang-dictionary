<?php

declare(strict_types=1);

namespace WorldlangDict;

class Changelog {
    
    public static function new_terms(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        return $db->query("
                SELECT `term`, `message`, `timestamp` FROM {$config->db_prefix}term_log
                WHERE `type`='term added'
                ORDER BY `timestamp` DESC LIMIT 300;
            ")->fetchAll();
    }

    public static function recent_changes(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        return $db->query("
                SELECT * FROM {$config->db_prefix}term_log
                ORDER BY `timestamp` DESC LIMIT 300;"
            )->fetchAll();
    }
    
    public static function removed_terms(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        return $db->query("
                SELECT `term`, `timestamp`, `message` FROM {$config->db_prefix}term_log
                WHERE `type` IN ('term removed','term renamed')
                ORDER BY `timestamp` DESC LIMIT 300;"
            )->fetchAll();
    }
    
    public static function updated_entries(WorldlangDictConfig $config) : array {
        $db = new \PDO($config->db_dsn, $config->db_user, $config->db_pass);
        return $db->query("
                SELECT `term`, `message`, max(`timestamp`) as `timestamp` FROM {$config->db_prefix}term_log
                WHERE `type` IN ('field updated','field removed','field added')
                GROUP BY term
                ORDER BY `timestamp` DESC LIMIT 300;"
            )->fetchAll();
    }
}