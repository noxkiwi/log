<?php declare(strict_types = 1);
namespace noxkiwi\log\Log;

use noxkiwi\log\Log;
use noxkiwi\log\LogLevel;
use function chr;
use function date;
use function explode;
use function max;
use function str_repeat;
use function strlen;
use function wordwrap;

/**
 * I am the CLI logger.
 *
 * @package      noxkiwi\log\Log
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class CliLog extends Log
{
    protected const USE_DRIVER = false;
    private const   SSH_COLS   = 180;
    /** @var array I am the list of foreground colors. */
    private const FOREGROUND_COLOURS = [
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37'
    ];
    /** @var array I am the list of background colors. */
    private const BACKGROUND_COLOURS = [
        'black'      => '40',
        'red'        => '41',
        'green'      => '42',
        'yellow'     => '43',
        'blue'       => '44',
        'magenta'    => '45',
        'cyan'       => '46',
        'light_gray' => '47'
    ];

    /**
     * @inheritDoc
     */
    protected function write(string $message, int $level): void
    {
        switch ($level) {
            case LogLevel::EMERGENCY:
                $foregroundColor = self::FOREGROUND_COLOURS['white'];
                $backgroundColor = self::BACKGROUND_COLOURS['red'];
                break;
            case LogLevel::ALERT:
                $foregroundColor = self::FOREGROUND_COLOURS['black'];
                $backgroundColor = self::BACKGROUND_COLOURS['red'];
                break;
            case LogLevel::CRITICAL:
                $foregroundColor = self::FOREGROUND_COLOURS['black'];
                $backgroundColor = self::BACKGROUND_COLOURS['yellow'];
                break;
            case LogLevel::ERROR:
                $foregroundColor = self::FOREGROUND_COLOURS['red'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
            case LogLevel::WARNING:
                $foregroundColor = self::FOREGROUND_COLOURS['yellow'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
            case LogLevel::NOTICE:
                $foregroundColor = self::FOREGROUND_COLOURS['blue'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
            case LogLevel::INFO:
                $foregroundColor = self::FOREGROUND_COLOURS['green'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
            case LogLevel::DEBUG:
                $foregroundColor = self::FOREGROUND_COLOURS['cyan'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
            default:
                $foregroundColor = self::FOREGROUND_COLOURS['white'];
                $backgroundColor = self::BACKGROUND_COLOURS['black'];
                break;
        }
        $date   = '[' . date('Y-m-d H:i:s.u') . '] ';
        $length = self::SSH_COLS - 29;
        $lines  = explode(chr(10), wordwrap($message, $length, chr(10), true));
        foreach ($lines as $line) {
            $appendix = str_repeat(' ', max(0, self::SSH_COLS - 29 - strlen($line)));
            echo "\033[{$foregroundColor}m\033[{$backgroundColor}m$date$line$appendix\033[0m" . chr(10);
        }
    }
}
