<?php

namespace MichelJonkman\Director\Base\Exceptions;

use Exception;

/**
 * Gets thrown on publish related errors
 */
class PublishException extends Exception
{
    const INVALID_IDENTIFIER_CODE = 100;

}
