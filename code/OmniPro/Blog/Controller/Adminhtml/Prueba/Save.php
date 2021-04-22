<?php
namespace OmniPro\Blog\Controller\Adminhtml\Prueba;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'OmniPro_Blog::new';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \OmniPro\Blog\Api\Data\BlogInterfaceFactory
     */
    private $blogInterfaceFactory;

    /**
     * @param \OmniPro\Blog\Api\BlogRepositoryInterface
     */
    private $blogRepository;

    /**
     * @param \Magento\Framework\App\Request\DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @param \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \OmniPro\Blog\Api\Data\BlogInterfaceFactory $blogInterfaceFactory,
        \OmniPro\Blog\Api\BlogRepositoryInterface $blogRepository,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->blogInterfaceFactory = $blogInterfaceFactory;
        $this->blogRepository = $blogRepository;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if($data) {
            $blog = $this->blogInterfaceFactory->create();
            $id = $this->getRequest()->getParam('id');
            if($id) {
                try {
                    $blog = $this->blogRepository->getById($id);
                } catch (NoSuchEntityException $e) {

                }
    }
    $blog->setTitle($data['title']);
    $blog->setEmail($data['email']);
    $blog->setContent($data['content']);

    try {
        $this->blogRepository->save($blog);
        $this->messageManager->addSuccessMessage(__("El blog ha sido guardado exitosamente"));
        $this->dataPersistor->clear('omnipro_blog_blogitem');
    } catch (LocalizedException $e) {
        $this->messageManager->addErrorMessage($e->getMessage());
    } catch (\Exception $e) {
        $this->messageManager->addExceptionMessage($e, __("Ha ocurrido un error al guardar el blog"));
    }
}
return $resultRedirect->setPath('*/*/index');
}

/**
* Is the user allowed to view the page.
*
* @return bool
*/
protected function _isAllowed()
{
return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
}
}
