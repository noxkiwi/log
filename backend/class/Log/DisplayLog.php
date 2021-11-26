<?php declare(strict_types = 1);
namespace noxkiwi\log\Log;

use noxkiwi\log\Log;
use function chr;

/**
 * I am the simple display logger.
 *
 * @package      noxkiwi\log\Log
 * @author       Jan Nox <jan.nox@pm.me>
 * @license      https://nox.kiwi/license
 * @copyright    2021 noxkiwi
 * @version      1.0.0
 * @link         https://nox.kiwi/
 */
final class DisplayLog extends Log
{
    /**
     * @inheritDoc
     */
    protected function write(string $message, int $level): void
    {
        echo chr(10) . $message;
    }
}
