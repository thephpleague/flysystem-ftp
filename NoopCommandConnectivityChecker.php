<?php

declare(strict_types=1);

namespace League\Flysystem\Ftp;

use TypeError;
use ValueError;

class NoopCommandConnectivityChecker implements ConnectivityChecker
{
    public function isConnected($connection): bool
    {
        // @codeCoverageIgnoreStart
        try {
            $response = @ftp_raw($connection, 'NOOP');
        } catch (TypeError | ValueError $typeError) {
            return false;
        }
        // @codeCoverageIgnoreEnd

            //$responseCode = $response ? (int) preg_replace('/\D/', '', implode('', $response)) : false;
        $responseCode = $response ? (int) substr(implode('', $response), 0, 3) : false;

        return $responseCode === 200;
    }
}
