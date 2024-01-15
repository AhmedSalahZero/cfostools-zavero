<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\IBaseModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface IBaseRepository
{

    public function all():Collection;

    public function allFormatted():array;

    public function find(?int $id):?IBaseModel  ;

    public function Random():Builder;

    public function query():Builder;

    public function store(Request $request ):IBaseModel;

    public function update(IBaseModel $user , Request $request ):void;

    public function paginate(Request $request):array;


}
