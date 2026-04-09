<?php
// FILE: app/Models/SellerKyc.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerKyc extends Model
{
    use SoftDeletes;

    protected $table = 'seller_kyc';

    protected $fillable = [
        // Account Holder
        'seller_id',
        'account_holder_name',
        'account_holder_type',

        // Bank Details
        'bank_account_number',
        'bank_ifsc_code',
        'bank_swift_code',
        'bank_name',
        'bank_branch_name',
        'bank_account_type',

        // Tax / GST
        'gstin',
        'pan_number',
        'tan_number',
        'is_gst_registered',

        // Owner
        'owner_full_name',
        'owner_dob',
        'owner_nationality',
        'owner_id_type',
        'owner_id_number',

        // Address
        'registered_address_line1',
        'registered_address_line2',
        'registered_city',
        'registered_state',
        'registered_pincode',
        'registered_country',

        // Documents (file paths)
        'doc_cancelled_cheque',
        'doc_cancelled_cheque_name',
        'doc_gst_certificate',
        'doc_gst_certificate_name',
        'doc_pan_card',
        'doc_pan_card_name',
        'doc_incorporation_cert',
        'doc_incorporation_cert_name',
        'doc_moa',
        'doc_moa_name',

        // CCAvenue
        'ccavenue_merchant_id',
        'ccavenue_reference_id',
        'ccavenue_status',
        'ccavenue_remarks',
        'ccavenue_submitted_at',
        'ccavenue_approved_at',

        // Internal Review
        'internal_status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
        'submitted_at',
    ];

    protected $casts = [
        'is_gst_registered'     => 'boolean',
        'ccavenue_submitted_at' => 'datetime',
        'ccavenue_approved_at'  => 'datetime',
        'reviewed_at'           => 'datetime',
        'submitted_at'          => 'datetime',
    ];

    // ── Relationships ────────────────────────────────────────────────
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    // ── Helpers ──────────────────────────────────────────────────────

    /** Human-readable internal status label */
    public function getInternalStatusLabelAttribute(): string
    {
        return match($this->internal_status) {
            'draft'      => 'Draft',
            'submitted'  => 'Submitted — Awaiting Review',
            'approved'   => 'Approved',
            'rejected'   => 'Rejected',
            'more_info'  => 'More Info Required',
            default      => ucfirst($this->internal_status),
        };
    }

    /** Bootstrap colour for the badge */
    public function getInternalStatusColorAttribute(): string
    {
        return match($this->internal_status) {
            'draft'      => 'secondary',
            'submitted'  => 'warning',
            'approved'   => 'success',
            'rejected'   => 'danger',
            'more_info'  => 'info',
            default      => 'light',
        };
    }

    /** Whether the seller can still edit the KYC form */
    public function isEditable(): bool
    {
        return in_array($this->internal_status, ['draft', 'more_info', 'rejected']);
    }

    /** Whether CCAvenue escrow creation is ready */
    public function isReadyForEscrow(): bool
    {
        return $this->internal_status === 'approved'
            && $this->ccavenue_status === 'not_submitted';
    }

    /** Core completeness check — all mandatory fields filled? */
    public function isCoreComplete(): bool
    {
        $mandatory = [
            $this->account_holder_name,
            $this->bank_account_number,
            $this->bank_ifsc_code,
            $this->bank_name,
            $this->bank_account_type,
            $this->pan_number,
            $this->owner_full_name,
            $this->owner_id_type,
            $this->owner_id_number,
            $this->registered_address_line1,
            $this->registered_city,
            $this->registered_state,
            $this->registered_pincode,
            $this->doc_pan_card,        // PAN card doc required
            $this->doc_cancelled_cheque, // Bank proof required
        ];

        return collect($mandatory)->every(fn($v) => !empty($v));
    }
}