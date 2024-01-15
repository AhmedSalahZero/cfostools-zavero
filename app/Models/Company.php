<?php

namespace App\Models;

use App\Interfaces\Models\IHaveIdentifier;
use App\Interfaces\Models\IHaveName;
use App\Traits\StaticBoot;
// use AppModels\Interfaces\Models\IHaveCompany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Company
 *
 * @property int $id
 * @property array $name
 * @property string $sub_of
 * @property string $type
 * @property int $users_number
 * @property int|null $companies_number
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Company[] $RevenueBusinessLines
 * @property-read int|null $revenue_business_lines_count
 * @property-read mixed $branches_with_sections
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Company[] $subCompanies
 * @property-read int|null $sub_companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompaniesNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSubOf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUsersNumber($value)
 * @mixin \Eloquent
 */
class Company extends Model implements HasMedia , IHaveIdentifier , IHaveName
{
    use
    //  SoftDeletes,
    StaticBoot,InteractsWithMedia;
    protected $guarded = [];
    protected $casts = ['name' => 'array'];
    public function getIdentifier():int|string
    {
        return $this->{$this->getRouteKeyName()};
    }
    public function getId()
    {
        return $this->getIdentifier();
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'companies_users');
    }
    public function subCompanies()
    {
        return $this->hasMany(Company::class, 'sub_of');
    }
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function getBranchesWithSectionsAttribute()
    {
        $branches = [];
        foreach ($this->branches as  $branch) {
            @count($branch->sections) == 0 ?: array_push($branches,$branch);
        }


        return $branches;
    }

    public function exportableModelFields($modelName)
    {
        return $this->hasOne(CustomizedFieldsExportation::class)->where('model_name',$modelName);
    }
    public function RevenueBusinessLines():HasMany
    {
        return $this->hasMany(Company::class ,'company_id','id');
    }
    public function getName():string{
        return $this->name[App()->getLocale()];
    }
    
}

