<?php

namespace GhoSter\FacebookComment\Controller\Comment;

use Magento\Framework\Controller\Result\Json;
use Magento\Backend\Model\View\Result\Page;
use GhoSter\FacebookComment\Controller\Comment;

/**
 * Class ListComment
 * @package GhoSter\FacebookComment\Controller\Comment
 */
class ListComment extends Comment
{
    /**
     * @return Json
     */
    public function execute()
    {
        $result = [
            'success' => true,
            'messages' => [],
        ];
        $this->_product->load($this->getRequest()->getParam('product'));
        $this->_objectManager->get(\Magento\Framework\Registry::class)
            ->register('product', $this->_product);
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $result['block'] = $resultPage->getLayout()->getBlock('facebook.comment.tab')->toHtml();
        /** @var Json $resultJson */
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        return $resultJson->setData($result);
    }
}
