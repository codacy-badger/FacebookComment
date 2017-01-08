<?php
/**
 * GhoSter FacebookComment
 *
 * @package        GhoSter_FacebookComment
 * @author         GhoSter
 * @copyright      Copyright (c) 2016, GhoSter Inc<thinghost.info>. All rights reserved
 */

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
