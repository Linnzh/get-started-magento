<?php


namespace Example\StartedGraphQl\Model\Resolver;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class GetCategoryById implements ResolverInterface
{
    private CategoryRepositoryInterface $categoryRepository;
    private ValueFactory $valueFactory;

    public function __construct(CategoryRepositoryInterface $categoryRepository, ValueFactory $valueFactory)
    {
        $this->categoryRepository = $categoryRepository;
        $this->valueFactory = $valueFactory;
    }

    /**
     * Fetches the data from persistence models and format it according to the GraphQL schema.
     *
     * @param \Magento\Framework\GraphQl\Config\Element\Field $field
     * @param ContextInterface|\Magento\GraphQl\Model\Query\Resolver\Context $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     *
     * @return Value
     * @throws \Exception
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $categoryId = $args['id'];
        if (empty($categoryId)) {
            throw new GraphQlInputException(__("Category ID is not allow empty."));
        }

        // 获取当前 Store
        $storeId = $context->getExtensionAttributes()->getStore()->getId();

        try {
            $category = $this->categoryRepository->get($categoryId, $storeId);
        } catch (\Throwable $e) {
            return null;
        }

        // 格式化返回结果
        return $this->valueFactory->create(function () use ($category) {
            return $category;
        });
    }
}
