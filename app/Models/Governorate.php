<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\City> $cities
 * @property-read int|null $cities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Governorate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Governorate extends Model 
{

    protected $table = 'governorates';
    protected $fillable = ['name'];
    public $timestamps = true;

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_governorate');
    }

}