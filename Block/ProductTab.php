<?php
/**
 * GhoSter FacebookComment
 *
 * @package        GhoSter_FacebookComment
 * @author         GhoSter
 * @copyright      Copyright (c) 2016, GhoSter Inc<thinghost.info>. All rights reserved
 */

namespace GhoSter\FacebookComment\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;


class ProductTab extends AbstractProduct {

    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    protected $_config;


    public function __construct(Context $context, array $data = []) {
        parent::__construct($context, $data);

        $this->_config = $context->getScopeConfig();
        $this->setProductTabTitle();
    }


    /**
     *  Before rendering html, but after trying to load cache
     *
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    protected function _beforeToHtml()
    {
        $_isEnabled = $this->_config->getValue('facebook_comment/general/enable');
        if ($_isEnabled) {
            $this->setTemplate('facebook_comment/product_tab.phtml');
            $this->setColorSchema();
        } else {
            $this->getLayout()->unsetElement('facebook.comment.tab');
        }

        return parent::_beforeToHtml();
    }

    /**
     * Set product tab title
     *
     * @return void
     */
    public function setProductTabTitle()
    {
        if($this->_config->getValue('facebook_comment/general/tab_title')){
            $this->setData('title', __($this->_config->getValue('facebook_comment/general/tab_title')));
        } else {
            $this->setData('title', __('Facebook Comment'));

        }
    }

    /**
     * Set Color Schema Theme
     *
     * @return void
     */
    public function setColorSchema(){

        $color = $this->_config->getValue('facebook_comment/general/facebook_theme');
        $this->setData('theme', $color);

    }
}