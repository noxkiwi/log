<?php declare(strict_types = 1);
namespace noxkiwi\log\Traits;

use noxkiwi\log\Log;
use noxkiwi\log\LogLevel;

/**
 * I am the Log trait. I extend an existing class for all methods that are related to the logging system.
 *
 * @package      noxkiwi\log\Traits
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
trait LogTrait
{
    /** @var \noxkiwi\log\Log[][] I am the logger that will be used. */
    private array $loggers = [];

    /**
     * I will add the logger to the log stack.
     *
     * @param int[]            $levels
     * @param \noxkiwi\log\Log $log
     */
    public function addLogger(array $levels, Log $log): void
    {
        foreach ($levels as $level) {
            $this->loggers[$level][] = $log;
        }
    }

    /**
     * Writes data to the emergency log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function logEmergency(string $text, array $context = null): void
    {
        $this->log(LogLevel::EMERGENCY, "[EMG] $text", $context);
    }

    /**
     * I may perform log with debug level
     *
     * @param int        $level
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function log(int $level, string $text, array $context = null): void
    {
        /** @var \noxkiwi\log\Log $logger */
        foreach ($this->loggers[$level] ?? [] as $logger) {
            $logger->log($level, $text, $context);
        }
    }

    /**
     * Writes data to the alert log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logAlert(string $text, array $context = null): void
    {
        $this->log(LogLevel::ALERT, "[ALT] $text", $context);
    }

    /**
     * Writes data to the critical log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logCritical(string $text, array $context = null): void
    {
        $this->log(LogLevel::CRITICAL, "[CRT] $text", $context);
    }

    /**
     * Writes data to the error log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logError(string $text, array $context = null): void
    {
        $this->log(LogLevel::ERROR, "[ERR] $text", $context);
    }

    /**
     * Writes data to the warning log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logWarning(string $text, array $context = null): void
    {
        $this->log(LogLevel::WARNING, "[WRN] $text", $context);
    }

    /**
     * Writes data to the notice log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logNotice(string $text, array $context = null): void
    {
        $this->log(LogLevel::NOTICE, "[NTC] $text", $context);
    }

    /**
     * Writes data to the info log
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logInfo(string $text, array $context = null): void
    {
        $this->log(LogLevel::INFO, "[INF] $text", $context);
    }

    /**
     * I may perform log with debug level
     *
     * @param string     $text    content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    final public function logDebug(string $text, array $context = null): void
    {
        $this->log(LogLevel::DEBUG, "[DBG] $text", $context);
    }
}
