<?php

declare(strict_types=1);

namespace Sunnysideup\YesNoAnyFilter;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBBoolean;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Class \Sunnysideup\YesNoAnyFilter\DBBooleanColourfull.
 *
 * @property DBBoolean|DBBooleanColourfull $owner
 */
class DBBooleanColourfull extends Extension
{
    //colours from CMS
    private const string BAD_COLOUR = '#da273b';

    private const string GOOD_COLOUR = '#008a00';

    private const string YES_VALUE = 'Yes';

    private const string NO_VALUE = 'No';

    private const string STYLE = 'color: #fff; text-align: center; text-transform: uppercase; font-weight: bold; border-radius: 10px; max-width: 4em;';

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
        /** @var DBBoolean $owner */
        $owner = $this->getOwner();
        $v = (bool) $owner->getValue();
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
