<?php

namespace common\traits;

/**
 * ActiveRecord adatai a megjelenítéshez
 *
 * @author kamarton
 */
trait ActiveRecordViewTrait
{
    /**
     * adatok a megjelenítéshez
     *
     * @var  
     */
    private $traitDataForView;

    /**
     * Adatok a megjelenítéshez
     *
     * @return 
     */
    public function getView()
    {
        if ($this->traitDataForView === null) {
            $this->traitDataForView = new $this->viewDataClass(['model' => $this]);
        }
        return $this->traitDataForView;
    }

    /**
     * view adatok címkéi
     * 
     * @return type
     */
    protected function viewAttributeLabels()
    {
        $viewLabels = [];
        foreach ($this->getView()->attributeLabels() as $key => $value) {
            $viewLabels["view.$key"] = $value;
        }

        return $viewLabels;
    }

}
