<div class="btn-group">
    <a href="{{ url()->current() . '/' . $item->id }}" class="btn btn-info">
        <i class="fa fa-info"></i>
    </a>
    <a href="{{ url()->current() . '/' . $item->id }}/edit" class="btn btn-warning">
        <i class="fa fa-edit"></i>
    </a>
    <x-button.delete-button id="{{ $item->id }}" />

</div>
