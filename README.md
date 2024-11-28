**Apple Pay Token Decoder PHP**

This library is used to decode tokens for Apple Pay.

It takes a payment token data and returns an ApplePayPaymentData object.
ex:
```
class ApplePayIntegration\Decoding\ApplePayPaymentData#19 (9) {
  private $version =>
  int(1)
  private $applicationPrimaryAccountNumber =>
  string(16) "20427527000"
  private $applicationExpirationDate =>
  string(6) "190731"
  private $currencyCode =>
  string(3) "643"
  private $transactionAmount =>
  int(100000)
  private $deviceManufacturerIdentifier =>
  string(12) "050103073"
  private $paymentDataType =>
  string(8) "3DSecure"
  private $onlinePaymentCryptogram =>
  string(28) "Am+7lPDbobAGVT7hNAoABA=="
  private $eciIndicator =>
  NULL
}
```


**Install:**

Run `composer require php/apple-pay`

**Get AppleRootCA-G3.pem:**

1. Download [AppleRootCA-G3.cer](https://www.apple.com/certificateauthority)
2. Run command: `openssl x509 -inform der -in AppleRootCA-G3.cer -out AppleRootCA-G3.pem`

**Get Private Key:**

1. Export merchant certificate to a p12 cert
2. Use openssl to get the private key: `openssl pkcs12 -in <your_cert>.p12 -out private_key.pem -nocerts -nodes`
3. Copy content without `BEGIN` and `END` markers

**Usage:**

See https://github.com/raojeet/apple-pay/blob/master/example/test.php

For more information about how Apple Pay tokens decoding works go to:
https://developer.apple.com/library/content/documentation/PassKit/Reference/PaymentTokenJSON/PaymentTokenJSON.html

Only works on Linux hosts with openssl installed
