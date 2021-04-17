<?php

namespace DawPhpPagination\Contracts\Support\Request;

/**
 * @link     https://github.com/stephweb/daw-php-pagination
 * @author   Stephen Damian <contact@devandweb.fr>
 * @license  MIT License
 */
Interface RequestInterface
{
    /**
     * Request Constructor.
     */
    public function __construct();

    /**
     * @return ParameterBag
     */
    public function getGet();

    /**
     * @return ParameterBag
     */
    public function getServer();

    /**
     * Verifier si Ajax
     *
     * @return bool
     */
    public function isAjax(): bool;
}
