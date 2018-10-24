<?php

namespace GhoSter\FacebookComment\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Store\Model\ScopeInterface;

class ProductTab extends AbstractProduct
{

    const DEFAULT_THEME = 'light';
    const DEFAULT_LOCALE = 'en_US';
    const DEFAULT_ORDER_BY = 'social';
    const DEFAULT_NUM_OF_POST = 8;

    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    protected $_config;


    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_config = $context->getScopeConfig();
    }


    /**
     *  Before rendering html, but after trying to load cache
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    protected function _beforeToHtml()
    {
        if ($this->_config->getValue('facebook_comment/general/enable', ScopeInterface::SCOPE_STORE)) {
            $this->setTemplate('facebook_comment/product_tab.phtml');
            if (!empty($this->_config->getValue('facebook_comment/general/tab_title'))) {
                $this->setProductTabTitle();
            }
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
        $this->setData('title', __($this->_config->getValue('facebook_comment/general/tab_title', ScopeInterface::SCOPE_STORE)));
    }

    public function getTheme()
    {
        return $this->_config->getValue('facebook_comment/general/theme', ScopeInterface::SCOPE_STORE) ?
            $this->_config->getValue('facebook_comment/general/theme', ScopeInterface::SCOPE_STORE) : self::DEFAULT_THEME;
    }

    public function getAppId()
    {
        return $this->_config->getValue('facebook_comment/general/app_id', ScopeInterface::SCOPE_STORE);
    }

    public function getNumberOfPost()
    {
        return $this->_config->getValue('facebook_comment/general/num_posts', ScopeInterface::SCOPE_STORE) ?
            $this->_config->getValue('facebook_comment/general/num_posts', ScopeInterface::SCOPE_STORE) : self::DEFAULT_NUM_OF_POST;
    }

    public function getOrderBy()
    {
        return $this->_config->getValue('facebook_comment/general/order_by', ScopeInterface::SCOPE_STORE) ?
            $this->_config->getValue('facebook_comment/general/order_by', ScopeInterface::SCOPE_STORE) : self::DEFAULT_ORDER_BY;
    }

    public function getLocale()
    {
        return $this->_config->getValue('facebook_comment/general/locale', ScopeInterface::SCOPE_STORE) ?
            $this->_config->getValue('facebook_comment/general/locale', ScopeInterface::SCOPE_STORE) : self::DEFAULT_LOCALE;
    }
}