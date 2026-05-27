<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Model capability for any record that tracks when it was created.
 */
interface HasCreatedDate
{
    public function getCreatedDate(): DateTimeImmutable;
}
