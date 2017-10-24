<ul class="icons-list">
    <li>
        <a href="{{ route('admin.tipo_documento.edit',['id' => $tipo_documento->id]) }}"
           data-popup="tooltip" title="Editar" data-placement="bottom"><i
                    class="icon-pencil7"></i>
        </a>
    </li>
    <li>
        <form class="form-delete"
              action="{{ route('admin.tipo_documento.destroy',['id'=>$tipo_documento->id]) }}"
              method="POST">
            <input type="hidden" name="id" value="">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button name="delete-modal" data-popup="tooltip" title="Remover" data-placement="bottom" class="delete"
                    style="padding: 0 0 0 0;border: 0; background: transparent;">
                <i
                        class="icon-trash" style="padding-top: 2px;"></i>
            </button>
        </form>
    </li>
</ul>