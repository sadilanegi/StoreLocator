<?php
namespace Iksula\Storelocator\Model\Config\Source;

class Options implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            [
                'value'=>'black',
                'label'=>"Black"
            ],
            [
                'value'=>'white',
                'label'=>"White"
            ]
        ];
    }

}