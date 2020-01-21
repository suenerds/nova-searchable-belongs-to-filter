<?php

namespace Suenerds\NovaSearchableBelongsToFilter;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class NovaSearchableBelongsToFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-searchable-belongs-to-filter';

    public $filterBy;

    public function __construct($name = '')
    {
       $this->name = $name;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $selected)
    {
        return $query->where($this->filterBy, $selected['value']);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }

    public function name()
    {
        return __($this->name ?: $this->getFieldAttribute());
    }

    public function fieldAttribute($attribute)
    {
        $this->withMeta([
            'fieldAttribute' => $attribute,
        ]);

        return $this;
    }

    public function filterBy($attribute)
    {
        $this->filterBy = $attribute;

        return $this;
    }

    public function getFieldAttribute()
    {
        return $this->meta()['fieldAttribute'];
    }

    public function key()
    {
        return get_class($this) . '\\' . ucfirst($this->getFieldAttribute());
    }
}
