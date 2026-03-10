<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSourceTeamAssignModel extends Model
{
    use HasFactory;
    protected $table = 'tblleads_sources_team_assing';
    public $timestamps = false;

    protected $fillable = ['products_id', 'source_id', 'staff_id', 'status', 'lead_assing'];
}
