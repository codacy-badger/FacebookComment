<?php

namespace GhoSter\FacebookComment\Block\Container;

use Magento\Catalog\Model\Product;
use GhoSter\FacebookComment\Model\Config as FacebookCommentConfig;
use Magento\Framework\View\Element\Template;

class ProductTab extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface
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
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Framework\Data\Form\FormKey
     */
    protected $_formKey;


    /**
     * ProductTab constructor.
     *
     * @param Template\Context $context
     * @param FacebookCommentConfig $config
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\Form\FormKey $formKey
     * @param array $data
     */
   public function __construct(
       Template\Context $context,
       FacebookCommentConfig $config,
       \Magento\Framework\Registry $registry,
       \Magento\Framework\Data\Form\FormKey $formKey,
       array $data = []
   )
   {
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

    public function getTheme()
    {
        return $this->config->getTheme();
    }

    public function isEnabled()
    {
        return $this->config->isEnabled();
    }

    public function getNumberOfPost()
    {
        return $this->config->getLimitPost();
    }

    public function getSortBy()
    {
        return $this->config->getSortBy();
    }

    public function getLocale()
    {
        return $this->config->getLocale();
    }

    public function getShowFace(){
        return $this->config->getShowFace();
    }

    /**
     * Retrieve Product URL using UrlDataObject
     *
     * @param \Magento\Catalog\Model\Product $product
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
     * @param \Magento\Catalog\Model\Product $product
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