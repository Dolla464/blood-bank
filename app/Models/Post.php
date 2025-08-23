<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $photo
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $favoritedBy
 * @property-read int|null $favorited_by_count
 * @property-read mixed $is_favorited
 * @mixin \Eloquent
 */
class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'content',
        'photo',
        'category_id'
    ];

    // add column to model => json or array
    protected $appends = ['is_favorited'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // many clients can favorite many posts
    public function favoritedBy()
    {
        return $this->belongsToMany(Client::class, 'client_post');
    }

    //accessor testing if client logged or not
    protected function isFavorited(): Attribute
    {
        $client = Auth::guard('api')->user();

        if (!$client) {
            return new Attribute(get: fn() => false);
        }

        return new Attribute(
            get: function () use ($client) {
                // Check if the 'favoritedBy' relationship was already eager-loaded
                if($this->relationLoaded('favoritedBy')){
                    //yes check in memory super fast
                    return $this->favoritedBy->contains($client);
                }

                //no safe query
                return $this->favoritedBy()->where('client_id', $client->id)->exists();
            }
        );
    }
}
