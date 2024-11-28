<?php

namespace Php\ApplePay\Decoding;

use RuntimeException;

class CertificateExtractor
{
    public function getCertificatesFromPkcs7(string $certificatePath): array
    {
      $signature = base64_decode($paymentData['signature']);

        if(empty($signature)) {
            throw new \RuntimeException('Signature is not a valid base64 value');
        }

        $getCertificatesCommand = ['openssl', 'pkcs7', '-inform', 'DER', '-in', $certificatePath, '-print_certs'];
        $output = shell_exec(implode(' ', $getCertificatesCommand));

        if (!$output) {
            throw new RuntimeException("Failed to extract certificates from $certificatePath");
        }

        return $this->normalizeCertificates($output);
    }

    private function normalizeCertificates(string $certificatesOutput): array
    {
        $certificates = explode("-----END CERTIFICATE-----", $certificatesOutput);
        $normalized = [];

        foreach ($certificates as $certificate) {
            $trimmed = trim($certificate);
            if (!empty($trimmed)) {
                $normalized[] = $trimmed . "-----END CERTIFICATE-----";
            }
        }

        return $normalized;
    }
}
