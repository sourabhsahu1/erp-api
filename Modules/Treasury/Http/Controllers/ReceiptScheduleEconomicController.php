<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Modules\Treasury\Repositories\ReceiptScheduleEconomicRepository;

class ReceiptScheduleEconomicController extends BaseController
{

    protected $repository = ReceiptScheduleEconomicRepository::class;
}
