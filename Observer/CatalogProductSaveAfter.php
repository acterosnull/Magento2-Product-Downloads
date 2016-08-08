<?php

namespace Sebwite\ProductDownloads\Observer;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Registry;
use Sebwite\ProductDownloads\Model\Upload;

/**
 * Class:Observer
 * Sebwite\ProductDownloads\Model\Adminhtml\Download
 *
 * @author      Sebwite
 * @package     Sebwite\ProductDownloads
 * @copyright   Copyright (c) 2015, Sebwite. All rights reserved
 */
class CatalogProductSaveAfter implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;


    /**
     * @var \Sebwite\ProductDownloads\Model\Upload
     */
    protected $upload;


    /**
     * @var \Magento\Backend\App\Action\Context
     */
    protected $context;


    public function __construct(Registry $coreRegistry, Upload $upload, Context $context)
    {
        $this->coreRegistry = $coreRegistry;
        $this->upload = $upload;
        $this->context = $context;
    }


    /**
     * Saves uploaded files, and assigns them to product
     *
     * @param EventObserver $observer
     *
     * @return $this
     */
    public function execute(EventObserver $observer)
    {
        /* @var \Magento\Framework\App\Request\Http $request */
        $request = $this->context->getRequest();
        $downloads = $request->getFiles('downloads', -1);
        #\Zend_Debug::dump($downloads); die(__FILE__." line ".__LINE__);

        if ($downloads != -1)
        {
            // Get current product
            /* @var \Magento\Catalog\Model\Product $product */
            $product   = $this->coreRegistry->registry('product');
            $productId = $product->getId();

            // Loop through uploaded downloads
            foreach ($downloads as $download)
            {
                // Get uploaded file
                $uploadedDownload = $this->upload->uploadFile($download);

                // Store data in database
                if ($uploadedDownload)
                {
                    $objectManager = $this->context->getObjectManager();
                    /* @var \Sebwite\ProductDownloads\Model\Download $download */
                    $download = $objectManager->create('Sebwite\ProductDownloads\Model\Download');
                    $download->setDownloadUrl($uploadedDownload['file']);
                    $download->setDownloadFile($uploadedDownload['name']);
                    $download->setDownloadType($uploadedDownload['type']);
                    $download->setProductId($productId);
                    $download->save();
                }
            }
        }

        return $this;
    }
}
