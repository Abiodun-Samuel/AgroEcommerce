<?php

namespace App\Rules;

use App\Models\Admin\Product;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class ProductStockPriceRule implements InvokableRule, DataAwareRule
{

    /**
     * 
     *
     *  @var array
     */
    protected array $data = [];
    /**
     * Run the validation rule.
     * 
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function __invoke($attribute, $value, $fail)
    {
        $products = array_filter($value);
        if (count($products) == 0) {
            $fail('Please select at least one product');
        }
        $DBProducts = Product::find(array_keys($products))->keyBy('id');
        $errorText = '';
        foreach ($products as $productID => $quantity) {
            //check stok
            if ($DBProducts[$productID]->stock < $quantity) {
                $errorText .= 'Sorry, we have only ' . $DBProducts[$productID]->stock . ' of ' . $DBProducts[$productID]->title . ' left in stock.';
            }

            //check price
            if ($DBProducts[$productID]->price != $this->data['price'][$productID]) {
                $errorText .= 'Sorry, the price of ' . $DBProducts[$productID]->title . ' has changed. 
                Old price ' . number_format($this->data['price'][$productID], 2) . '
                new Price ' . number_format($DBProducts[$productID]->price, 2);
            }
        }
        if ($errorText != '') {
            $fail($errorText);
        }
    }
}