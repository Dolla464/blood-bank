<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DonationRequest> $donationRequests
 * @property-read int|null $donation_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class BloodType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Post> $posts
 * @property-read int|null $posts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $governorate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DonationRequest> $donationRequests
 * @property-read int|null $donation_requests_count
 * @property-read \App\Models\Governorate $governorate
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @method static \Illuminate\Database\Eloquent\Builder|City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereGovernorateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|City whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
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
 * @property string $status
 * @property-read mixed $can_donate
 * @property-read mixed $can_donate_badge
 * @property-read mixed $next_donation_date
 * @method static \Illuminate\Database\Eloquent\Builder|Client whereStatus($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $subject
 * @property string $message
 * @property int $client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 */
	class DonationRequest extends \Eloquent {}
}

namespace App\Models{
/**
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
	class Governorate extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $message
 * @property int $donation_request_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Client> $clients
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereDonationRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
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
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
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
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $profile_image
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfileImage($value)
 */
	class User extends \Eloquent {}
}

