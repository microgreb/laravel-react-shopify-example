<?php

namespace App\Models;

/**
 * App\Models\SubmissionDetail
 *
 * @property int $id
 * @property int $submission_id
 * @property string|null $ip
 * @property string|null $country_code
 * @property string|null $region_name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $weather
 * @property float|null $temperature
 * @property float|null $wind_speed
 * @property int|null $pressure
 * @property int|null $humidity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Submission $submission
 * @method static SubmissionDetail whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail wherePressure($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereSubmissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereWeather($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmissionDetail whereWindSpeed($value)
 * @mixin \Eloquent
 */
class SubmissionDetail extends ParentModel
{
    /**
     * @var string
     */
    protected $table = 'submission_details';

    /**
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Submission group leader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
