<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
   * 検索
   */
  public function showBy(Request $request)
  {
    $query = User::query();
    
    $per_page = $request->input('per_page');
    if (empty($per_page) || $per_page < 0)
      $per_page = 10;
    $selectedColumns = $request->input('columns'); // 返すカラム配列
    $criteria = $request->input('criteria'); // 検索条件配列

    foreach ($criteria as $criterion) {
      $column = $criterion['column']; // 検索条件対象カラム
      $op = $criterion['op']; // 検索動作
      $value = $criterion['value']; // 検索値

      switch ($op) {
      case "contains":
        $query->contains($column, $value);
        break;
      case "startsWith":
        $query->startsWith($column, $value);
        break;
      case "endsWith":
        $query->endsWith($column, $value);
        break;
      case "match":
        $query->match($column, $value);
        break;
      default:
        return ['status' => 'error', 'body' => ['message' => 'op error', 'text' => 'request error']];
        break;
      }
    }
    return $query->select($selectedColumns)->orderBy('id', 'asc')->paginate($per_page);
  }
  /**
   * カラム名配列を返す
   */
  public function getSchema(Request $request) {
    return Schema::getColumnListing(User::make()->getTable());
  }
}
