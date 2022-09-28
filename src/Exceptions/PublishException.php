<?php

namespace MichelJonkman\Director\Exceptions;

use Exception;

/**
 * Gets thrown on publish related errors
 */
class PublishException extends DirectorException
{
    const INVALID_IDENTIFIER_CODE = 100;

}
