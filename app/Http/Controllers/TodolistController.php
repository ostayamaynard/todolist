<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\todo;
use App\Http\Resources\ToDolistResources;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use Illuminate\Http\Response;

class TodolistController extends Controller
{

  public function index(){
    return view('welcome',['listItems' => todo::all()]);
  }

  public function saveItem(Request $request) {
    // Log::info(json_encode($request->all()));
    // return view('welcome');
    // $todolist = todo::create($request->all());

    // return new ToDolistResources($todolist);

    $newListItem = new todo;
    $newListItem->name = $request->listItem;
    $newListItem->is_complete = 0 ;
    $newListItem->save();

    return redirect('/');
  }

  public function markComplete(Request $request, $id)
  {
      $newListItem = todo::find($id);
  
      if ($newListItem !== null) {
          $newListItem->is_complete = 1;
          $newListItem->save();
  
          // Commit the transaction if applicable
          if (config('database.default') !== 'sqlite') {
              \DB::commit();
          }
  
          return redirect('/');
      } else {
          // Handle the case when the todo item is not found
          return redirect('/')->with('error', 'Todo item not found.');
      }
  }
  public function show($id): ToDolistResources
  {
    $todo = todo::findOrFail($id);

    return new ToDolistResources($todo);
  }

  public function create(Request $request): ToDolistResources
  {
    $todo = todo::create($request->all());

    return new ToDolistResources($todo);
  }

  public function update(Request $request, $id): ToDolistResources
  {
    $todo = todo::findOrFail($request->all());
    $todo->update();

    return new ToDolistResources($todo);
  }

  public function delete($id):Response
  {
    $todo = todo::findOrFail($id);
    $todo->delete();

    return response()->noContent();
  }
}
