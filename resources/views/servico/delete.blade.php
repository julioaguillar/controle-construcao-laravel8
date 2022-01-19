<a href="#" class="link-danger" alt="Excluir item" role="button" data-bs-toggle="modal" data-bs-target="#servicoModal_{{ $servico->id }}"><i data-feather="trash-2"></i></a>
<form action="{{ $url }}" method="POST">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="servicoModal_{{ $servico->id }}" tabindex="-1" aria-labelledby="servicoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servicoModalLabel">Aonconstru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Confirma a exclusão do serviço?<br />
                    {{ $servico->descricao }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
