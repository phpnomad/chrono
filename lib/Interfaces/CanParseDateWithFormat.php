<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Parses a date expression using an explicit format string.
 *
 * Equivalent to DateTimeImmutable::createFromFormat(): the input must
 * match the supplied format exactly. Throws on inputs that do not
 * match the format.
 */
interface CanParseDateWithFormat
{
    public function parseFormat(string $expression, string $format): DateTimeImmutable;
}
