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
        $language = EmployeeLanguage::where('language_id', $data['id'])->first();
        if (is_null($language)) {
            return parent::delete($data);
        } else {
            throw new AppException('Already in use');
        }
    }

    public function getAll($params = [], $query = null)
    {

        if (isset($params["inputs"]["orderby"])) {
            $params["inputs"]["orderby"] = 'name';
            $params['inputs']['order'] = 'asc';
        }

        return parent::getAll($params, $query); // TODO: Change the autogenerated stub
    }


}
