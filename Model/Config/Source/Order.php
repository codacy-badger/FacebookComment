<?php

namespace GhoSter\FacebookComment\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Order
 * @package GhoSter\FacebookComment\Model\Config\Source
 */
class Order implements ArrayInterface
{

    /**
     * Return array for select field
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'social' => __('Highest quality comments(Default)'),
            'reverse_time' => __('Newest comments at the top'),
            'time' => __('Oldest comments at the top')
        ];
    }
}
