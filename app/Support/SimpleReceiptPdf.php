<?php

namespace App\Support;

use App\Models\Transaction;

class SimpleReceiptPdf
{
    public static function make(Transaction $transaction): string
    {
        $patient = $transaction->patient?->name ?: $transaction->appointment?->guest_name ?: 'Guest Patient';
        $patientCode = $transaction->patient?->formatted_patient_code ?: 'Guest';
        $service = $transaction->service?->name ?: $transaction->appointment?->service?->name ?: 'Dental Treatment';
        $dentist = $transaction->appointment?->dentist?->name ?: 'Not specified';
        $recordedBy = $transaction->recordedBy?->name ?: 'Front Desk';
        $reference = 'TXN-'.str_pad((string) $transaction->id, 5, '0', STR_PAD_LEFT);
        $created = $transaction->created_at?->format('d M Y g:i A') ?: now()->format('d M Y g:i A');

        $lines = [
            'CERILLO DENTAL CLINIC',
            'Official Payment Receipt',
            '',
            'Receipt: '.$reference,
            'Date: '.$created,
            'Patient: '.$patient,
            'Patient ID: '.$patientCode,
            'Service / Treatment: '.$service,
            'Dentist: '.$dentist,
            'Payment Method: '.$transaction->payment_method,
            'Amount Paid: PHP '.number_format((float) $transaction->amount, 2),
            'Status: '.ucfirst((string) $transaction->status),
            'Recorded by: '.$recordedBy,
            '',
            'Thank you for choosing Cerillo Dental Clinic.',
        ];

        $content = "BT\n/F1 18 Tf\n54 770 Td\n";
        foreach ($lines as $index => $line) {
            $fontSize = $index === 0 ? 18 : ($index === 1 ? 13 : 11);
            $escaped = self::escape($line);
            if ($index > 0) {
                $content .= "0 -24 Td\n";
            }
            $content .= "/F1 {$fontSize} Tf\n({$escaped}) Tj\n";
        }
        $content .= "ET\n";

        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 5 0 R >> >> /Contents 4 0 R >>',
            '<< /Length '.strlen($content).' >>'."\nstream\n".$content.'endstream',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
        ];

        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $i => $object) {
            $offsets[] = strlen($pdf);
            $pdf .= ($i + 1)." 0 obj\n{$object}\nendobj\n";
        }
        $xref = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n";
        $pdf .= "0000000000 65535 f \n";
        for ($i = 1; $i <= count($objects); $i++) {
            $pdf .= sprintf("%010d 00000 n \n", $offsets[$i]);
        }
        $pdf .= "trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF";

        return $pdf;
    }

    private static function escape(string $text): string
    {
        $text = preg_replace('/[^\x20-\x7E]/', ' ', $text) ?? $text;

        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
