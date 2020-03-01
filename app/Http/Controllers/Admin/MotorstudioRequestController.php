<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\MotorstudioRequest;

class MotorstudioRequestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:motorstudio_admin_main');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = new MotorstudioRequest;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
            else {
                if($sort_field == 'event__name') {
                    $items = $items->join('motorstudio_events', 'motorstudio_requests.event_id', '=', 'motorstudio_events.id')
                        ->orderBy('motorstudio_events.name', $sort_order)
                        ->select('motorstudio_requests.*');
                }
            }
        }
        $items = $items->paginate(20);

        return view('admin.motorstudio_requests.index', [
            'items' => $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function downloadCSV()
    {
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=motorstudio_requests_' . time() . '.csv',
        );

        $items = MotorstudioRequest::orderBy('date', 'desc')->get();
        $result = function() use ($items) {
            $output = fopen("php://output", "w");

            $data = [
                iconv('UTF-8', 'Windows-1251', '_ID_'),
                iconv('UTF-8', 'Windows-1251', 'Дата записи'),
                iconv('UTF-8', 'Windows-1251', 'Мероприятие'),
                iconv('UTF-8', 'Windows-1251', 'Дата начала мероприятия'),
                iconv('UTF-8', 'Windows-1251', 'Фамилия'),
                iconv('UTF-8', 'Windows-1251', 'Имя'),
                iconv('UTF-8', 'Windows-1251', 'Возраст'),
                iconv('UTF-8', 'Windows-1251', 'E-Mail'),
                iconv('UTF-8', 'Windows-1251', 'Телефон')
            ];
            fputcsv($output, $data, ";");

            foreach($items as $item) {
                $data = [
                    @iconv('UTF-8', 'Windows-1251', $item->id),
                    @iconv('UTF-8', 'Windows-1251', date('d.m.Y H:i', $item->date)),
                    @iconv('UTF-8', 'Windows-1251', $item->event->name),
                    @iconv('UTF-8', 'Windows-1251', date('d.m.Y H:i', $item->event->date_start)),
                    @iconv('UTF-8', 'Windows-1251', $item->sirname),
                    @iconv('UTF-8', 'Windows-1251', $item->name),
                    iconv('UTF-8', 'Windows-1251', $item->age),
                    iconv('UTF-8', 'Windows-1251', $item->email),
                    iconv('UTF-8', 'Windows-1251', $item->phone)
                ];
                fputcsv($output, $data, ";");
            }

            fclose($output);
        };

        return response()->stream($result, 200, $headers);
    }
}
