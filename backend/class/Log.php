<?php declare(strict_types = 1);
namespace noxkiwi\log;

use noxkiwi\core\Request;
use noxkiwi\log\Interfaces\LogInterface;
use noxkiwi\log\Observer\LogObserver;
use noxkiwi\observing\Observable\ObservableInterface;
use noxkiwi\observing\Traits\ObservableTrait;
use noxkiwi\singleton\Singleton;
use function is_int;

/**
 * I am the base logging class.
 *
 * @package      noxkiwi\log
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
abstract class Log extends Singleton implements LogInterface, ObservableInterface
{
    use ObservableTrait;

    protected const USE_DRIVER = true;
    protected const TYPE       = 'log';
    /**
     * I am the minimum level that is required make the log Client write log entries to the storage.
     * <br />If the log entry's level is LESS me, log WILL NOT be performed
     * <br />If the log entry's level is GREATER OR EQUAL me, log WILL be performed
     *
     * @var int
     */
    protected int $minLevel;

    /**
     * I am the basic logger constructor
     *
     * @param array $config
     */
    protected function __construct(array $config)
    {
        parent::__construct();
        $this->minLevel = LogLevel::DEBUG;
        if (is_int($config['data']['minlevel'] ?? null)) {
            $this->minLevel = (int)$config['data']['minlevel'];
        }
        $this->init();
    }

    /**
     * I will create underlying objects.
     */
    protected function init(): void
    {
        $this->attach(new LogObserver());
    }

    /**
     * @inheritDoc
     */
    final public function emergency(string $message, array $context = null): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGEMERGENCY);
    }

    /**
     * @inheritDoc
     */
    final public function log(int $level, string $message, array $context = null): void
    {
        if ($level < $this->minLevel) {
            return;
        }
        $this->notify(LogObserver::NOTIFY_LOGENTRY);
        $requestId = Request::getInstance()->getIdentifier();
        $message   = "[$requestId] $message";
        $this->write($message, $level);
    }

    /**
     * I will log the given $message into the current logging driver.
     *
     * @param string $message Text to be written to the index.
     * @param int    $level   The log level that is being used for this entry.
     */
    abstract protected function write(string $message, int $level): void;

    /**
     * @inheritDoc
     */
    final public function alert(string $message, array $context = null): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGALERT);
    }

    /**
     * @inheritDoc
     */
    final public function critical(string $message, array $context = null): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGCRITICAL);
    }

    /**
     * @inheritDoc
     */
    final public function error(string $message, array $context = null): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGERROR);
    }

    /**
     * @inheritDoc
     */
    final public function warning(string $message, array $context = null): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGWARNING);
    }

    /**
     * @inheritDoc
     */
    final public function notice(string $message, array $context = null): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
        $this->notify(LogObserver::NOTIFY_NOTICE);
    }

    /**
     * @inheritDoc
     */
    final public function info(string $message, array $context = null): void
    {
        $this->log(LogLevel::INFO, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGINFO);
    }

    /**
     * @inheritDoc
     */
    final public function debug(string $message, array $context = null): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
        $this->notify(LogObserver::NOTIFY_LOGDEBUG);
    }
}
