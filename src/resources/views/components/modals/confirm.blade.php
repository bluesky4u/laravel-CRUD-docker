@props([
    'id' => '',
    'action' => '',
    'confirm' => 'Do you want to delete this row?',
    'buttonClass' => 'btn btn-sm btn_option',
    'method' => 'delete',
])

<button type="button" class="{{ $buttonClass }}" data-bs-toggle="modal" data-bs-target="#{{ $id }}"></button>

<div class="modal fade" id="{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="ms-2 mb-0">Delete</h5>
                <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3">
                <p class="ms-3">{{ $confirm }}</p>
                <div class="d-flex justify-content-end mt-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary me-3 px-4" data-bs-dismiss="modal">No</button>
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($method === 'delete')
                            @method('DELETE')
                        @endif
                        <button class="btn btn-sm btn-danger px-4">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>