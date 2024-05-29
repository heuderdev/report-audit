<?php

namespace App\Http\Controllers\api;

use App\Helpers\Uuid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportController extends Controller
{
    function storeReport(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'data_inicial' => 'required|date',
            'data_final' => 'required|date|after:data_inicial'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $uuid = Uuid::generate();

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
       

        if($resultado->isEmpty()) 
        {
            return response()->json([
               'message' => 'Nenhum resultado encontrado'
            ], 404);
        }

        $fileName = $uuid . '-relatorio.xlsx';
        
        (new FastExcel($resultado))->export(storage_path('app/public/' . $fileName));
    
        // Retorna a URL para download
        return response()->json(['url' => url('storage/' . $fileName)]);



        dd($dataInicial, $dataFinal);
    }
}
