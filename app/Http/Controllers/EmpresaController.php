<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\Empresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $empresa = Empresa::all();

            if (count($empresa) == 0) {
                return response()->json(["status" => "Error", "msg" => "Não há empresas cadastradas na base de dados"], 500);
            }

            return response()->json(["status" => "SUCCESS", "data" => $empresa], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'msg' => $e], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            // inicio da tansação
            DB::beginTransaction();

            //instancia nova empresa
            $empresa = new Empresa();

            // atibui os dados
            $empresa->razao_social      = $request->razao_social;
            if ($request->nome_fantasia) {
                $empresa->nome_fantasia     = $request->nome_fantasia;
            }
            $empresa->cnpj              = $request->cnpj;

            // salva
            $empresa->save();

            // confirma o save
            DB::commit();

            return response()->json(['status' => 'SUCCESS', 'msg' => 'Empresa cadastrada com sucesso'], 200);
            

        } catch (\Exception $e) {

            // se algo deu errado, tudo é desfeito e a resposta do erro é enviada.
            DB::rollBack();
            return response()->json(['status' => 'Error', 'msg' => $e], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {

            // tenta buscar a empresa
            $empresa = Empresa::find($id);

            // se não achou envia a resposta
            if (!$empresa) {
                return response()->json(["status" =>"ERROR", "msg" => "Empresa não encontrada na base de dados."], 500);
            }
    
            // entrega a empresa solicitada
            return response()->json(["status" =>"SUCCESS", "data" => $empresa], 200);

        } catch (\Throwable $th) {

            // algum erro ocorreu, e o mesmo é devolvido como resposta
            return response()->json(["status" =>"ERROR", "msg" => "Erro ao buscar a empresa."], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {   //return response()->json(["status" =>"SUCCESS", "data" => $request->all()], 200);

            // inicia a transação
            DB::beginTransaction();


            // busca pela empresa solocitada
            $empresa = Empresa::find($request->empresaId);

            // se a empresa não está na base de dados, a informação é retornada
            if (!$empresa) {
                return response()->json(["status" =>"Error", "msg" => "Empresa não encontrada na base de dados"], 500);
            }

            // atribui os novos dados
            $empresa->razao_social      = $request->razao_social;
            $empresa->nome_fantasia     = $request->nome_fantasia   ?? null;
            $empresa->cnpj              = $request->cnpj;

            // salva novos dados
            $empresa->save();

            // confirma o save, e retorna a resposta
            DB::commit();
            return response()->json(["status" =>"SUCCESS", "msg" => "Empresa atualizada com sucesso."], 200);

        } catch (\Throwable $th) {
            //throw $th;
            // algo saiou errado, a mensagen do erro é retornada
            return response()->json(["status" =>"Error", "msg" => $th], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            // busca pela empresa
            $empresa = Empresa::find($id);

            // se não achou, retorna a informação
            if (!$empresa) {
                return response()->json(["status" =>"ERROR", "msg" => "Empresa não encontrada na base de dados."], 500);
            }
    
            // empresa é deletada
            $empresa->delete();
            return response()->json(["status" =>"SUCCESS", "msg" => "Empresa deletada com sucesso."], 200);

        } catch (\Throwable $th) {
            //throw $th;
            // algo saiu errado, a informação é retornada
            return response()->json(["status" =>"ERROR", "msg" => $th], 500);
        }

    }
}
