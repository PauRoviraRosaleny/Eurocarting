<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Car;
use App\Models\Loan;
use Carbon\Carbon;



class HomeController extends Controller
{

    public function index()
    {
        $cars = Car::all();
        $brands = Car::select('brand')->distinct()->get();
        $models = Car::select('model')->distinct()->get();
        $seats = Car::select('seats')->distinct()->get();
        $doors = Car::select('doors')->distinct()->get();
        $prices = Car::select('price')->distinct()->get();
        $transmissions = Car::select('transmission')->distinct()->get();
        $engines = Car::select('engine')->distinct()->get();
        $air_conditionings = Car::select('air_conditioning')->distinct()->get();

        if ( Auth::id() == 7) {
            return view('cars',compact( 'cars', 'brands', 'models', 'seats', 'doors', 'prices', 'transmissions', 'engines', 'air_conditionings'));
        } else {
            return view('index');
        }




    }

    public function searchFilters(Request $request)
{
    $cars = Car::all();
    $loans = Loan::all();
    $startDate = $request->input('hiddenStartDate');
    $endDate = $request->input('hiddenEndDate');

    // Consulta para obtener los coches que no tienen préstamos que se solapen con las fechas proporcionadas
    $cars = Car::whereDoesntHave('loans', function ($query) use ($startDate, $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                  ->where('end_date', '>=', $startDate);
        });
    })->get();

    // Aplicar otros filtros de búsqueda si se especifican en la solicitud
    if ($request->brand != 'all') {
        $cars = $cars->where('brand', $request->brand);
    }

    if ($request->has('priceRangeMin') && $request->has('priceRangeMax')) {
        $cars = $cars->where('price', '>=', $request->priceRangeMin)
                     ->where('price', '<=', $request->priceRangeMax);
    }

    if ($request->transmission != 'all') {
        $cars = $cars->where('transmission', $request->transmission);
    }

    if ($request->engine != 'all') {
        $cars = $cars->where('engine', $request->engine);
    }

    if ($request->has('seats')) {
        $cars = $cars->where('seats', '>', 5);
    }

    if ($request->has('air_conditioning')) {
        $cars = $cars->where('air_conditioning', 0);
    }

    // Obtener otros datos necesarios para la vista
    $brands = Car::select('brand')->distinct()->get();
    $models = Car::select('model')->distinct()->get();
    $seats = Car::select('seats')->distinct()->get();
    $doors = Car::select('doors')->distinct()->get();
    $prices = Car::select('price')->distinct()->get();
    $transmissions = Car::select('transmission')->distinct()->get();
    $engines = Car::select('engine')->distinct()->get();
    $air_conditionings = Car::select('air_conditioning')->distinct()->get();

    // Pasar los datos a la vista
    return view('cars', compact('cars', 'brands', 'models', 'seats', 'doors', 'prices', 'transmissions', 'engines', 'air_conditionings', 'startDate', 'endDate'));
}


    public function searchCars(Request $request)
{
    // Obtener las fechas de inicio y fin desde la solicitud
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');


    // Consulta para obtener los coches que no tienen préstamos que se solapen con las fechas proporcionadas
    $cars = Car::whereDoesntHave('loans', function ($query) use ($startDate, $endDate) {
        $query->where(function ($query) use ($startDate, $endDate) {
            $query->where('start_date', '<=', $endDate)
                  ->where('end_date', '>=', $startDate);
        });
    })->get();


    // Obtener otros datos necesarios para la vista
    $brands = Car::select('brand')->distinct()->get();
    $models = Car::select('model')->distinct()->get();
    $seats = Car::select('seats')->distinct()->get();
    $doors = Car::select('doors')->distinct()->get();
    $prices = Car::select('price')->distinct()->get();
    $transmissions = Car::select('transmission')->distinct()->get();
    $engines = Car::select('engine')->distinct()->get();
    $air_conditionings = Car::select('air_conditioning')->distinct()->get();

    // Pasar los datos a la vista
    return view('cars', compact('cars', 'brands', 'models', 'seats', 'doors', 'prices', 'transmissions', 'engines', 'air_conditionings', 'startDate', 'endDate'));
}



    public function login()
    {
        return view("login");
    }

    public function register()
    {
        return view("register");
    }

    public function checkLogin(Request $request){
        $credentials = $request->only('name', 'password');
        $this->validate($request, [
            "name" => "required",
            "password" => "required",
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        }

        return back()->withErrors([
            'message' => 'Las credenciales proporcionadas no son correctas. Por favor, inténtelo de nuevo.'
        ]);
    }

    public Function checkRegister(Request $request){
        $this->validate($request, [
            "name" => "required | unique:users,name",
            "email" => "required",
            "phone" => "required | max:9 | unique:users,phone",
            "password" => "required | confirmed",
            "image" => "image | mimes:jpeg,png,jpg"
        ]);

        $user = new User;
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->phone = $request->input("phone");
        $user->password = bcrypt($request->input("password"));
        $user->role = 'user';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time(). '.'.$image->getClientOriginalExtension();
            $image->move(('Uploads/Users/'),$name);
            $user->image = '/Uploads/Users/'.$name;

        }

        $user->save();

       Auth::login($user);
       return redirect()->route('index');

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }

    public function details(Request $request, $id){

        $startDate = $request->input('hiddenStartDate');
        $endDate = $request->input('hiddenEndDate');

        // Convertir las cadenas de fecha en objetos Carbon
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate);

        // Calcular la diferencia en días entre las dos fechas
        $numberOfDays = $endDate->diffInDays($startDate);

        // Supongamos que estos son los datos ficticios de tus planes de seguro
        $insurancePlans = [
            (object) [
                'id' => 1,
                'name' => 'Plan Básico',
                'price' => 50,
                'description' => '
                <ul>
                <li>Precio más barato y asequible</li>
                <li>Cobertura de daños en la carrocería del coche</li>
                <li>Asistencia básica en carretera</li>
                <br>
                </ul>'
            ],
            (object) [
                'id' => 2,
                'name' => 'Plan Estandar',
                'price' => 100,
                'description' => '
                <ul>
                <li>Sin bloqueo de depósito en la tarjeta</li>
                <li>Cobertura total de daños</li>
                <li>Asistencia básica en carretera</li>
                <br>
                </ul>'
            ],
            (object) [
                'id' => 3,
                'name' => 'Plan Premium',
                'price' => 150,
                'description' => '<ul>
                <li>Sin bloqueo de depósito en la tarjeta</li>
                <li>Cobertura total de daños</li>
                <li>Asistencia PREMIUM en carretera</li>
                </ul>'
            ],
        ];

        $car = car::find($id);
        return view('details', compact('car', 'insurancePlans', 'startDate', 'endDate', 'numberOfDays'));

    }

    public function account(){
        $userId = Auth::id(); // Get the authenticated user's ID
        $loans = Loan::where('user_id', $userId)->get(); // Search for loans by user ID
        return view('account', compact('loans')); // Pass the loans to the view

    }

    public function filter_loans(Request $request){
    $userId = Auth::id(); // Get the authenticated user's ID

    // Get the selected filter value
    $filter = $request->input('filter');

    // Get the loans based on the selected filter
    if ($filter == 'active') {
        $loans = Loan::where('user_id', $userId)->where('active', 0)->get(); // Filter active loans for the authenticated user
    } elseif ($filter == 'inactive') {
        $loans = Loan::where('user_id', $userId)->where('active', 1)->get(); // Filter inactive loans for the authenticated user
    } else {
        $loans = Loan::where('user_id', $userId)->get(); // Get all loans for the authenticated user
    }

    return view('account', compact('loans'));

    }

    public function settings(){
        return view('settings');
    }

    public function edit($id){
        if ( Auth::user()->role == 'admin' ) {
            $car = car::find($id);
            return view('edit', ['car' => $car]);
        } else{
            return redirect()->route('index');
        }

    }

    public function create(){
        if ( Auth::user()->role == 'admin' ) {
            return view('create');
        } else{
            return redirect()->route('index');
        }

    }

    public function updateUser(Request $request){


        $request->validate([
            'password' => 'confirmed',
        ]);

        $user = User::find(Auth::user()->id);

        if ($request->input('name') != null) {
            $user->name = $request->input('name');
        }

        if ($request->input('phone') != null) {
            $user->phone = $request->input('phone');
        }

        if ($request->input('password') != null) {
            $user->password = $request->input('password');
        }

        $user->save();
        return redirect()->route('settings');
    }

    public function addCar( Request $request ){

        $this->validate($request, [
            "image" => "image | mimes:jpeg,png,jpg | required",
            "brand" => "required",
            "model" => "required",
            "price" => "required",
            "seats" => "required",
            "doors" => "required",
            "bags" => "required",
            "transmission" => "required",
            "engine" => "required",
            "air_conditioning" => "required",

        ]);

        $car = new Car;
        $car->model = $request->input("model");
        $car->brand = $request->input("brand");
        $car->price = $request->input("price");
        $car->seats = $request->input("seats");
        $car->doors = $request->input("doors");
        $car->bags = $request->input("bags");
        $car->transmission = $request->input("transmission");
        $car->engine = $request->input("engine");
        $car->air_conditioning = $request->input("air_conditioning");

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time(). '.'.$image->getClientOriginalExtension();
            $image->move(('Uploads/Cars/'),$name);
            $car->image = '/Uploads/Cars/'.$name;
        }

        $car->save();

        return redirect()->route('index');
    }

    public function updateCar(Request $request, $id){
        $this->validate($request, [
            "image" => "image | mimes:jpeg,png,jpg | required",
            "brand" => "required",
            "model" => "required",
            "price" => "required",
            "seats" => "required",
            "doors" => "required",
            "bags" => "required",
            "transmission" => "required",
            "engine" => "required",
            "air_conditioning" => "required",

        ]);

        $car = Car::find($id);
        $car->model = $request->input('model');
        $car->brand = $request->input('brand');
        $car->price = $request->input('price');
        $car->seats = $request->input('seats');
        $car->doors = $request->input('doors');
        $car->bags = $request->input('bags');
        $car->transmission = $request->input('transmission');
        $car->engine = $request->input('engine');
        $car->air_conditioning = $request->input('air_conditioning');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time(). '.'.$image->getClientOriginalExtension();
            $image->move(('Uploads/Cars/'),$name);
            $car->image = '/Uploads/Cars/'.$name;
        }

        $car->update();
        return redirect()->route('index');



    }

    public function contact(){

        return view('contact');
    }

        public function send(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to($request->email)->send(new ContactMail($request->name));

        return redirect('/contact')->with('status', '¡Mensaje enviado correctamente!');
    }

}
