<?php declare(strict_types = 1);
namespace noxkiwi\log\Log;

use noxkiwi\log\Log;
use noxkiwi\log\LogLevel;
use function chr;
use function date;
use function file_put_contents;
use function is_writable;
use const FILE_APPEND;

/**
 * I am the file logger.
 *
 * @package      noxkiwi\log\Log
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class FileLog extends Log
{
    /** @var string Contains the logfile's path */
    private string $file;

    /**
     * @inheritDoc
     */
    protected function __construct(array $config)
    {
        parent::__construct($config);
        $this->file = $config['data']['file'] ?? '';
    }

    /**
     * @inheritDoc
     */
    protected function write(string $message, int $level): void
    {
        if (empty($this->file) || ! is_writable($this->file)) {
            return;
        }
        $levelName = LogLevel::getName($level);
        $date      = date('Y-m-d H:i:s.u');
        $line      = "[$date] [$levelName] : $message";
        file_put_contents($this->file, chr(10) . $line, FILE_APPEND);
    }
}
