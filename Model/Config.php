<?php

namespace GhoSter\FacebookComment\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class Config
 * @package GhoSter\FacebookComment\Model
 */
class Config
{
    const CACHE_TAG = 'ghoster_facebookcomment';

    const XML_PATH_ENABLED = 'facebook_comment/general/enable';
    const XML_PATH_TAB_TITLE = 'facebook_comment/general/tab_title';
    const XML_PATH_THEME = 'facebook_comment/general/theme';
    const XML_PATH_APP_ID = 'facebook_comment/general/app_id';
    const XML_PATH_LIMIT_NUM_OF_POST = 'facebook_comment/general/num_posts';
    const XML_PATH_SORT_BY = 'facebook_comment/general/order_by';
    const XML_PATH_LOCALE = 'facebook_comment/general/locale';
    const XML_PATH_SHOW_FACE = 'facebook_comment/general/show_face';

    const DEFAULT_THEME = 'light';
    const DEFAULT_LOCALE = 'en_US';
    const DEFAULT_SORT_BY = 'social';
    const DEFAULT_LIMIT_NUM_OF_POST = 8;
    const DEFAULT_SHOW_FACE = 'true';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /** @var StoreManagerInterface */
    protected $storeManager;

    /** @var Json */
    protected $serialize;


    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param Json $serialize
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        Json $serialize
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->serialize = $serialize;
    }

    public function isEnabled()
    {
        if (!$this->getAppId()) {
            return false;
        }

        return (bool)$this->scopeConfig->getValue(static::XML_PATH_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function getTabTitle()
    {
        $config = $this->scopeConfig->getValue(static::XML_PATH_TAB_TITLE, ScopeInterface::SCOPE_STORE);
        return $config ? $config : __('Facebook Comment');
    }

    public function getTheme()
    {
        $config = $this->scopeConfig->getValue(static::XML_PATH_THEME, ScopeInterface::SCOPE_STORE);
        return $config ? $config : self::DEFAULT_THEME;
    }

    public function getAppId()
    {
        return $this->scopeConfig->getValue(static::XML_PATH_APP_ID, ScopeInterface::SCOPE_STORE);
    }

    public function getLimitPost()
    {
        $config = $this->scopeConfig->getValue(static::XML_PATH_LIMIT_NUM_OF_POST, ScopeInterface::SCOPE_STORE);
        return $config ? $config : self::DEFAULT_LIMIT_NUM_OF_POST;
    }

    public function getSortBy()
    {
        $config = $this->scopeConfig->getValue(static::XML_PATH_LIMIT_NUM_OF_POST, ScopeInterface::SCOPE_STORE);
        return $config ? $config : self::DEFAULT_SORT_BY;
    }

    public function getLocale()
    {
        $config = $this->scopeConfig->getValue(static::XML_PATH_LOCALE, ScopeInterface::SCOPE_STORE);
        return $config ? $config : self::DEFAULT_LOCALE;
    }

    public function getShowFace()
    {
        $isShowFace = (bool)$this->scopeConfig->getValue(static::XML_PATH_SHOW_FACE, ScopeInterface::SCOPE_STORE);
        return $isShowFace ? self::DEFAULT_SHOW_FACE : 'false';
    }
}