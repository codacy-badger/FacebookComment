<?php

namespace GhoSter\FacebookComment\Block\Container;

use Magento\Catalog\Model\Product;
use GhoSter\FacebookComment\Model\Config as FacebookCommentConfig;
use Magento\Framework\View\Element\Template;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Registry;
use Magento\Framework\Data\Form\FormKey;

/**
 * Class ProductTab
 * @package GhoSter\FacebookComment\Block\Container
 */
class ProductTab extends Template implements IdentityInterface
{
    /** @var FacebookCommentConfig */
    protected $config;

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
     * ProductTab constructor.
     *
     * @param Template\Context $context
     * @param FacebookCommentConfig $config
     * @param Registry $registry
     * @param FormKey $formKey
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        FacebookCommentConfig $config,
        Registry $registry,
        FormKey $formKey,
        array $data = []
    ) {
        $this->config = $config;
        $this->_coreRegistry = $registry;
        $this->_formKey = $formKey;
        parent::__construct($context, $data);
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

    public function getFacebookCommentConfig(): FacebookCommentConfig
    {
        return $this->config;
    }

    /**
     * Retrieve Product URL using UrlDataObject
     *
     * @param Product $product
     * @param array $additional the route params
     * @return string
     */
    public function getProductUrl($product, $additional = [])
    {
        if ($this->hasProductUrl($product)) {
            if (!isset($additional['_escape'])) {
                $additional['_escape'] = true;
            }
            return $product->getUrlModel()->getUrl($product, $additional);
        }

        return '#';
    }

    /**
     * Check Product has URL
     *
     * @param Product $product
     * @return bool
     */
    public function hasProductUrl($product)
    {
        if ($product->getVisibleInSiteVisibilities()) {
            return true;
        }
        if ($product->hasUrlDataObject()) {
            if (in_array($product->hasUrlDataObject()->getVisibility(), $product->getVisibleInSiteVisibilities())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [
            FacebookCommentConfig::CACHE_TAG,
        ];
    }
}