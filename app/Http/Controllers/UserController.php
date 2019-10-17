<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $per_page = $request->query('per_page');
    if (empty($per_page) || $per_page < 0)
      $per_page = 10;
    return User::query()->orderBy('id', 'asc')->paginate($per_page);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return User::find($id);
  }

    /**

     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  /**
   * 複雑な検索条件を考えるとjsonをpostさせるほうが良いかもしれない
   * 構成案: [{field:対象フィールド,op:動作,value:使用する文字列等},{...},...]
   */
  public function showBy(Request $request)
  {
    $query = User::query();
    
    $field = $request->input('field');
    $op = $request->input('op');
    $value = $request->input('value');
    switch ($op) {
    case "contains":
      $query->contains($field, $value);
      break;
    default:
      // エラーレスポンス
      break;
    }
    return $query->get();
  }
}
