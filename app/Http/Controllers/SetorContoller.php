<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\Setor;

class SetorContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $setor = Setor::all();

            if (count($setor) == 0) {
                return response()->json(["status" => "Error", "msg" => "Não há setores cadastrados na base de dados !"], 500);
            }

            return response()->json(["status" => "SUCCESS", "data" => $setor], 200);

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

            //instancia um novo setor
            $setor = new Setor();

            // atibui os dados
            $setor->descricao      = $request->descricao;

            // salva
            $setor->save();

            // confirma o save
            DB::commit();

            return response()->json(['status' => 'SUCCESS', 'msg' => 'Setor cadastrado com sucesso'], 200);
            

        } catch (\Exception $e) {

            // se algo deu errado, tudo é desfeito e a resposta do erro é enviada.
            DB::rollBack();
            return response()->json(['status' => 'Error', 'msg' => "Erro ao tentar cadastar o setor: ".$e], 500);
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

            // tenta buscar o setor
            $setor = Setor::find($id);

            // se não achou envia a resposta
            if (!$setor) {
                return response()->json(["status" =>"ERROR", "msg" => "Setor não encontrado na base de dados."], 500);
            }
    
            // entrega o setor solicitado
            return response()->json(["status" =>"SUCCESS", "data" => $setor], 200);

        } catch (\Throwable $th) {

            // algum erro ocorreu, e o mesmo é devolvido como resposta
            return response()->json(["status" =>"ERROR", "msg" => "Erro ao buscar o setor: ".$th], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {

            // inicia a transação
            DB::beginTransaction();


            // busca pelo setor solocitada
            $setor = Setor::find($request->setorId);

            if (!$setor) {
                return response()->json(["status" =>"Error", "msg" => "Setor não encontrado na base de dados"], 500);
            }
            // atribuis os novos dados
            $setor->descricao      = $request->descricao;

            // salva novos dados
            $setor->save();

            // confirma o save, e retorna a resposta
            DB::commit();
            return response()->json(["status" =>"SUCCESS", "msg" => "Setor atualizado com sucesso."], 200);

        } catch (\Throwable $th) {
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

            // busca pelo setor
            $setor = Setor::find($id);

            // se não achou, retorna a informação
            if (!$setor) {
                return response()->json(["status" =>"ERROR", "msg" => "setor não encontrado na base de dados."], 500);
            }
    
            // setor é deletado
            $setor->delete();
            return response()->json(["status" =>"SUCCESS", "msg" => "Setor deletado com sucesso."], 200);

        } catch (\Throwable $th) {
            //throw $th;
            // algo saiu errado, a informação é retornada
            return response()->json(["status" =>"ERROR", "msg" => $th], 500);
        }
    }
}
