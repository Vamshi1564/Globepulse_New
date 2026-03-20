<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $table = 'tbl_task_status';

    public function projects()
    {
        return $this->hasMany(Projects::class, 'status');  // Adjust the foreign key name accordingly
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);  // Adjust the foreign key name accordingly
    }

    public function invoices()
    {
        return $this->hasMany(Invoicemodel::class, 'status'); // Assume task_status_id exists in invoices
    }

}
