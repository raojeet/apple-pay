<?php

namespace Php\ApplePay;

use Php\ApplePay\Decoding\ApplePayDecodingService;
use Php\ApplePay\Decoding\Asn1Wrapper;
use Php\ApplePay\Decoding\Decoder\ApplePayDecoderFactory;
use Php\ApplePay\Decoding\OpenSslService;
use Php\ApplePay\Decoding\PKCS7SignatureValidator;
use Php\ApplePay\Decoding\PKCS7SignatureValidatorSettings;
use Php\ApplePay\Decoding\SignatureVerifier\SignatureVerifierFactory;
use Php\ApplePay\Decoding\TemporaryFileService;

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