<?php

namespace App\Models;

use App\Traits\StaticBoot;
use Illuminate\Database\Eloquent\Model;

class UploadSupplierInvoice extends Model
{
    use StaticBoot;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];


    //  protected $connection= 'mysql2';
    // protected $table = 'sales_gathering';
    // protected $primaryKey  = 'user_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'upload_supplier_invoices';
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id?? Request('company_id') );
    }
}
