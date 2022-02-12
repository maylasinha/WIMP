<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\PetCategory;

class PetCategoriesController extends Controller
{
	public function __construct()
  {
  	$this->middleware(['permission:criar categoria de pets|editar categoria de pets|apagar categoria de pets'], ['only' => ['index']]);
		$this->middleware(['can:criar categoria de pets'], ['only' => ['create', 'store']]);
		$this->middleware(['can:editar categoria de pets'], ['only' => ['edit', 'update']]);
		$this->middleware(['can:apagar categoria de pets'], ['only' => ['destroy']]);
  }
  
	public function index(Request $request)
	{
		if (!$request->get('keyword')) {
			$pet_categories = PetCategory::all();
		} else {
			$pet_categories = PetCategory::where('name', 'LIKE', '%'.$request->get('keyword').'%')->get();
		}

		return view('admin.pet_categories.index', ['title' => 'Categorias de Pets', 'pet_categories' => $pet_categories]);
	}

	public function create()
	{
		return view('admin.pet_categories.create', ['title' => 'Nova Categoria de Pet']);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required'
		]);

		$pet_category = new PetCategory([
			'name' => $request->get('name'),
			'description' => $request->get('description'),
			'slug' => Str::slug($request->get('name'), '-'),
			'user_id' => auth()->user()->id
		]);

		$pet_category->save();

		return redirect()->route('admin.pet_categories.index')->with('success', 'Categoria de Pet salva com sucesso');
	}

	public function edit($id)
	{
		$pet_category = PetCategory::find($id);
		return view('admin.pet_categories.edit', ['title' => 'Editar Categoria de Pet', 'pet_category' => $pet_category]);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'name' => 'required'
		]);

		$pet_category = PetCategory::find($id);

		$pet_category->name = $request->get('name');
		$pet_category->description = $request->get('description');
		$pet_category->slug = Str::slug($request->get('name'), '-');
		$pet_category->user_id = auth()->user()->id;
		$pet_category->save();

		return redirect()->route('admin.pet_categories.index')->with('success', 'Categoria de Pet salva com sucesso');
	}

	public function destroy($id)
	{
		$pet_category = PetCategory::find($id);

		try {
			$pet_category->delete();
			return redirect()->route('admin.pet_categories.index')->with('success', 'Categoria de Pet apagada com sucesso.');
		} catch (\Illuminate\Database\QueryException $e) {
			$errorCode = $e->errorInfo[0];

			if ($errorCode == '23000') {
				return redirect()->route('admin.pet_categories.index')->with('warning', 'A Categoria de Pet não pode ser apagada no momento porque possui subcategorias vinculadas.');
			} else {
				return redirect()->route('admin.pet_categories.index')->with('danger', 'Não foi possível apagar a Categoria de Pet.');
			}
		}
	}
}
