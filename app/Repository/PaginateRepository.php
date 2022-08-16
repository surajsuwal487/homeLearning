<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginateRepository
{

   public function paginateArray($orders, $request)
   {
      $page = $request['page'] ?? 1; // Get the ?page=1 from the url
      $perPage = 10; // Number of items per page
      $offset = ($page * $perPage) - $perPage;

      return new LengthAwarePaginator(
         array_slice($orders, $offset, $perPage, true), // Only grab the items we need
         count($orders), // Total items
         $perPage, // Items per page
         $page, // Current page
         ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
      );
   }
}
