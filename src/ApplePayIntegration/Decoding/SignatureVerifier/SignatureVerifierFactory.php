<?php

namespace ApplePayIntegration\Decoding\SignatureVerifier;

use Exception;
use ApplePayIntegration\Decoding\Asn1Wrapper;
use ApplePayIntegration\Decoding\OpenSslService;

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
