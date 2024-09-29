<?php

namespace Sunnysideup\YesNoAnyFilter;

use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataExtension;

/**
 * Class \Sunnysideup\YesNoAnyFilter\FixBooleanSearchAsExtension.
 *
 * @property DataObject|FixBooleanSearchAsExtension $owner
 */
class FixBooleanSearchAsExtension extends DataExtension
{
    public static function dropdown_source_for_boolean_fields()
    {
        return [
            null => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.ANYANSWER', '--- any ---'),
            1 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.YESANSWER', 'Yes'),
            0 => _t('SilverStripe\\ORM\\FieldType\\DBBoolean.NOANSWER', 'No'),
        ];
    }

    public function updateSearchableFields(&$fields)
    {
        $matches = [];
        $candidates = $this->owner->config()->get('db');
        if (count($candidates) > 0) {
            foreach ($candidates as $fieldName => $type) {
                if (0 === stripos($type, 'Boolean')) {
                    $matches[$fieldName] = $fieldName;
                }
            }

            $labels = $this->owner->fieldLabels(false);
            foreach (array_keys($fields) as $fieldName) {
                if (isset($matches[$fieldName])) {
                    $fields[$fieldName]['field'] = DropdownField::create(
                        $fieldName,
                        $labels[$fieldName],
                        self::dropdown_source_for_boolean_fields()
                    );
                }
            }
        }

        return $fields;
    }
}
