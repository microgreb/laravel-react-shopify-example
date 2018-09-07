<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Data formatter
 *
 * Class SubmissionDetailsTransformer
 *
 * @package App\Transformers
 */
class SubmissionDetailsTransformer extends TransformerAbstract
{
    /**
     * Transform
     *
     * @param $submissionDetails
     * @return array
     */
    public function transform($submissionDetails)
    {

        $data = [

            // Location
            'ip' => (string) $submissionDetails['location']->ip ?? null,
            'country_code' => (string) $submissionDetails['location']->countryCode ?? null,
            'region_name' => (string) $submissionDetails['location']->regionName ?? null,
            'latitude' => (float) $submissionDetails['location']->latitude ?? null,
            'longitude' => (float) $submissionDetails['location']->longitude ?? null,

            // Weather
            'weather' => (string) $submissionDetails['weather']->weather->description ?? 'Unknown',
            'temperature' => $submissionDetails['weather']->temperature->now->getValue() ?? '',
            'wind_speed' => (float) $submissionDetails['weather']->wind->speed->getValue() ?? '',
            'pressure' => (integer) $submissionDetails['weather']->pressure->getValue() ?? '',
            'humidity' => (float) $submissionDetails['weather']->humidity->getValue() ?? '',

        ];

        return $data;
    }
}
