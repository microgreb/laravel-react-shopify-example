<?php

if (! function_exists('user')) {
    /**
     * Retrieve current Authenticated User for both Web and Api interfaces
     *
     * @return \App\Models\Users\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user()
    {
        return request()->user();
    }
}
