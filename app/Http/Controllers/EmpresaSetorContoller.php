<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\EmpresaSetor;
use App\Models\Setor;

class EmpresaSetorContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $empresa_setor = EmpresaSetor::join('empresa', 'empresa_setor.empresa_id', '=', 'empresa.id')
            ->join('setor', 'empresa_setor.setor_id', '=', 'setor.id')
            ->get();

            if (count($empresa_setor) == 0) {
                return response()->json(["status" => "Error", "msg" => "Não há registros na base de dados"], 500);
            }

            return response()->json(["status" => "SUCCESS", "data" => $empresa_setor], 200);

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
            $empresa_setor = new EmpresaSetor();

            // atibui os dados
            $empresa_setor->empresa_id    = $request->empresa_id;
            $empresa_setor->setor_id      = $request->setor_id;

            // salva
            $empresa_setor->save();

            // confirma o save
            DB::commit();

            return response()->json(['status' => 'SUCCESS', 'msg' => 'Setor atribuido a empresa com sucesso'], 200);
            

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
    public function edit($empresaId, $setorId)
    {
        try {

            // select
            $empresa_setor = EmpresaSetor::join('empresa', 'empresa_setor.empresa_id', '=', 'empresa.id')
            ->join('setor', 'empresa_setor.setor_id', '=', 'setor.id')
            ->select('empresa_setor.*', 'empresa.razao_social as razao_social', 'setor.descricao as nome_setor')
            ->where('empresa_id', $empresaId)
            ->where('setor_id', $setorId)
            ->get();

            // se não achou envia a resposta
            if (!$empresa_setor) {
                return response()->json(["status" =>"ERROR", "msg" => "Não há registros na base de dados."], 500);
            }

            // entrega
            return response()->json(["status" =>"SUCCESS", "data" => $empresa_setor], 200);

        } catch (\Throwable $th) {

            // algum erro ocorreu, e o mesmo é devolvido como resposta
            return response()->json(["status" =>"ERROR", "msg" => "Erro na busca: ".$th], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            // Inicia a transação
            DB::beginTransaction();
        
            // Remove o registro existente pois são feitos de duas chaves primarias que não podem ser alteradas
            EmpresaSetor::where('empresa_id', $request->empresa_id)
                        ->where('setor_id', $request->setor_id)
                        ->delete();
        
            // Cria um novo registro com os valores atualizados
            $novoEmpresaSetor = new EmpresaSetor();
            $novoEmpresaSetor->empresa_id = $request->empresa_id;
            $novoEmpresaSetor->setor_id = $request->setor_novo;
            $novoEmpresaSetor->save();
        
            // Confirma a transação
            DB::commit();
        
            return response()->json(["status" => "SUCCESS", "msg" => "Informações atualizadas com sucesso."], 200);
        } catch (\Throwable $th) {
            // Algo saiu errado, retorna mensagem de erro
            DB::rollBack();
            return response()->json(["status" => "Error", "msg" => $th], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // Inicia a transação
            DB::beginTransaction();

            EmpresaSetor::where('empresa_id', $request->empresa_id)
                        ->where('setor_id', $request->setor_id)
                        ->delete();

            // Confirma a transação
            DB::commit();

            return response()->json(["status" => "SUCCESS", "msg" => "Registro excluído com sucesso."], 200);
    
        } catch (\Exception $e) {
            return response()->json(["status" => "Error", "msg" => "Erro: " + $e], 500);
        }
    }

    public function setorNotIn(String $id)
    {
        try {
            
            // Builder::whereNotIn espera um array. se não for um, crie um com o mesmo 'id'
            $id = is_array($id) ? $id : [$id];

            $empresa_setor = Setor::whereNotIn('id', function($query) use ($id) {
                $query->select('setor_id')->from('empresa_setor')->whereIn('empresa_id', $id);
            })->get();

            if (!$empresa_setor) {
                return response()->json(["status" => "Error", "message" => "Não foi encontrado registro"], 500);
            }

            return response()->json(["status" => "SUCCESS", "data" => $empresa_setor], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'Error', 'message' => $e], 500);
        }
    }
}
