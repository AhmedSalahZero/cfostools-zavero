<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ActiveJob
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $status
 * @property string $model_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob company()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActiveJob extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'active_jobs';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    // Company Scoop
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }
}
