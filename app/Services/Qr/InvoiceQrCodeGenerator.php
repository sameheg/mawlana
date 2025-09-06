<?php

namespace App\Services\Qr;

class InvoiceQrCodeGenerator
{
    /**
     * Generate TLV encoded string for invoice details.
     *
     * @param  array{seller_name:string,vat_number:string,timestamp:string,total:float,tax:float}  $data
     */
    public function generatePayload(array $data): string
    {
        $elements = [
            $this->encode(1, $data['seller_name']),
            $this->encode(2, $data['vat_number']),
            $this->encode(3, $data['timestamp']),
            $this->encode(4, (string) $data['total']),
            $this->encode(5, (string) $data['tax']),
        ];

        return base64_encode(implode('', $elements));
    }

    protected function encode(int $tag, string $value): string
    {
        $length = strlen($value);

        return pack('C2', $tag, $length) . $value;
    }
}
