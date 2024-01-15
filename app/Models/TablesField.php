<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TablesField
 *
 * @property int $id
 * @property string|null $model_name
 * @property string|null $field_name
 * @property string|null $view_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField query()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereViewName($value)
 * @mixin \Eloquent
 */
class TablesField extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
