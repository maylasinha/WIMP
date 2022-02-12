<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pet;
use App\Models\PetComment;

class PetCommentsController extends Controller
{
  public function index($pet_id)
	{
		$pet = Pet::find($pet_id);
		$pet_comments = PetComment::where('pet_id', $pet_id)->get();
		return view('pet_comments.index', ['title' => 'Comentários', 'pet_comments' => $pet_comments, 'pet' => $pet]);
	}

	public function store($pet_id, Request $request)
	{
		$request->validate([
			'name' => 'required',
			'description' => 'required'
		]);

		$pet = new PetComment([
			'name' => $request->get('name'),
      'description' => $request->get('description'),
      'pet_id' => $pet_id
		]);

		$pet->save();

		$pet_comments = PetComment::where('pet_id', $pet_id)->get();
		$html = view('pet_comments._list', ['pet_comments' => $pet_comments, 'pet' => $pet])->render();

		return response()->json(['html' => $html, 'message' => 'Comentário adicionado com sucesso.']);
	}
}
