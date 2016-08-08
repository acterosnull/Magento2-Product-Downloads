<?php

namespace Sebwite\ProductDownloads\Ui\DataProvider\Product\Form\Modifier;

class Downloads extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    /**
     * {@inheritdoc}
     */
    public function modifyMeta(array $meta)
    {
        #\Zend_Debug::dump($meta); die(__FILE__." line ".__LINE__);

        // Initialise fieldset
        $downloadsFieldset = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'componentType' => \Magento\Ui\Component\Form\Fieldset::NAME,
                        'label' => __('Downloads'),
                        'sortOrder' => 50,
                        'collapsible' => true
                    ]
                ]
            ],
            'children' => []
        ];

        // Add form fields
        for($i = 0; $i < 10; $i++)
        {
            $fieldNumber = $i + 1;
            $fieldName   = "product_download_{$fieldNumber}";
            $downloadsFieldset['children'][$fieldName] = [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'formElement' => \Sebwite\ProductDownloads\Component\Form\Element\File::NAME,
                            'componentType' => \Magento\Ui\Component\Form\Field::NAME,
                            'visible' => 1,
                            'required' => 0,
                            'label' => __("File #{$fieldNumber}"),
                            'name' => "line_".__LINE__,
                            'inputName' => "line_".__LINE__,
                            'elementName' => "line_".__LINE__,
                        ],
                        'name' => "line_".__LINE__,
                        'inputName' => "line_".__LINE__,
                        'elementName' => "line_".__LINE__,
                    ],
                    'name' => "line_".__LINE__,
                    'inputName' => "line_".__LINE__,
                    'elementName' => "line_".__LINE__,
                ],
                'name' => "line_".__LINE__,
                'inputName' => "line_".__LINE__,
                'elementName' => "line_".__LINE__,
            ];
        }

        // Return modified form config
        $meta['sebwite_product_downloads'] = $downloadsFieldset;
        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}