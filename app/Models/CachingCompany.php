<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CachingCompany
 *
 * @property int $id
 * @property int $company_id
 * @property int $job_id
 * @property string $key_name
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereKeyName($value)
 * @mixin \Eloquent
 */
class CachingCompany extends Model
{
    // use HasFactory;
    protected $guarded =  ['id'] ; 
    public $timestamps = false ; 
    protected $table = 'caching_company';
    
}
