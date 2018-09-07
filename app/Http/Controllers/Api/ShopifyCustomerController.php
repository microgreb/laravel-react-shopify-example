<?php

namespace App\Http\Controllers\Api;

use App\Facades\ShopifyDataProvider;
use App\Http\Controllers\Controller;
use App\Transformers\ShopifyCustomerSimpleTransformer;
use Spatie\Fractal\FractalFacade;

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

    /**
     * Get All Customers, Full Name & Phone only.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getCustomersSimplified()
    {
       return FractalFacade::collection(ShopifyDataProvider::getCustomers())->transformWith(new ShopifyCustomerSimpleTransformer())->toArray();
    }
}
