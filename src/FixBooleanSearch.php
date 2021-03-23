<?php
namespace Sunnysideup\YesNoAnyFilter;

use SilverStripe\Forms\DropdownField;

trait FixBooleanSearch
{
    public function scaffoldSearchFields($_params = null)
    {

        $fields = parent::scaffoldSearchFields($_params);

        $anyText = _t('SilverStripe\\ORM\\FieldType\\DBBoolean.ANY', '-- Any --');
        $source = [
            null => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.ANY', '-- Any --'),
            1 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.YESANSWER', 'Yes'),
            0 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.NOANSWER', 'No')
        ];
        $searchableFields = $this->searchableFields();
        if(count($searchableFields)) {
            $dbs = $this->Config()->get('db');
            foreach($searchableFields as $fieldName => $spec) {
                $fieldTitle = $spec['title'] ?? $fieldName;
                $type = $dbs[$fieldName] ?? 'error';
                if( stripos($type, 'Boolean') === 0) {
                    $field = new DropdownField($fieldName, $fieldTitle, $source);
                    $field->setEmptyString('-- Any --');
                    $fields->replaceField($fieldName, $field);
                }
            }
        }

        return $fields;
    }
}
