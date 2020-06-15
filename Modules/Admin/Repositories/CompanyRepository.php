<?php


namespace Modules\Admin\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Admin\Models\Company;
use Modules\Inventory\Models\InvoiceDetail;


class CompanyRepository extends EloquentBaseRepository
{
    public $model = Company::class;


    public function delete($data)
    {
        $data = InvoiceDetail::where('company_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }

}
