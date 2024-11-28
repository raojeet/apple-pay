<?php

namespace Php\ApplePay\Decoding\Decoder;

use Php\ApplePay\Decoding\Decoder\Algorithms\Ecc;
use Php\ApplePay\Decoding\OpenSslService;
use Php\ApplePay\Decoding\TemporaryFileService;

class ApplePayDecoderFactory
{

    const ECC = 'EC_v1';
    const RSA = 'rsa';

    public function __construct()
    {
    }

    /**
     * @param $version
     * @return mixed|ApplePayEccDecoder
     * @throws \RuntimeException
     */
    public function make($version)
    {
        switch ($version) {
            case self::ECC:
                $temporaryFileService = new TemporaryFileService();
                $openSslService = new OpenSslService();
                $ecc = new Ecc($temporaryFileService, $openSslService);
                return new ApplePayEccDecoder($ecc);
            case self::RSA:
                throw new \RuntimeException('Unsupported type ' . $version);
            default:
                throw new \RuntimeException('Unknown type ' . $version);
        }
    }
}
