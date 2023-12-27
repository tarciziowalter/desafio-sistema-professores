<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Display a listing of the messages.
     */
    public function selectAll()
    {
        $data = Message::where('user_id', session('id'))->get();

        foreach ($data as $key => $value) {
            $data[$key]->date_register = date('d/m/Y', strtotime($value->date_register));
            $data[$key]->description = mb_strimwidth($value->description, 0, 50, '...');           
            $data[$key]->answer = mb_strimwidth($value->answer, 0, 50, '...');   
            
            // Adiciona o botão "Responder" apenas se o status for 0 (pendente)
            if ($value->status == 0) {
                $data[$key]->actions = '<a href="' . route('message.show', ['id' => $value->id]) . '" class="btn btn-sm btn-info">Visualizar</a>
                                        <a href="' . route('message.reply', ['id' => $value->id]) . '" class="btn btn-sm btn-success">Responder</a>
                                        <a href="' . route('message.edit', ['id' => $value->id]) . '" class="btn btn-sm btn-warning">Editar</a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteMessage(' . $value->id . ')">Excluir</button>';
            } else {
                // Adiciona os botões restantes sem o botão "Responder"
                $data[$key]->actions = '<a href="' . route('message.show', ['id' => $value->id]) . '" class="btn btn-sm btn-info">Visualizar</a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteMessage(' . $value->id . ')">Excluir</button>';
            }

            $data[$key]->status = $value->status == 0 ? '<span class="badge bg-danger">Pendente</span>' : '<span class="badge bg-success">Respondido</span>';

        }

        return $data;
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
        
        $request->validate([
            'user_id' => 'required',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $message = new Message();
        
        $message->date_register = date('Y-m-d');
        $message->user_id = $request->input('user_id');
        $message->name = $request->input('name');
        $message->description = $request->input('description');

        $message->save();

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $message = Message::where('user_id', session('id'))->where('id', $id)->first();
        if($message){
            return view('admin.home.show', compact('message'));
        }else{
            return redirect()->route('dashboard')->with('error', 'Mensagem não encontrada!');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $message = Message::where('user_id', session('id'))->where('id', $id)->first();
        if($message){
            return view('admin.home.edit', compact('message'));
        }else{
            return redirect()->route('dashboard')->with('error', 'Mensagem não encontrada!');
        }
    }   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        // Buscar a mensagem pelo ID
        $message = Message::find($id);

        if (!$message) {
            return redirect()->back()->with('error', 'Mensagem não encontrada.');
        }

        // Atualizar os campos
        $message->name = $request->input('name');
        $message->description = $request->input('description');

        // Salvar as alterações
        $message->save();

        return redirect()->route('dashboard')->with('success', 'Mensagem atualizada com sucesso!');

    }


    /**
     * Display the specified resource.
     */
    public function reply(string $id)
    {
        $message = Message::where('user_id', session('id'))->where('id', $id)->first();
        if($message){
            return view('admin.home.reply', compact('message'));
        }else{
            return redirect()->route('dashboard')->with('error', 'Mensagem não encontrada!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateReply(Request $request, string $id)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        // Buscar a mensagem pelo ID
        $message = Message::find($id);

        if (!$message) {
            return redirect()->back()->with('error', 'Mensagem não encontrada.');
        }

        // Atualizar os campos
        $message->answer = $request->input('answer');
        $message->status = 1;

        // Salvar as alterações
        $message->save();

        return redirect()->route('dashboard')->with('success', 'Mensagem respondida com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar a mensagem pelo ID
        $message = Message::where('user_id', session('id'))->where('id', $id)->first();
        if($message){
            if (!$message) {
                return redirect()->back()->with('error', 'Mensagem não encontrada.');
            }
    
            // Excluir a mensagem
            $message->delete();
    
            return redirect()->back()->with('success', 'Mensagem excluída com sucesso!');

        }else{
            return redirect()->route('dashboard')->with('error', 'Mensagem não encontrada!');
        }

    }
}
