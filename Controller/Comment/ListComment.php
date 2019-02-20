<?php

namespace GhoSter\FacebookComment\Controller\Comment;

use GhoSter\FacebookComment\Controller\Comment;

class ListComment extends Comment
{
    /**
     * @return \Magento\Framework\Controller\Result\Json
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
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $result['block'] = $resultPage->getLayout()->getBlock('facebook.comment.tab')->toHtml();
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        return $resultJson->setData($result);
    }
}
