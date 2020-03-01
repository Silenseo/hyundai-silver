<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers;
use Illuminate\Http\Request;

use App\Jobseeker;

class JobseekersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check_userpermission:jobseekers_admin_main');
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
        $items = new Jobseeker;
        if($request->get('sort_field')) {
            $sort_field = $request->get('sort_field');
            $sort_order = $request->get('sort_order') ?? 'asc';
            if(strpos($sort_field, '__') === false) {
                if(\Schema::hasColumn($items->getTable(), $sort_field)) {
                    $items = $items->orderBy($sort_field, $sort_order);
                }
            }
        }
        $items = $items->paginate(20);

        return view('admin.jobseeker.index', [
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
            'Content-Disposition' => 'attachment; filename=jobseekers_' . time() . '.csv',
        );

        $items = Jobseeker::orderBy('created_at', 'desc')->get();
        $result = function() use ($items) {
            $output = fopen("php://output", "w");

            $data = [
                iconv('UTF-8', 'Windows-1251', '_ID_'),
                iconv('UTF-8', 'Windows-1251', 'Дата'),
                iconv('UTF-8', 'Windows-1251', 'Фамилия'),
                iconv('UTF-8', 'Windows-1251', 'Имя'),
                iconv('UTF-8', 'Windows-1251', 'Отчество'),
                iconv('UTF-8', 'Windows-1251', 'E-Mail'),
                iconv('UTF-8', 'Windows-1251', 'Телефон'),
                iconv('UTF-8', 'Windows-1251', 'ВУЗ'),
                iconv('UTF-8', 'Windows-1251', 'Специальность'),
                iconv('UTF-8', 'Windows-1251', 'Образование'),
                iconv('UTF-8', 'Windows-1251', 'Курс'),
                iconv('UTF-8', 'Windows-1251', 'Уровень владения английским'),
                iconv('UTF-8', 'Windows-1251', 'Ссылка на резюме'),
            ];
            fputcsv($output, $data, ";");

            foreach($items as $item) {
                $data = [
                    @iconv('UTF-8', 'Windows-1251', $item->id),
                    @iconv('UTF-8', 'Windows-1251', date('d.m.Y H:i', strtotime($item->created_at))),
                    @iconv('UTF-8', 'Windows-1251', $item->surname),
                    @iconv('UTF-8', 'Windows-1251', $item->name),
                    @iconv('UTF-8', 'Windows-1251', $item->patronymic),
                    iconv('UTF-8', 'Windows-1251', $item->email),
                    iconv('UTF-8', 'Windows-1251', $item->tel),
                    iconv('UTF-8', 'Windows-1251', strlen($item->otherinstitute) > 0 ? $item->otherinstitute : $item->institute),
                    iconv('UTF-8', 'Windows-1251', $item->specialty),
                    iconv('UTF-8', 'Windows-1251', $item->level),
                    iconv('UTF-8', 'Windows-1251', $item->stage),
                    iconv('UTF-8', 'Windows-1251', $item->lang),
                    iconv('UTF-8', 'Windows-1251', strlen($item->file) > 0 ? 'https://hyundai.ru/storage/jobseeker/' . $item->file : ''),
                ];
                fputcsv($output, $data, ";");
            }

            fclose($output);
        };

        return response()->stream($result, 200, $headers);
    }
}
