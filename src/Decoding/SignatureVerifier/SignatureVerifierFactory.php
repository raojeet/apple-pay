<?php

namespace Php\ApplePay\Decoding\SignatureVerifier;

use Exception;
use Php\ApplePay\Decoding\Asn1Wrapper;
use Php\ApplePay\Decoding\OpenSslService;

class SignatureVerifierFactory
{
    const ECC = 'EC_v1';
    const RSA = 'rsa';

    /**
     * @param $version
     * @return mixed|EccSignatureVerifier
     * @throws Exception
     */
    public function make($version)
    {
        switch ($version) {
            case self::ECC:
                $asn1Wrapper = new Asn1Wrapper();
                $openSslService = new OpenSslService();
                return new EccSignatureVerifier($asn1Wrapper, $openSslService);
            case self::RSA:
                throw new \RuntimeException('Unsupported type ' . $version);
            default:
                throw new \RuntimeException('Unknown type ' . $version);
        }
    }
}
