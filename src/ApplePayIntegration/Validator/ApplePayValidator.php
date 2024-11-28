<?php

namespace ApplePayIntegration\Validator;

use ApplePayIntegration\Exception\InvalidFormatException;

class ApplePayValidator
{
  const REQUIRED_KEYS_PAYMENT_DATA = [
    'version',
    'data',
    'signature',
    'header' => [
      'ephemeralPublicKey', 'publicKeyHash', 'transactionId',
    ]
  ];

  /**
   * Validate the structure of payment data.
   *
   * @param array $input
   * @return bool
   * @throws InvalidFormatException
   */
  public function validatePaymentDataStructure(array $input): bool
  {
    return $this->isValidStructure($input, self::REQUIRED_KEYS_PAYMENT_DATA);
  }

  /**
   * Validate structure against a format.
   *
   * @param array $input
   * @param array $format
   * @return bool
   * @throws InvalidFormatException
   */
  private function isValidStructure(array $input, array $format): bool
  {
    foreach ($format as $key => $value) {
      if (is_numeric($key)) {
        $key = $value;
      }
      if (!isset($input[$key])) {
        throw new InvalidFormatException("Parameter *{$key}* is missing", 400);
      }

      if (is_array($value)) {
        $this->isValidStructure($input[$key], $value);
      }
    }

    return true;
  }
}
