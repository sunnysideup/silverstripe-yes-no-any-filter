<?php

namespace Sunnysideup\YesNoAnyFilter;

trait FixBooleanSearch
{
    public function scaffoldSearchFields($_params = null)
    {
        $fields = parent::scaffoldSearchFields($_params);

        $source = [
            null => ' -- any -- ',
            1 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.YESANSWER', 'Yes'),
            0 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.NOANSWER', 'No'),
        ];
        $searchableFields = $this->searchableFields();
        if (count($searchableFields) > 0) {
            $dbs = $this->Config()->get('db');
            foreach (array_keys($searchableFields) as $fieldName) {
                $type = $dbs[$fieldName] ?? 'error';
                if (stripos($type, 'Boolean') === 0) {
                    $fields
                        ->dataFieldByName($fieldName)
                        ->setSource($source);
                }
            }
        }

        return $fields;
    }
}
