<?php

namespace Example\Started\Controller\Example;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class View implements HttpGetActionInterface
{
    private PageFactory $pageFactory;

    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    /**
     * @inheritDoc
     *
     * @link http://start.kyoye.com/started/example/view
     */
    public function execute()
    {
        // 它默认输出当前模块下 `view/frontend/layout`目录下与 Controller 同样位置的布局。
        // 拿这里的`Example\Started\Controller\Example\View`类来说，它可以对应`view/frontend/layout/example/view.xml` 布局文件
        //
        // TODO 假设同时存在本 Controller 和 started_example_view 布局文件，访问 http://start.kyoye.com/started/example/view 时
        // 会响应什么内容？
        return $this->pageFactory->create()->addHandle('started_example_view2');
    }
}
