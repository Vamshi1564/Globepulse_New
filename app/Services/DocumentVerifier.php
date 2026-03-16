<?php
// FILE: app/Services/DocumentVerifier.php
// Basic local validation only — no external APIs, no pixel analysis, no PII risk.
// Checks: file type, file size, and whether a photo was uploaded to a document slot.

namespace App\Services;

class DocumentVerifier
{
    // Slots that expect a scanned document (not a selfie/photo)
    private const DOCUMENT_SLOTS = [
        'owner_id_passport',
        'business_registration',
        'tax_id',
        'business_license',
    ];

    // Slots that expect a photo/selfie
    private const PHOTO_SLOTS = [
        'selfie',
    ];

    private const ALLOWED_MIMES = [
        'image/jpeg', 'image/jpg', 'image/png', 'application/pdf',
    ];

    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'pdf'];

    private const MIN_SIZE_BYTES = 5 * 1024;     //  5 KB minimum
    private const MAX_SIZE_BYTES = 5 * 1024 * 1024; // 5 MB maximum

    private const LABELS = [
        'owner_id_passport'     => 'Owner ID or Passport',
        'business_registration' => 'Business Registration Document',
        'tax_id'                => 'Tax ID Document',
        'business_license'      => 'Business License',
        'selfie'                => 'Selfie with ID',
    ];

    private const EXAMPLES = [
        'owner_id_passport'     => 'Aadhaar Card, Passport, Driving Licence, PAN Card, or Voter ID',
        'business_registration' => 'GST Certificate, Certificate of Incorporation, or Business Registration',
        'tax_id'                => 'GST Certificate, PAN Card (business), or TIN Certificate',
        'business_license'      => 'Shop & Establishment Certificate or Trade Licence',
        'selfie'                => 'a photo of yourself holding your government ID',
    ];

    /**
     * Run basic validation on an uploaded document.
     *
     * @param string $originalName  Original filename from user's device
     * @param string $mimeType      MIME type detected by PHP
     * @param string $extension     File extension (lowercase)
     * @param int    $fileSize      File size in bytes
     * @param string $docType       Slot type: owner_id_passport | business_registration | tax_id | business_license | selfie
     *
     * @return array {
     *   'valid'      => bool,
     *   'status'     => 'ok' | 'warn' | 'error',
     *   'message'    => string,   // shown to user
     *   'admin_note' => string,   // stored in DB
     * }
     */
    public static function validate(
        string $originalName,
        string $mimeType,
        string $extension,
        int    $fileSize,
        string $docType
    ): array {
        $label   = self::LABELS[$docType]   ?? $docType;
        $example = self::EXAMPLES[$docType] ?? '';
        $ext     = strtolower(trim($extension, '.'));

        // ── 1. File extension must be allowed ─────────────────
        if (!in_array($ext, self::ALLOWED_EXTENSIONS)) {
            return self::error(
                "Only PDF, JPG, and PNG files are accepted. You uploaded a .{$ext} file.",
                "Rejected: invalid extension .{$ext}"
            );
        }

        // ── 2. MIME type must match extension ─────────────────
        $mimeOk = match($ext) {
            'pdf'        => $mimeType === 'application/pdf',
            'jpg','jpeg' => in_array($mimeType, ['image/jpeg','image/jpg']),
            'png'        => $mimeType === 'image/png',
            default      => false,
        };

        if (!$mimeOk) {
            return self::error(
                "File appears to be invalid — the content does not match a {$ext} file. Please re-export and try again.",
                "MIME mismatch: ext={$ext}, mime={$mimeType}"
            );
        }

        // ── 3. File size ──────────────────────────────────────
        if ($fileSize < self::MIN_SIZE_BYTES) {
            $kb = round($fileSize / 1024, 1);
            return self::error(
                "File is too small ({$kb} KB). Please upload a clear, full-size scan or photo.",
                "Rejected: file too small ({$kb} KB)"
            );
        }

        if ($fileSize > self::MAX_SIZE_BYTES) {
            $mb = round($fileSize / 1024 / 1024, 1);
            return self::error(
                "File is too large ({$mb} MB). Maximum allowed size is 5 MB. Please compress and retry.",
                "Rejected: file too large ({$mb} MB)"
            );
        }

        // ── 4. Photo uploaded to a document slot? ─────────────
        // If the slot expects a scanned document but user uploads an image file,
        // give a soft warning (not a hard block — they may have photographed the doc)
        if (in_array($docType, self::DOCUMENT_SLOTS) && in_array($ext, ['jpg','jpeg','png'])) {
            // This is OK — many people photograph their documents with a phone.
            // Just remind them it needs to show the full document clearly.
            return self::warn(
                "Photo uploaded. Make sure the full {$label} is clearly visible with no cut-off edges.",
                "Image uploaded to document slot — accepted with reminder."
            );
        }

        // ── 5. Non-image uploaded to selfie slot ───────────────
        if (in_array($docType, self::PHOTO_SLOTS) && $ext === 'pdf') {
            return self::error(
                "The selfie slot requires a photo (JPG or PNG), not a PDF. Please take or upload a photo of yourself holding your ID.",
                "Rejected: PDF uploaded to selfie slot."
            );
        }

        // ── All checks passed ─────────────────────────────────
        return [
            'valid'      => true,
            'status'     => 'ok',
            'message'    => '✓ File accepted.',
            'admin_note' => "Passed basic validation. ext={$ext}, size=" . round($fileSize/1024) . "KB",
        ];
    }

    private static function error(string $message, string $adminNote): array
    {
        return ['valid' => false, 'status' => 'error', 'message' => $message, 'admin_note' => $adminNote];
    }

    private static function warn(string $message, string $adminNote): array
    {
        return ['valid' => true, 'status' => 'warn', 'message' => $message, 'admin_note' => $adminNote];
    }
}