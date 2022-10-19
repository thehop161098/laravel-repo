<?php // pi_chk: 1e72fa32642958cb2fc2d9402b5402f3 ?>
<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CustomException extends Exception
{
    protected $errorCode;
    protected $extraData;

    public function __construct($message = "", $code = 0, Throwable $previous = null, $errorCode = '', $extraData = [])
    {
        parent::__construct($message, $code, $previous);

        $this->errorCode = $errorCode;
        $this->extraData = $extraData;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getExtraData()
    {
        return $this->extraData;
    }
}
