# To fix ModelAdmin search:

This is out of the box


# Make summary field colourfull, use this:


```php
private static $summary_fields = [
    'IsReady.NiceAndColourfull' => 'Is Ready',
    'IsClosed.NiceAndColourfullInvertedColours' => 'Closed',
];

```
