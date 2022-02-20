<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cuadro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class CuadroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');

    }

    /**
     * Funcion que permite agregar datos de un nuevo cuadro
     * @param Request $request recibe datos de un cuadro
     * @return \Illuminate\Http\JsonResponse retorna el cuadro creado
     */
    public function create(Request $request)
    {
        $star =explode(".",microtime(true));

        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'paint' => 'required',
            'year' => 'required',
            'country' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $cuadro = new Cuadro;
            $cuadro->name = $request->name;
            $cuadro->title = $request->title;
            $cuadro->paint = $request->paint;
            $cuadro->year = $request->year;
            $cuadro->material = $request->material;
            $cuadro->measures = $request->measures;
            $cuadro->country = $request->country;
            $cuadro->save();





            DB::commit();
            $end =explode(".",microtime(true));
            $statu =$end[1] - $star[1];
            $cuadro->statu =$statu;
            $cuadro->save();
            return response()->json([
                'status'=>200,
                'data'=>$cuadro
            ]);

        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                'statu' =>400,
                'message' => 'Unexpected error !',
                'error'=>$validator->fails()]);
        }
    }

    /**
     * Función que permite obtener los datos de cuadros creado, retorna los primeros cuadros
     * @return \Illuminate\Http\JsonResponse retorna los cuadros paginados de 10
     */
    public function getAll()
    {
        $cuadro = Cuadro::paginate(10);
        if($cuadro) {
            return response()->json(
                $cuadro,
                200);
        }else {
            return response()->json([
                'statu' => 404,
                'message' => 'transaction error']);
        }
    }


    /**
     * función que muestra los datos del cuadro con $id
     * @param $id /del cuadro a obtener
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        $cuadro = Cuadro::find($id);

        if($cuadro) {
            return response()->json([
                'data' =>$cuadro,
                'statu' =>200]);
        }
        return response()->json([
            'statu' => 404,
            'message' => 'transaction error']);
    }


    /***
     * Función que permite editar los datos del un cuadro
     * @param Request $request datos de un cuadro a editar
     * @param Cuadro $cuadro
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request,Cuadro $cuadro)
    {
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'paint' => 'required',
            'year' => 'required',
            'country' => 'required',
        ]);
        try {
            DB::beginTransaction();
        $cuadro->update($request->all());
            DB::commit();
            return response()->json([
                'status'=>200,
                'cuadro'=>$cuadro
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'statu' => 400,
                'message' => 'Update error !',
                'error' => $validator->fails()]);
        }
    }

    /**
     * @param $id /de cuadro a borrar
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();

            Cuadro::destroy($id);

            DB::commit();

            return response()->json([
                'statu' => 200,
                'message' => 'Cuadro removed successfully']);
        }
        catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'statu' =>400,
                'message' => 'update error']);
        }
    }

    /**
     * Función que devuelve datos de cuadros por campos solicitados
     * @param Request $request data de campos a buscar y data de campos a mostrar
     * @return \Illuminate\Http\JsonResponse con datos de campos pedidos
     */
    public function search(Request $request)
    {
        $cuadro=[];
        if($request->name) {
            if ($request->fields) {
                $cuadro = Cuadro::where('name', 'like', '%' . trim($request->name))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('name', 'like', '%' . trim($request->name))->get();
            }
        }
        if($request->year) {
            if ($request->fields) {
                $cuadro = Cuadro::where('year', 'like', '%' . trim($request->year))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('year', 'like', '%' . trim($request->year))->get();
            }
        }

       if($request->title){
           if ($request->fields) {
               $cuadro = Cuadro::where('title', 'like', '%' . trim($request->title))->get(explode(',', $request->fields));
           } else {
               $cuadro = Cuadro::where('title', 'like', '%' . trim($request->title))->get();
           }
       }
        if($request->paint){
            if ($request->fields) {
                $cuadro = Cuadro::where('paint', 'like', '%' . trim($request->paint))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('paint', 'like', '%' . trim($request->paint))->get();
            }
        }
        //if($request->year){dd($request->name);}
        if($request->material){
            if ($request->fields) {
                $cuadro = Cuadro::where('material', 'like', '%' . trim($request->material))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('material', 'like', '%' . trim($request->material))->get();
            }
        }

        if($request->measures){
            if ($request->fields) {
                $cuadro = Cuadro::where('measures', 'like', '%' . trim($request->measures))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('measures', 'like', '%' . trim($request->measures))->get();
            }
        }

        if($request->country){
            if ($request->fields) {
                $cuadro = Cuadro::where('country', 'like', '%' . trim($request->country))->get(explode(',', $request->fields));
            } else {
                $cuadro = Cuadro::where('country', 'like', '%' . trim($request->country))->get();
            }
        }

        if(!empty($cuadro->all())){
            return response()->json(['cuadro' => $cuadro,200]);
        }else{
            return response()->json(['message' => "no results found",400]);
        }

    }

}
