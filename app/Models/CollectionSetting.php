<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CollectionSetting
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $collection_base
 * @property array|null $general_collection
 * @property array|null $first_allocation_collection
 * @property array|null $second_allocation_collection
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting company()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCollectionBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereFirstAllocationCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereGeneralCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereSecondAllocationCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CollectionSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collection_settings';
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
        'general_collection' => 'array',
        'first_allocation_collection' => 'array',
        'second_allocation_collection' => 'array',
    ];
    // Company Scoop
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }
}
