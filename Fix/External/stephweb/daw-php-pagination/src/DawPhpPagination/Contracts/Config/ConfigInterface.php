<?php

namespace DawPhpPagination\Contracts\Config;

/**
 * @link     https://github.com/stephweb/daw-php-pagination
 * @author   Stephen Damian <contact@devandweb.fr>
 * @license  MIT License
 */
Interface ConfigInterface
{
    /**
     * @param array $config
     */
    public static function set(array $config);

    /**
     * @return array
     */
    public static function get(): array;
}
