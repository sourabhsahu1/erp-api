<?php


namespace Modules\Treasury\Http\Controllers;


use App\Http\Controllers\BaseController;
use Modules\Treasury\Repositories\ReceiptPayeeRepository;

class ReceiptPayeeController extends BaseController
{

    protected $repository = ReceiptPayeeRepository::class;
}
