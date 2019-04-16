<?php

namespace GhoSter\FacebookComment\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Magento\PageCache\Model\Config as PageCacheConfig;
use Magento\Framework\Data\Form\FormKey;
use GhoSter\FacebookComment\Model\Config as FacebookCommentConfig;

/**
 * Class Container
 * @package GhoSter\FacebookComment\Block
 */
class Container extends Template
{

    /** @var FacebookCommentConfig */
    protected $config;

    /**
     * @var PageCacheConfig
     */
    protected $_pageCacheConfig;

    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var FormKey
     */
    protected $_formKey;

    /**
     * @param Context $context
     * @param FacebookCommentConfig $config
     * @param Registry $registry
     * @param PageCacheConfig $pageCacheConfig
     * @param FormKey $formKey
     * @param array $data
     */
    public function __construct(
        Context $context,
        FacebookCommentConfig $config,
        PageCacheConfig $pageCacheConfig,
        FormKey $formKey,
        Registry $registry,
        array $data = []
    ) {
        $this->_pageCacheConfig = $pageCacheConfig;
        $this->config = $config;
        $this->_coreRegistry = $registry;
        $this->_formKey = $formKey;
        parent::__construct($context, $data);

        if ($this->config) {
            $this->setTabTitle();
            $this->setTabSortOrder();
        }
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->_pageCacheConfig->isEnabled()) {
            return $this->getChildHtml();
        }
        return parent::_toHtml();
    }


    /**
     * @return $this|mixed
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    /**
     * Url of Ajax Request while processing under Full page cache
     *
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('fbcomment/comment/listcomment', [
            'product' => $this->getProduct()->getId(),
            '_secure' => $this->_request->isSecure()
        ]);
    }

    /**
     * Set Facebook Tab order
     * @return mixed
     */
    public function setTabSortOrder()
    {
        if ($this->getData('sort_order') == null) {
            return $this->setData('sort_order', 100);
        }

        return $this;
    }

    /**
     * Set Facebook Tab title
     * @return Container
     */
    public function setTabTitle()
    {
        if ($this->config->getTabTitle() !== null) {
            return $this->setData('title', $this->config->getTabTitle());
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getFormKey()
    {
        return $this->_formKey->getFormKey();
    }
}