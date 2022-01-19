<a href="#" class="link-danger" alt="Excluir lançamento" role="button" data-bs-toggle="modal" data-bs-target="#compraProdutoModal_{{ $compraProduto->id }}"><i data-feather="trash-2"></i></a>
<form action="{{ $url }}" method="POST">
    @method('DELETE')
    @csrf
    <div class="modal fade" style="text-align: left" id="compraProdutoModal_{{ $compraProduto->id }}" tabindex="-1" aria-labelledby="compraProdutoModal_Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="compraProdutoModal_Label">Aonconstru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-left">
                    Confirma a exclusão do lançamento?<br />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Sim</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>
</form>
