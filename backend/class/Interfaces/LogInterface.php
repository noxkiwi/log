<?php declare(strict_types = 1);
namespace noxkiwi\log\Interfaces;

/**
 * I am the interface for all Loggers.
 *
 * @package      noxkiwi\log\Interfaces
 * @author       Jan Nox <jan@nox.kiwi>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
interface LogInterface
{
    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for emergency Logging:
     *  - A payment system is being brute-forced.
     *  - The datamodel of the application is inconsistent.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function emergency(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for alert Logging:
     *  - You are trying to download a file from a bucket, but it was not found.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function alert(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for critical Logging:
     *  - You are creating backups using a cronjob but a subcomponent throws errors.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function critical(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for error Logging:
     *  - You are expecting a user to give a valid IBAN number. The validation fails and the process is stopped.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function error(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for warning Logging:
     *  - You are developing a gallery but one of the images is missing on the bucket.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function warning(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for notice Logging:
     *  - You are creating a media converter based on cronjobs. To check the process you create a log file.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function notice(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * Example scenarios for info Logging:
     *  - You are handling files on a bucket storage. You want to log any action that is not an error.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function info(string $message, array $context = null): void;

    /**
     * I will log the given text if the logging driver is configured to log this level.
     * I will also log the time gone by since the request has started.
     * Example scenarios for emergency Logging:
     *  - You are creating a cronjob that copies data from the service to your local system. You want to track the
     *  action.
     *  - You may want siple performance insights.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param string     $message    Content to write to the log entry.
     * @param array|null $context Context to log into the entry.
     */
    public function debug(string $message, array $context = null): void;

    /**
     * I will log the entry with an arbitrary level.
     *
     * @link         https://www.php-fig.org/psr/psr-3/
     *
     * @param int        $level
     * @param string     $message
     * @param array|null $context
     */
    public function log(int $level, string $message, array $context = null): void;
}
