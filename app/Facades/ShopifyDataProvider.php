<?php

namespace App\Facades;

use App\Http\Client\Shopify\ShopifyApiClient;
use Illuminate\Support\Facades\Facade;

/**
 * Class ShopifyDataProvider
 * ShopifyApiClient Facade
 *
 * @package App\Facades
 */
class ShopifyDataProvider extends Facade
{
    /**
     * @return \App\Http\Client\Shopify\ShopifyApiClient|string
     */
    protected static function getFacadeAccessor()
    {
        $accessor = new ShopifyApiClient();
        $accessor->boot();
        
        return $accessor;
    }
}
