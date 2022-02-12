<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as PDF;

use App\Models\Pet;
use App\Models\PetCategory;
use App\Models\PetComment;
use App\Models\User;
use App\Models\Testimonial;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware(['role:admin|gerente']);
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
      return view('admin/home', ['title' => 'Dashboard']);
  }

  public function overview(Request $request)
  {
    $total_visits = \VisitLog::all()->count();
    $total_users = User::all()->count();
    $total_pets = Pet::all()->count();
    $total_testimonials = Testimonial::all()->count();

    return response()->json(['total_visits' => $total_visits, 'total_users' => $total_users, 'total_pets' => $total_pets, 'total_testimonials' => $total_testimonials]);
  }

  public function visits(Request $request)
  {
    $visits = \VisitLog::all();
    $operating_systems = collect();
    $operating_systems->add(json_decode(json_encode(['name' => 'Apple'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Android'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'IOS'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Linux'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Windows'])));

    $labels = [];
    $data = [];

    foreach ($operating_systems as $key => $operating_system) {
      $labels[] = $operating_system->name;
      $data[] = $visits->where('os', $operating_system->name)->count();
    }

    return response()->json(['labels' => $labels, 'datasets' => ['data' => $data]]);
  }

  public function users(Request $request)
  {
    $query = Role::get()->except(1);

    $labels = [];
    $data = [];

    foreach ($query as $key => $row) {
      $labels[] = $row->name;
      $data[] = User::role($row->name)->count();
    }

    return response()->json(['labels' => $labels, 'datasets' => ['data' => $data]]);
  }

  public function pets(Request $request)
  {
    $query = PetCategory::all();

    $labels = [];
    $data = [];

    foreach ($query as $key => $row) {
      $labels[] = $row->name;
      $data[] = Pet::where('pet_category_id', $row->id)->count();
    }

    return response()->json(['labels' => $labels, 'datasets' => ['data' => $data]]);
  }

  public function testimonials(Request $request)
  {
    $query = collect();
    $query->add(json_decode(json_encode(['name' => 'Aprovado', 'status' => 1])));
    $query->add(json_decode(json_encode(['name' => 'Não Aprovado', 'status' => 0])));

    $labels = [];
    $data = [];

    foreach ($query as $key => $row) {
      $labels[] = $row->name;
      $data[] = Testimonial::where('status', $row->status)->count();
    }

    return response()->json(['labels' => $labels, 'datasets' => ['data' => $data]]);
  }

  public function pdf(Request $request)
  {
    $statuses = collect();
    $statuses->add(json_decode(json_encode(['name' => 'Aprovado', 'status' => 1])));
    $statuses->add(json_decode(json_encode(['name' => 'Não Aprovado', 'status' => 0])));

    $operating_systems = collect();
    $operating_systems->add(json_decode(json_encode(['name' => 'Apple'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Android'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'IOS'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Linux'])));
    $operating_systems->add(json_decode(json_encode(['name' => 'Windows'])));

    $data = [
      'operating_systems' => $operating_systems,
      'visits' => \VisitLog::all(),
      'roles' => Role::get(),
      'pet_categories' => PetCategory::all(),
      'statuses' => $statuses,
      'testimonials' => Testimonial::all()
    ];

    $pdf = PDF::loadView('admin.pdf', $data, [], [ 'default_font_size' => '10', 'margin_top' => 40, 'margin_bottom' => 40 ]);
    return $pdf->download('relatorio.pdf');
  }

  public function summernote_upload(Request $request)
  {
    $path = $request->file->store('uploads/sumernote/');
    echo Storage::url($path);
  }
}
