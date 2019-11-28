# nova-searchable-belongs-to-filter
A searchable Nova filter for belongsTo relationships.

### Demo

![demo](https://user-images.githubusercontent.com/4764281/69803436-76184200-11dc-11ea-9c19-4eacf1ba3b4c.gif)

### Prerequisites

This package assumes you have a text-search setup for your Eloquent models. See [Laravel Scout](https://laravel.com/docs/master/scout).

### Installation

todo:
- [ ] add to packagist

### Usage

For this example let's assume a user belongs to a department and a department has many users.
To make the relationship searchable via a filter, add this to the `filters()` function of your Nova user resource:

```php
// app/Nova/User.php
public function filters(Request $request)
{
    return [
	(new NovaSearchableBelongsToFilter)
	    ->fieldAttribute('department')
	    ->filterBy('department_id')
    ];
}
```
