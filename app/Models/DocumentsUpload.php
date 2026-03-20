<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentsUpload extends Model
{
    use HasFactory;

    protected $table = 'tbl_client_document_upload';
    public $timestamps = false;
    protected $primaryKey = 'upload_id';


    
    protected $fillable = [
        'docname_id', 
        'task_id', 
        'lead_id', 
        'doc_link', 
        'status_code', 
        'doc_status',
        'deleted_by',
        'deleted_at',
        'is_deleted',
        'sample_doc_link',
    ];

    public function documents()
    {
        return $this->belongsTo(Documents::class, 'docname_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'lead_id');
    }
}
