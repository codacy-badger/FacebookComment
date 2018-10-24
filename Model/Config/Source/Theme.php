<?php
namespace GhoSter\FacebookComment\Model\Config\Source;

class Theme implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * Return array for select field
     *
     * @return array
     */
    public function toOptionArray()
    {
        return ['light' => 'Light', 'dark' => 'Dark'];
    }
}
