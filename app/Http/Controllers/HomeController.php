<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\Contact;

use App\Models\Pet;
use App\Models\Page;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pets = Pet::all();
        $testimonials = Testimonial::where('status', 1)->get();
        return view('home', ['title' => 'Página Inicial', 'pets' => $pets, 'testimonials' => $testimonials]);
    }

    public function admin()
    {
        if (!auth()->check()) {
            return view('admin', ['title' => 'Painel Administrador']);
        } else {
            return redirect()->route('admin.home');
        }
    }

    public function contact()
    {
        return view('contact', ['title' => 'Fale Conosco']);
    }

    public function send_contact(Request $request)
    {
        $data = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'cellphone' => $request->get('cellphone'),
            'body' => $request->get('body')
        ];

        Mail::to('wimp2022@gmail.com')->send(new Contact($data));
        return redirect()->route('contact')->with('success', 'Mensagem enviada com sucesso');
    }

    public function about()
    {
        $page = Page::find(1);
        return view('about', ['title' => $page->title, 'page' => $page]);
    }
}
