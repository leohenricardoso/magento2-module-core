<?php
/**
 * @author Leonardo Henrique Cardoso
 * @copyright Copyright (c) 2021 Leonardo Henrique Cardoso (https://leohenrique.me)
 * @package LeonardoHenrique_Core
 */
namespace LeonardoHenrique\Core\Helper;

use Laminas\Log\Logger as LaminasLogger;
use Laminas\Log\Writer\Stream;

class Logger
{
    public static function execute($class, $data, $type = 'info', $logName = false)
    {
        $logName = !$logName ? 'leonardo_henrique' : $logName;
        $writer = new Stream(BP . '/var/log/' . $logName . '.log');
        $logger = new LaminasLogger();
        $logger->addWriter($writer);
        $data = $class . ' => ' . $data;
        switch ($type) {
            case 'warn':
                $logger->warn(json_encode($data, JSON_PRETTY_PRINT));
                break;
            case 'debug':
                $logger->debug(json_encode($data, JSON_PRETTY_PRINT));
                break;
            case 'err':
                $logger->err(json_encode($data, JSON_PRETTY_PRINT));
                break;
            case 'crit':
                $logger->crit(json_encode($data, JSON_PRETTY_PRINT));
                break;
            default:
                $logger->info(json_encode($data, JSON_PRETTY_PRINT));
                break;
        }
    }
}
