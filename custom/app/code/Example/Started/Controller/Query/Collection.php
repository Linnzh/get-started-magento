<?php

namespace Example\Started\Controller\Query;

use Magento\Catalog\Model\ResourceModel\Category\Collection\Factory as CategoryCollectionFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class Collection implements HttpGetActionInterface
{

    private JsonFactory $jsonFactory;

    private CategoryCollectionFactory $categoryCollectionFactory;

    public function __construct(JsonFactory $jsonFactory, CategoryCollectionFactory $categoryCollectionFactory)
    {
        $this->jsonFactory = $jsonFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    /**
     * @todo 为何 addFieldToSelect() 方法未生效？
     *
     * Execute action based on request and return result
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $collection = $this->categoryCollectionFactory->create();
        $res = $collection
            ->removeAllFieldsFromSelect()
            ->setPage(1, 20)
            ->addFieldToSelect(['entity_id', 'path'])
            ->exportToArray();
        return $this->jsonFactory->create()->setData($res);
    }
}
