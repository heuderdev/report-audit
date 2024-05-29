<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExcelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportController extends Controller
{
    function index(Request $request)
    {

        $dataInicial = $request->input('data_inicial');
        $dataFinal = $request->input('data_final');

        $query = DB::table('volumes')
            ->select(
                'maletas.numero_maleta AS numero_maleta',
                'protocolos.codigo_protocolo AS codigo_protocolo',
                'tipos.nome AS nome',
                DB::raw('COUNT(volumes.codigo_volume) AS quantidade_volumes'),
                DB::raw("GROUP_CONCAT(
                        CONCAT(
                            volumes.codigo_volume, ' (', 
                            DATE_FORMAT(volumes.created_at, '%d-%m-%Y %H:%i:%s'), 
                            ')'
                        ) 
                        ORDER BY volumes.codigo_volume ASC 
                        SEPARATOR ', '
                    ) AS volumes_concatenados")
            )
            ->join('tipos', 'tipos.id', '=', 'volumes.tipos_id')
            ->join('maletas', 'maletas.id', '=', 'volumes.maleta_id')
            ->join('protocolos', 'protocolos.id', '=', 'maletas.protocolo_id')
            ->whereNotIn('tipos.nome', ['DAT', 'VHS', 'DVD', 'CD-R'])
            ->groupBy('maletas.numero_maleta', 'protocolos.codigo_protocolo', 'tipos.nome')
            ->orderByDesc('maletas.id');

        if ($dataInicial && $dataFinal) {
            $query->whereBetween('volumes.created_at', [$dataInicial, $dataFinal]);
        }

        $resultado = $query->get();
        // return  (new FastExcel($resultado))->download('file.xlsx');
        return view('report');
    }

    function storeReport(StoreExcelRequest $request)
    {

        if($request->fails()) {
            return 'error';
        }

        $dataInicial = $request->input('data_inicial');
        $dataFinal = $request->input('data_final');
        dd($dataInicial, $dataFinal);


    }
}
