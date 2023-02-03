<?php

namespace MichelJonkman\Director\Exceptions;

use Exception;

/**
 * Gets thrown on publish related errors
 */
class PublishException extends DirectorException
{
    const INVALID_IDENTIFIER_CODE = 100;
    const INVALID_DIRECTORY_PATH = 101;
    const DUPLICATE_IDENTIFIER = 102;

}
