<?php
namespace OmniPro\Patch\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

class AtributeAddText implements DataPatchInterface{

    /**
     * @param \magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     *  @param \magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    public function __construct( 
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
    ){
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function apply(){

        $eavSetup = $this->eavSetupFactory->create(['setup'=> $this->moduleDataSetup]);
        
        $eavSetup->addAttribute('catalog_product','alternative_capacity', [
            'type' => 'text',
            'label' => 'Alternative capacity',
            'input' => 'text',
            'used_in_product_listing' => true,
            'user_defined' => true
        ]);

        $eavSetup->addAttributeToGroup('catalog_product',$eavSetup->getAttributeSetId('catalog_product', 'Bag'), 'Desing', 'alternative_capacity', 5);
    }
 
    public static function getDependencies()
    {
        return [];
    }
 
    public function getAliases()
    {
        return [];
    } 
}


