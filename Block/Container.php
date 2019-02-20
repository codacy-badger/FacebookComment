<?php

namespace GhoSter\FacebookComment\Block;

use Magento\Catalog\Model\Product;
use GhoSter\FacebookComment\Model\Config as FacebookCommentConfig;

class Container extends \Magento\Framework\View\Element\Template
{

    /** @var FacebookCommentConfig */
    protected $config;

    /**
     * @var \Magento\PageCache\Model\Config
     */
    protected $_pageCacheConfig;

    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $_formKey;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param FacebookCommentConfig $config
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\PageCache\Model\Config $pageCacheConfig
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        FacebookCommentConfig $config,
        \Magento\PageCache\Model\Config $pageCacheConfig,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->_pageCacheConfig = $pageCacheConfig;
        $this->config = $config;
        $this->_coreRegistry = $registry;
        $this->_formKey = $formKey;
        parent::__construct($context, $data);

        if ($this->config) {
            $this->setTitle($this->config->getTabTitle());
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
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    public function getAjaxUrl()
    {
        return $this->getUrl('fbcomment/comment/commentlist', [
            'product' => $this->getProduct()->getId(),
            '_secure' => $this->_request->isSecure()
        ]);
    }

    /**
     * @return string
     */
    public function getFormKey()
    {
        return $this->_formKey->getFormKey();
    }
}