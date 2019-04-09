<?php

namespace GhoSter\FacebookComment\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Theme
 * @package GhoSter\FacebookComment\Model\Config\Source
 */
class Theme implements ArrayInterface
{

    /**
     * Return array for select field
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            'light' => 'Light',
            'dark' => 'Dark'
        ];
    }
}
