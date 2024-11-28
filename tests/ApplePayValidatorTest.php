<?php

use Php\ApplePay\Validator\ApplePayValidator;
use Php\ApplePay\Exception\InvalidFormatException;
use PHPUnit\Framework\TestCase;

class ApplePayValidatorTest extends TestCase
{
    private ApplePayValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ApplePayValidator();
    }

    public function testValidPaymentDataStructure(): void
    {
        $paymentData = [
            'version' => 'EC_v1',
            'data' => 'encryptedData',
            'signature' => 'validSignature',
            'header' => [
                'ephemeralPublicKey' => 'publicKey',
                'publicKeyHash' => 'hash',
                'transactionId' => 'transactionId',
            ]
        ];

        $this->validator->validatePaymentDataStructure($paymentData);
        $this->assertTrue(true); // Passes if no exception is thrown
    }

    public function testInvalidPaymentDataStructure(): void
    {
        $this->expectException(InvalidFormatException::class);

        $paymentData = [
            'version' => 'EC_v1',
            'data' => 'encryptedData',
            'signature' => 'validSignature'
            // Missing 'header'
        ];

        $this->validator->validatePaymentDataStructure($paymentData);
    }
}
