<?php

namespace Sunnysideup\YesNoAnyFilter;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Class \Sunnysideup\YesNoAnyFilter\DBBooleanColourfull.
 *
 * @property \SilverStripe\ORM\FieldType\DBBoolean|\Sunnysideup\YesNoAnyFilter\DBBooleanColourfull $owner
 */
class DBBooleanColourfull extends Extension
{
    //colours from CMS
    /**
     * @var string
     */
    private const BAD_COLOUR = '#da273b';

    /**
     * @var string
     */
    private const GOOD_COLOUR = '#008a00';

    /**
     * @var string
     */
    private const YES_VALUE = 'Yes';

    /**
     * @var string
     */
    private const NO_VALUE = 'No';

    /**
     * @var string
     */
    private const STYLE = 'color: #fff; text-align: center; text-transform: uppercase; font-weight: bold; border-radius: 10px; max-width: 4em;';

    private static $casting = [
        'NiceAndColourfull' => 'HTMLFragment',
        'NiceAndColourfullInvertedColours' => 'HTMLFragment',
    ];

    public function NiceAndColourfull()
    {
        return $this->NiceAndColourfullInner();
    }

    public function NiceAndColourfullInvertedColours()
    {
        return $this->NiceAndColourfullInner(true);
    }

    protected function NiceAndColourfullInner(?bool $invertColours = false)
    {
        $v = (bool) $this->owner->getValue();
        if ($v) {
            $bgColour = $invertColours ? self::BAD_COLOUR : self::GOOD_COLOUR;
            $text = self::YES_VALUE;
        } else {
            $bgColour = $invertColours ? self::GOOD_COLOUR : self::BAD_COLOUR;
            $text = self::NO_VALUE;
        }

        return DBField::create_field('HTMLFragment', '<span class="boolean-nice-and-colourfull" style="display: block; background-color: ' . $bgColour . '; ' . self::STYLE . ' ">' . $text . '</span>');
    }
}
