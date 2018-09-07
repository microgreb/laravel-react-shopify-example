<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

/**
 * Data formatter
 *
 * Class ShopifyCustomerSimpleTransformer
 *
 * @package App\Transformers
 */
class ShopifyCustomerSimpleTransformer extends TransformerAbstract
{
    /**
     * Transform
     *
     * @param $customer
     * @return array
     */
    public function transform($customer)
    {
        return [
            'id' => (int) $customer->id,
            'full_name' => (string) $customer->first_name . ' ' . $customer->last_name,
            'phone' => (string) $customer->default_address->phone,
        ];
    }
}
