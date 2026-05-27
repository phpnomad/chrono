<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Parses a flexible date expression into a DateTimeImmutable.
 *
 * Accepts the same kinds of strings as PHP's strtotime() or
 * Carbon::parse(): ISO 8601, RFC 3339, MySQL DATETIME, relative
 * expressions like "next monday", etc. The exact grammar is the
 * implementation's choice. Throws on inputs the implementation
 * cannot parse.
 */
interface CanParseDate
{
    public function parse(string $expression): DateTimeImmutable;
}
