<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $phone
 * @property string $email
 * @property string $fb_url
 * @property string $x_url
 * @property string $insta_url
 * @property string $youtube_url
 * @property string $about_app
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereAboutApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereFbUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereInstaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereXUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereYoutubeUrl($value)
 * @mixin \Eloquent
 */
class Settings extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = [
        'phone',
        'email',
        'fb_url',
        'x_url',
        'insta_url',
        'youtube_url',
        'about_app'
    ];
}
