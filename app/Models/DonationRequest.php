<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $patient_name
 * @property int $patient_age
 * @property int $blood_type_id
 * @property int $bags_number
 * @property string $hospital_name
 * @property string $latitude
 * @property string $longitude
 * @property int $city_id
 * @property int $client_id
 * @property string $patient_phone
 * @property string $notes
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BloodType $bloodType
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereBagsNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereBloodTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereHospitalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest wherePatientAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest wherePatientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest wherePatientPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereUpdatedAt($value)
 * @property string $hospital_address
 * @method static \Illuminate\Database\Eloquent\Builder|DonationRequest whereHospitalAddress($value)
 * @mixin \Eloquent
 */
class DonationRequest extends Model
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = [
        'patient_name',
        'patient_age',
        'blood_type_id',
        'bags_number',
        'hospital_name',
        'hospital_address',
        'latitude',
        'longitude',
        'city_id',
        'patient_phone',
        'notes',
        'client_id'
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
