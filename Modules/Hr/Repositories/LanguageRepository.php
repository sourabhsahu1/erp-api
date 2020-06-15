<?php


namespace Modules\Hr\Repositories;


use Luezoid\Laravelcore\Exceptions\AppException;
use Luezoid\Laravelcore\Repositories\EloquentBaseRepository;
use Modules\Hr\Models\EmployeeLanguage;
use Modules\Hr\Models\Language;

class LanguageRepository extends EloquentBaseRepository
{

    public $model = Language::class;

    public function delete($data)
    {
        $data = EmployeeLanguage::where('language_id', $data['id'])->first();
        if (is_null($data)) {
            return parent::delete($data);
        }else {
            throw new AppException('Already in use');
        }
    }

}
