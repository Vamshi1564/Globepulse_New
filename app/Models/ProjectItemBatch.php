<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItemBatch extends Model
{
    use HasFactory;

    protected $table = 'tbl_projectitem_batches';

    protected $fillable = ['projectitem_id', 'batch_id' , 'projectid'];

    public function projectItem()
    {
        return $this->belongsTo(ProjectItem::class, 'projectitem_id');
    }
}
