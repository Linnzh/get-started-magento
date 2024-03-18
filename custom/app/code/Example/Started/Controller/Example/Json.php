<?php

namespace Example\Started\Controller\Example;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class Json implements HttpGetActionInterface
{
    private JsonFactory $jsonFactory;

    public function __construct(JsonFactory $jsonFactory)
    {
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface
     *
     * @link http://start.kyoye.com/started/example/json
     *
     * @link https://developer.adobe.com/commerce/php/development/components/routing/
     */
    public function execute()
    {
        return $this->jsonFactory->create()->setData(
            [
                'class' => __CLASS__,
                'method' => __METHOD__,
            ]
        );
    }
}
