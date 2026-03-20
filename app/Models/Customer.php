<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Customer extends User
{
    use HasFactory;

    protected $table = 'tblleads';

    protected $fillable = [
        'name',
        'dob',
        'gender',
        'company',
        'email',
        'country_id',
        'state',
        'state_id',
        'city',
        'lead_tag',
        'phonenumber',
        'alternative_mobile',
        'designation',
        'pin_code',
        'district',
        'address',
        'landmark',
        'web_url',
        'instagram',
        'package_id',
        'twitter',
        'facebook',
        'linkedin',
        'profile_image',
        'user_type',
        'dateadded',
        'source',
        'assigned',
        'gst_no',
        'employee_count',
        'annual_turnoer',
        'company_establish_date',
        'working_day',
        'payment_mode',
        'signup_token',
        'lead_products',
        'follow_up_date',
        'is_follow_up',
        'is_readed',
        'ho_leadtype',
        'email_verified',
        'phone_verified',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'customer_id');
    }

    public function productEnquiries()
    {
        return $this->hasMany(ProductEnquiry::class, 'sender_id'); // Adjust 'customer_id' to your actual foreign key
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id'); // Adjust the model name if needed
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function buyleadEnquiry()
    {
        return $this->hasMany(BuyleadEnquiry::class);
    }

    public function postbyrequirements()
    {
        return $this->hasMany(Postrequirment::class);
    }

    public function project()
    {
        return $this->hasMany(Projects::class, 'clientid');
    }
    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function leadssources()
    {
        return $this->belongsTo(LeadSource::class, 'source');
    }
    public function leadproducts()
    {
        return $this->belongsTo(ItemGroup::class, 'lead_products');
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'assigned', 'staffid');
    }
    //for remark tracking report
    public function staffs()
    {
        return $this->belongsTo(Staff::class, 'assigned', 'staffid');
    }
    //END for remark tracking report
    public function requestStaff()
    {
        return $this->belongsTo(Staff::class, 'request_staff_id', 'staffid');
    }
    public function leadstatus()
    {
        return $this->belongsTo(LeadStatus::class, 'status');
    }

    public function documentupload()
    {
        return $this->hasMany(DocumentsUpload::class, 'lead_id');
    }

    public function CustomerAddGroup()
    {
        return $this->hasMany(CustomerAddGroup::class, 'lead_id');
    }

    public function buyerinformation()
    {
        return $this->belongsTo(BuyerInformationModel::class, 'lead_id'); // Adjust the foreign key if needed
    }
    public function supplierinformation()
    {
        return $this->belongsTo(SupplierInformationModel::class, 'lead_id'); // Adjust the foreign key if needed
    }
    public function assignedStaff()
    {
        return $this->belongsTo(Staff::class, 'assigned', 'staffid');
    }
}
