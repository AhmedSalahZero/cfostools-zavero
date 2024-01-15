<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ToolTipData
 *
 * @property int $id
 * @property string $model_name
 * @property string $section_name
 * @property string|null $field
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData query()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ToolTipData extends Model
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
        'data' => 'array',
    ];
}
