<?php

namespace Ambengers\QueryFilter\Tests\Filters;

use Ambengers\QueryFilter\AbstractQueryFilter;
use Ambengers\QueryFilter\Tests\Filters\PostLoader;

class PostFilters extends AbstractQueryFilter
{
    /**
     * Loader class
     *
     * @var string
     */
    protected $loader = PostLoader::class;

    /**
     * List of searchable columns
     *
     * @var array
     */
    protected $searchableColumns = [
        'subject',
        'body',
        'comments'  =>  ['body'],
    ];

    /**
     * Filter by comments id
     *
     * @param  string $id
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function comments($id = '')
    {
        if (!$id) {
            return $this->builder;
        }

        return $this->builder->whereHas('comments', function ($query) use ($id) {
            $query->whereId($id);
        });
    }
}
