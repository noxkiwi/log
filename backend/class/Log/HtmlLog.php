<?php declare(strict_types = 1);
namespace noxkiwi\log\Log;

use noxkiwi\log\Log;
use noxkiwi\log\LogLevel;
use function chr;

/**
 * I am the HTML Logger.
 *
 * @package      noxkiwi\log\Log
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2022 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class HtmlLog extends Log
{
    private const COLORS = [
        LogLevel::EMERGENCY => '#F00',
        LogLevel::ALERT     => '#966',
        LogLevel::CRITICAL  => '#900',
        LogLevel::ERROR     => '#FF0',
        LogLevel::WARNING   => '#990',
        LogLevel::NOTICE    => '#666',
        LogLevel::INFO      => '#669',
        LogLevel::DEBUG     => '#999',
    ];

    /**
     * @inheritDoc
     */
    protected function write(string $message, int $level): void
    {
        $color = self::getColor($level);
        $name = LogLevel::getName($level);
        $time = date('Y-m-d H:i:s:u');
        echo <<<HTML
<pre style="color:$color;margin:0!IMPORTANT;padding:0!IMPORTANT;">[$time] [$name] $message</pre>
HTML . chr(10);
    }

    /**
     * I will return the correct text colour for the given $level.
     *
     * @param int $level
     *
     * @return string
     */
    private static function getColor(int $level): string
    {
        return self::COLORS[$level] ?? '#0FF';
    }
}
