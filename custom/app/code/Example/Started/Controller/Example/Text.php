<?php

namespace Example\Started\Controller\Example;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Text implements HttpGetActionInterface
{
    private ResultFactory $resultFactory;

    public function __construct(ResultFactory $resultFactory)
    {
        $this->resultFactory = $resultFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     *
     * @link http://start.kyoye.com/started/example/text
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_RAW)
            ->setContents('<h1>Hello, magento</h1>')
            ->setHeader('Content-Type', 'text/html');
    }
}
