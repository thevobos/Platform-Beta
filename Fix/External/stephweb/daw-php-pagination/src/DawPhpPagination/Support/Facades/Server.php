<?php

namespace DawPhpPagination\Support\Facades;

/**
 * Facade pour la classe Request
 *
 * @link     https://github.com/stephweb/daw-php-pagination
 * @author   Stephen Damian <contact@devandweb.fr>
 * @license  MIT License
 */
final class Server extends Facade
{
    /**
     * @var DawPhpPagination\Support\Request\Server
     */
    protected static $instance;

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'DawPhpPagination\Support\Request\Server';
    }
}
