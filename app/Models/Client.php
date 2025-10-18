<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $password
 * @property string $email
 * @property string $date_of_birth
 * @property int $blood_type_id
 * @property int $city_id
 * @property string|null $last_donation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $reset_code
 * @property string|null $reset_code_expires_at
 * @property-read \App\Models\BloodType $bloodType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BloodType> $bloodTypes
 * @property-read int|null $blood_types_count
 * @property-read \App\Models\City $city
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DonationRequest> $donationRequests
 * @property-read int|null $donation_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Governorate> $governorates
 * @property-read int|null $governorates_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $messages
 * @property-read int|null $messages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereBloodTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereLastDonationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereResetCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereResetCodeExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereUpdatedAt($value)
 * @property string|null $device_token
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $favorites
 * @property-read int|null $favorites_count
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereDeviceToken($value)
 * @mixin \Eloquent
 */
class Client extends Authenticatable
{
    use HasApiTokens, Notifiable, HasFactory;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'phone',
        'password',
        'email',
        'status',
        'date_of_birth',
        'blood_type_id',
        'last_donation_date',
        'city_id',
        'api_token',
        'reset_code',
        'reset_code_expires_at',
    ];

    //check last donation date if null return ligal if there is date check if this date passed 3 months
    public function getCanDonateAttribute ()
    {
        if (!$this->last_donation_date){
            return true;
        }

        //convert date from db to object to deal with add subtract --- lte = less than or equal now
        return Carbon::parse($this->last_donation_date)->addMonths(3)->lte(now());
    }

    public function getNextDonationDateAttribute(){
        if (!$this->last_donation_date){
            return null;
        }

        return Carbon::parse($this->last_donation_date)->addMonths(3);
    }

    //return badge 
    public function getCanDonateBadgeAttribute()
    {
        if ($this->can_donate) {
            return '<span class="badge badge-success">Eligible</span>';
        }

        return '<span class="badge badge-danger" data-toggle="tooltip" title="Next donation date: '
        . $this->next_donation_date->format('Y-m-d') . '">
        Not Eligible
        </span>';
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    //for favorite posts
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'client_post');
    }

    public function messages()
    {
        return $this->hasMany(Contact::class);
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class)->withPivot('is_read')
            ->withTimestamps();
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    public function governorates()
    {
        return $this->belongsToMany(Governorate::class, 'client_governorate');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany(BloodType::class, 'blood_type_client');
    }

    /**
     * Specifies the user's FCM tokens
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->getDeviceTokens();
    }

    /**
     * Get the device tokens for the client
     * 
     * @return array
     */
    public function getDeviceTokens(): array
    {
        return $this->tokens()->pluck('fcm_token')->toArray();
    }
}
