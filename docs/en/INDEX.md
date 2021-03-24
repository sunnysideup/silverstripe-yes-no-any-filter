use like this to fix search

```php
MyDataObject extends MyDataObject
{
    use Sunnysideup\YesNoAnyFilter\FixBooleanSearch;


}
```


to make summary field colourfull, use this:



```php
private static $summary_fields = [
    'IsReady.NiceAndColourfull' => 'Is Ready',
    'IsClosed.NiceAndColourfullInvertedColours' => 'Closed',
];

```
