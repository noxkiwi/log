<?php declare(strict_types = 1);
namespace noxkiwi\log\Observer;

use noxkiwi\observing\Observable\ObservableInterface;
use noxkiwi\observing\Observer;

/**
 * I am the observer for all logs.
 *
 * @package      noxkiwi\log\Observer
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
class LogObserver extends Observer
{
    public const NOTIFY_LOGENTRY     = 'logentry';
    public const NOTIFY_SKIPENTRY    = 'skipentry';
    public const NOTIFY_LOGEMERGENCY = 'logemergency';
    public const NOTIFY_LOGALERT     = 'logalert';
    public const NOTIFY_LOGCRITICAL  = 'logcritical';
    public const NOTIFY_LOGERROR     = 'logerror';
    public const NOTIFY_LOGWARNING   = 'logwarning';
    public const NOTIFY_NOTICE       = 'lognotice';
    public const NOTIFY_LOGINFO      = 'loginfo';
    public const NOTIFY_LOGDEBUG     = 'logdebug';
    /** @var int I am the count of written log lines. */
    public static int $countWritten = 0;
    /** @var int I am the count of skipped log lines. */
    public static int $countSkipped = 0;
    /** @var int I am the count of EMERGENCY logs. */
    public static int $countEmergency = 0;
    /** @var int I am the count of ALERT logs. */
    public static int $countAlert = 0;
    /** @var int I am the count of CRITICAL logs. */
    public static int $countCritical = 0;
    /** @var int I am the count of ERROR logs. */
    public static int $countError = 0;
    /** @var int I am the count of WARNING logs. */
    public static int $countWarning = 0;
    /** @var int I am the count of NOTICE logs. */
    public static int $countNotice = 0;
    /** @var int I am the count of INFO logs. */
    public static int $countInfo = 0;
    /** @var int I am the count of DEBUG logs. */
    public static int $countDebug = 0;

    /**
     * @inheritDoc
     */
    public function update(ObservableInterface $observable, string $type): void
    {
        switch ($type) {
            case self::NOTIFY_LOGENTRY:
                static::$countWritten++;
                break;
            case self::NOTIFY_SKIPENTRY:
                static::$countSkipped++;
                break;
            case self::NOTIFY_LOGEMERGENCY:
                static::$countEmergency++;
                break;
            case self::NOTIFY_LOGALERT:
                static::$countAlert++;
                break;
            case self::NOTIFY_LOGCRITICAL:
                static::$countCritical++;
                break;
            case self::NOTIFY_LOGERROR:
                static::$countError++;
                break;
            case self::NOTIFY_LOGWARNING:
                static::$countWarning++;
                break;
            case self::NOTIFY_NOTICE:
                static::$countNotice++;
                break;
            case self::NOTIFY_LOGINFO:
                static::$countInfo++;
                break;
            case self::NOTIFY_LOGDEBUG:
                static::$countDebug++;
                break;
            default:
                break;
        }
    }
}
