<?php

namespace PHPNomad\Chrono\Interfaces;

use DateTimeImmutable;

/**
 * Model capability for any record that tracks when it was last modified.
 */
interface HasModifiedDate
{
    public function getModifiedDate(): DateTimeImmutable;
}
