<?php

namespace Hoanh\WebsitePhone\Models;

use Hoanh\WebsitePhone\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';

    public function findByIDShow($id)
    {
        return $this->queryBuilder
            ->select('p.name','p.img_thumbnail','p.price_regular','p.price_sale','p.content','c.name as c_name')
            ->from($this->tableName,'p')
            ->join('p','categories','c','p.category_id=c.id')
            ->where('p.id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }
}
