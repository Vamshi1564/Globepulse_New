<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDocUpload extends Model
{
    use HasFactory;

    protected $table = 'tbl_client_document_upload';

    protected $fillable = [
        'docname_id',
        'lead_id',
        'doc_status',
        'task_id',
        'status_code',
        'sample_doc_link',
    ];

    public $timestamps = false;
}
