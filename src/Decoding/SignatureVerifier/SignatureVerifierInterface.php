<?php

namespace Php\ApplePay\Decoding\SignatureVerifier;

interface SignatureVerifierInterface
{
    public function verify(array $paymentData);
}
