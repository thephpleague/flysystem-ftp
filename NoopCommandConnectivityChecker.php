<?php

declare(strict_types=1);

namespace League\Flysystem\Ftp;

use TypeError;

class NoopCommandConnectivityChecker implements ConnectivityChecker
{
    public function isConnected($connection): bool
    {
        // @codeCoverageIgnoreStart
        try {
            $response = @ftp_raw($connection, 'NOOP');
        } catch (TypeError $typeError) {
            return false;
        }
        // @codeCoverageIgnoreEnd

        $responseCode = $response ? (int) substr($response[0], 0, 3) : false;

        return $responseCode === 200;
    }
}
