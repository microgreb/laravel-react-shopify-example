<?php

namespace App\Models;

/**
 * App\Models\Submission
 *
 * @property int $id
 * @property string $full_name
 * @property string $phone
 * @property int|null $lead_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SubmissionDetail $details
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Submission[] $submissions
 * @property-read \App\Models\Submission|null $submitted_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereLeadBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Submission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Submission extends ParentModel
{
    /**
     * @var string
     */
    protected $table = 'submissions';

    /**
     * @var array
     */
    protected $fillable = [
        'full_name',
        'phone',
        'country_code',
    ];

    /**
     * Children Submissions relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'lead_by');
    }

    /**
     * Submission group leader relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submitted_by()
    {
        return $this->belongsTo(Submission::class, 'lead_by');
    }

    /**
     * Submission Details relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details()
    {
        return $this->hasOne(SubmissionDetail::class);
    }
}
