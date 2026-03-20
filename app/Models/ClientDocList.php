<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientDocList extends Model
{
    use HasFactory;
    protected $table = 'tbl_client_document_list';

    protected $fillable = [
        'doc_name_id', // adjust if needed
        'serviceid', // adjust if needed
        'doc_status', // adjust if needed
    ];

    public $timestamps = false;

      /* Service relation */
    public function service()
    {
        return $this->belongsTo(ServiceListModel::class, 'serviceid');
    }

    /* Document relation */
    public function document()
    {
        return $this->belongsTo(Documents::class, 'doc_name_id');
    }
}
