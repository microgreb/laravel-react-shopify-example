<?php

namespace App\Http\Controllers\Api;

use App\Facades\ShopifyDataProvider;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShopifyCustomer;
use App\Http\Resources\ShopifyCustomers as ShopifyCustomerResource;

/**
 * Class ShopifyCustomerController
 *
 * @package App\Http\Controllers\Api
 */
class ShopifyCustomerController extends Controller
{
    /**
     * Get All Customers
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCustomers()
    {
        return ShopifyDataProvider::getCustomers();
    }
}
