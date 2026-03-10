<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithFileUploads;

class LetterHeadModel extends Model
{
    use HasFactory;
    protected $table = 'letter_heads';

    // Define which fields are mass assignable
    protected $fillable = [
        'logo',
        'customer_id',
        'company_name',
        'company_address',
        'web_link',
        'company_email',
        'phone_no',
    ];
}
