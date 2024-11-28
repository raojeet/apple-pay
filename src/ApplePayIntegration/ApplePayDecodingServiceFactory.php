<?php

namespace ApplePayIntegration;

use ApplePayIntegration\Decoding\ApplePayDecodingService;
use ApplePayIntegration\Decoding\Asn1Wrapper;
use ApplePayIntegration\Decoding\Decoder\ApplePayDecoderFactory;
use ApplePayIntegration\Decoding\OpenSslService;
use ApplePayIntegration\Decoding\PKCS7SignatureValidator;
use ApplePayIntegration\Decoding\PKCS7SignatureValidatorSettings;
use ApplePayIntegration\Decoding\SignatureVerifier\SignatureVerifierFactory;
use ApplePayIntegration\Decoding\TemporaryFileService;

class ApplePayDecodingServiceFactory
{
    /**
     * @return ApplePayDecodingService
     */
    public function make()
    {
        $decoderFactory = new ApplePayDecoderFactory();
        $signatureVerifierFactory = new SignatureVerifierFactory();
        $asn1Wrapper = new Asn1Wrapper();
        $temporaryFileService = new TemporaryFileService();
        $openSslService = new OpenSslService();
        $pkcs7SignatureValidatorSettings = new PKCS7SignatureValidatorSettings();
        $pkcs7SignatureValidator = new PKCS7SignatureValidator($signatureVerifierFactory, $asn1Wrapper, $temporaryFileService, $openSslService, $pkcs7SignatureValidatorSettings);

        return new ApplePayDecodingService($decoderFactory, $pkcs7SignatureValidator);
    }

}