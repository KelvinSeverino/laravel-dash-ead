<?php

namespace App\Repositories\Presenters;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\PaginationInterface;

class PaginationPresenterEloquent implements PaginationInterface
{
    public function __construct(
        private LengthAwarePaginator $paginator
    ){}

    public function items(): array
    {
        return $this->paginator->items() ?? 0;
    }

    public function total(): int
    {
        return $this->paginator->total() ?? 0;
    }

    public function perPage(): int
    {
        return $this->paginator->total() ?? 0;
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage() ?? 1;
    }

    public function firstPage(): int
    {
        return $this->paginator->firstPage() ?? 0;
    }

    public function lastPage(): int
    {
        return $this->paginator->firstItem() ?? 0;
    }
}
