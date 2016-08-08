<?php

namespace Sebwite\ProductDownloads\Component\Form\Element;

class File extends \Magento\Ui\Component\Form\Element\AbstractElement
{
    const NAME = 'file';

    /**
     * {@inheritdoc}
     */
    public function getComponentName()
    {
        return static::NAME;
    }
}