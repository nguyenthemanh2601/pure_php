<?php

namespace Core\Http\Exception;

/**
 * Raised when a user sends a malformed request.
 */
class NotFoundException extends HttpException
{
    /* http status code */
    const HTTP_STATUS_CODE = 404;

    /* http response text */
    const HTTP_RESPONSE_TEXT = 'Page NOT FOUND!!!';

    public function __construct(string|null $message = null)
    {
        parent::__construct($message ?? self::HTTP_RESPONSE_TEXT);
    }
}
