<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Livro;

class Livros extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nome, $ibsn, $descricao;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.livros.view', [
            'livros' => Livro::latest()
						->orWhere('nome', 'LIKE', $keyWord)
						->orWhere('ibsn', 'LIKE', $keyWord)
						->orWhere('descricao', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->nome = null;
		$this->ibsn = null;
		$this->descricao = null;
    }

    public function store()
    {
        $this->validate([
		'nome' => 'required',
		'ibsn' => 'required',
		'descricao' => 'required',
        ]);

        Livro::create([ 
			'nome' => $this-> nome,
			'ibsn' => $this-> ibsn,
			'descricao' => $this-> descricao
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Livro Successfully created.');
    }

    public function edit($id)
    {
        $record = Livro::findOrFail($id);

        $this->selected_id = $id; 
		$this->nome = $record-> nome;
		$this->ibsn = $record-> ibsn;
		$this->descricao = $record-> descricao;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nome' => 'required',
		'ibsn' => 'required',
		'descricao' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Livro::find($this->selected_id);
            $record->update([ 
			'nome' => $this-> nome,
			'ibsn' => $this-> ibsn,
			'descricao' => $this-> descricao
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Livro Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Livro::where('id', $id);
            $record->delete();
        }
    }
}
