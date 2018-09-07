<?php

namespace App\Observers;

use App\Models\Submission;
use App\Transformers\SubmissionDetailsTransformer;
use Gmopx\LaravelOWM\LaravelOWM;
use Stevebauman\Location\Facades\Location;

/**
 * Class SubmissionObserver
 * Observes Submission Model events
 *
 * @package App\Observers
 */
class SubmissionObserver
{
    /**
     * Handle the Submission "created" event.
     *
     * @param \App\Models\Submission $submission
     * @throws \Exception
     */
    public function created(Submission $submission)
    {
        if (! $submission->lead_by) {
            $this->createSubmissionDetails($submission);
        }
    }

    /**
     * Create Submission Details
     *
     * @param \App\Models\Submission $submission
     * @throws \Exception
     */
    private function createSubmissionDetails(Submission $submission)
    {
        $location = $this->getRequestLocation();

        $weather = $this->getWeather($location->latitude, $location->longitude);

        $submissionDetailsTransformed = (new SubmissionDetailsTransformer())->transform(compact('location', 'weather'));

        $submission->details()->create($submissionDetailsTransformed);
    }

    /**
     * Get Current Request Location
     *
     * @return mixed
     */
    private function getRequestLocation()
    {
        $ip = request()->ip();
        $location = Location::get($ip);
        $location->ip = $ip;

        return $location;
    }

    /**
     * Get Current Weather
     *
     * @param float $lat
     * @param float $lon
     * @return \Cmfcmf\OpenWeatherMap\CurrentWeather
     * @throws \Exception
     */
    public function getWeather(float $lat, float $lon)
    {
        $weatherProvider = new LaravelOWM();

        return $weatherProvider->getCurrentWeather(compact('lat', 'lon'));
    }
}
