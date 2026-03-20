<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'tblstaff';

    protected $primaryKey = 'staffid';
    public $timestamps = false;



    protected $fillable = [
        'emp_code',
        'firstname',
        'lastname',
        'personal_number',
        'staff_type',
        'phonenumber',
        'whatsapp_number',
        'email',
        'business_email',
        'Salary',
        'departmentid',
        'password',
        'tgt_team',
        'tgt_induvial',
        'role',
        'tm_id',
        'reporting_manager_id',
        'tl_id',
        'gender',
        'avp_id',
        'worktype',
        'joining_date',
        'emergency_contact_name',
        'blood_group',
        'emergency_no',
        'kyc',
        'active',
        'marriage_anniversary_date',
        'permanent_address',
        'present_address',
        'reference_name1',
        'reference_number1',
        'reference_name2',
        'reference_number2',
        'bank_name',
        'branch_name',
        'bank_accountnumber',
        'bank_ifsc_code',
        'aadhar_number',
        'pan_number',
        'deactivated_at',
        'age',
        'dob',
        'city',
        'state',
        'ifsc_code',
        'present_pincode',
        'aadhar_name',
        'pan_name',
        'permanent_pincode',
        'permanent_city',
        'permanent_state',
        'profile_completed',
        'accept_terms',
        'doc_verified',
        'profile_image',
        'parcentage_id',
        'freeze_status',
        'last_activity',
    ];
    // public function invoicePaymentRecords()
    // {
    //     return $this->hasMany(InvoicePaymentRecord::class, 'sale_agent_id');
    // }
    // Staff.php
    public function reportingManager()
    {
        return $this->belongsTo(Staff::class, 'reporting_manager_id');
    }

    public function reminder()
    {
        return $this->hasMany(Reminder::class);
    }
    public function invoicePaymentRecords()
    {
        return $this->hasMany(InvoicePaymentRecordModel::class, 'sale_agent_id');
    }
    public function customer()
    {
        return $this->hasMany(Customer::class, 'assigned');
    }
    public function customerRequestStaffid()
    {
        return $this->hasMany(Customer::class, 'request_staff_id');
    }

    public function role()
    {
        return $this->belongsTo(RoleModel::class, 'role', 'roleid');
    }
    public function roleData()
    {
        return $this->belongsTo(RoleModel::class, 'role', 'roleid');
    }
    public function hrreminder()
    {
        return $this->hasMany(HrRemainder::class);
    }

    public function department()
    {
        return $this->belongsTo(Departments::class, 'departmentid', 'departmentid');
    }

    public function project()
    {
        return $this->hasMany(Projects::class, 'addedfrom');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned', 'staffid');
    }

    public function leavemanagement()
    {
        return $this->hasMany(LeaveManagement::class, 'staffid');
    }
    public function staffmnapping()
    {
        return $this->hasMany(StaffMapping::class, 'parentid', 'staffid');
    }
    // App\Models\Staff.php
    public function monthlyLeaves()
    {
        return $this->hasMany(MonthlyLeaves::class, 'staffid', 'staffid');
    }
    public function distribution()
    {
        return $this->hasMany(Distribution::class, 'staffid');
    }
    public function commissionParcentage()
    {
        return $this->belongsTo(CommisionParcentageModel::class, 'parcentage_id');
    }
    public function ProductStaffAssignedSource()
    {
        return $this->belongsTo(ProductStaffAssignedSourceModel::class, 'staffid');
    }

    public function RaisTicket()
    {
        return $this->hasMany(TicketModel::class);
    }
    public function TicketReminder()
    {
        return $this->hasMany(TicketReminder::class);
    }

    public function salesTargets()
    {
        return $this->hasMany(SalesTarget::class, 'staff_id');
    }


    // public static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($staff) {
    //         if ($staff->isDirty('role')) {
    //             self::syncPermissions($staff);
    //         }
    //     });
    // }

    // public static function syncPermissions($staff)
    // {
    //     $roleId = $staff->role;

    //     // Get all permissions from role_permission
    //     $rolePermissions = RolePermission::where('role_id', $roleId)->get();

    //     if ($rolePermissions->isEmpty()) {
    //         return; // No permissions exist for this role, so do nothing
    //     }
    //     foreach ($rolePermissions as $permission) {
    //         StaffPermission::updateOrCreate(
    //             [
    //                 'staffid'       => $staff->staffid,
    //                 'permission_id' => $permission->permission_id, // Unique key to check for existing entry
    //             ],
    //             [
    //                 'role_id'       => $roleId,
    //                 'can_view'      => $permission->can_view,
    //                 'can_create'    => $permission->can_create,
    //                 'can_edit'      => $permission->can_edit,
    //                 'can_delete'    => $permission->can_delete,
    //             ]
    //         );
    //     }
    // }
}
