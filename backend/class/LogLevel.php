<?php declare(strict_types = 1);
namespace noxkiwi\log;

/**
 * I am the list of Log Levels.
 *
 * @package      noxkiwi\log
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
abstract class LogLevel
{
    public const EMERGENCY = 5;
    public const ALERT     = 4;
    public const CRITICAL  = 3;
    public const ERROR     = 2;
    public const WARNING   = 1;
    public const NOTICE    = 0;
    public const INFO      = -1;
    public const DEBUG     = -2;
    public const ALL       = [
        self::EMERGENCY,
        self::ALERT,
        self::CRITICAL,
        self::ERROR,
        self::WARNING,
        self::NOTICE,
        self::INFO,
        self::DEBUG
    ];
    public const NAMES     = [
        self::EMERGENCY => 'EMERGENCY',
        self::ALERT     => 'ALERT',
        self::CRITICAL  => 'CRITICAL',
        self::ERROR     => 'ERROR',
        self::WARNING   => 'WARNING',
        self::NOTICE    => 'NOTICE',
        self::INFO      => 'INFO',
        self::DEBUG     => 'DEBUG'
    ];

    /**
     * I will solely return the name of the given $level.
     *
     * @param int $level
     *
     * @return string
     */
    public static function getName(int $level): string
    {
        return self::NAMES[$level] ?? 'unknown';
    }
}
