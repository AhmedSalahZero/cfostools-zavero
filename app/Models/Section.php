<?php

namespace App\Models;
use App\Traits\StaticBoot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Section
 *
 * @property int $id
 * @property array $name
 * @property string $sub_of
 * @property string $icon
 * @property string|null $route
 * @property int $order
 * @property int $trash
 * @property string $section_side
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $route_name
 * @property-read Section $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Section[] $subSections
 * @property-read int|null $sub_sections_count
 * @method static Builder|Section mainClientSideSections()
 * @method static Builder|Section mainSections()
 * @method static Builder|Section mainSuperAdminSections()
 * @method static Builder|Section newModelQuery()
 * @method static Builder|Section newQuery()
 * @method static \Illuminate\Database\Query\Builder|Section onlyTrashed()
 * @method static Builder|Section query()
 * @method static Builder|Section whereCreatedAt($value)
 * @method static Builder|Section whereCreatedBy($value)
 * @method static Builder|Section whereDeletedAt($value)
 * @method static Builder|Section whereIcon($value)
 * @method static Builder|Section whereId($value)
 * @method static Builder|Section whereName($value)
 * @method static Builder|Section whereOrder($value)
 * @method static Builder|Section whereRoute($value)
 * @method static Builder|Section whereSectionSide($value)
 * @method static Builder|Section whereSubOf($value)
 * @method static Builder|Section whereTrash($value)
 * @method static Builder|Section whereUpdatedAt($value)
 * @method static Builder|Section whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Section withoutTrashed()
 * @mixin \Eloquent
 */
class Section extends Model
{
     use SoftDeletes,StaticBoot;
    protected $guarded = [];
    protected $casts = ['name' => 'array'];

    // protected $with = [
    //     'subSections'
    // ];

    // protected static function booted()
    // {
    //     static::addGlobalScope('sub_of', function (Builder $builder) {
    //         $builder->where('sub_of',0);
    //     });
    // }
    public function scopeMainSections($query)
    {
        return $query->where('sub_of',0);
    }

    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */
    public function getRouteNameAttribute()
    {
        $route = $this->route;
        $route_array = explode('.',$route);
        $route = $route_array[0];
        return $route;
    }
    public function scopeMainClientSideSections($query)
    {
        return $query->where('sub_of',0)->where('section_side','client')->where('trash',0);
    }
    public function scopeMainSuperAdminSections($query)
    {
        return $query->where('sub_of',0)->where('section_side','admin')->where('trash',0);
    }
    public function parent()
    {
        return $this->belongsTo(Section::class, 'sub_of', 'id');
    }
    public function subSections()
    {
        return $this->hasMany(Section::class, 'sub_of', 'id')->where('trash',0);
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branches_sections');
    }
}
