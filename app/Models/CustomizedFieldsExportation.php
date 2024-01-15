<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CustomizedFieldsExportation
 *
 * @property int $id
 * @property array $fields
 * @property string $model_name
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation company()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CustomizedFieldsExportation extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fields' => 'array',
    ];

    // Company Scoop
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }
}
