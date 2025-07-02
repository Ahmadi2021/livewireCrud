<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-3  mb-3" data-bs-toggle="modal" wire:click="create">
        Add +
    </button>
    @if (session()->has('message'))
        <div class="alert alert-success mt-2">{{ session('message') }}</div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">id</th>
            <th scope="col">title</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $key=>$category)
            <tr>
                <th>{{++$key}}</th>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td>
                    <button type="button" class="btn btn-primary" wire:click="edit( {{$category->id}} )">edit</button>
                    <button type="button" class="btn btn-danger" wire:click="delete( {{$category->id}} )">delete</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


    <!-- Modal -->
    <div  wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group mb-2">
                            <label>Title</label>
                            <input type="text" class="form-control "  wire:model="title">
                            @error('title') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetInput">close</button>
                    @if($isEdit)
                        <button type="button" class="btn btn-primary" wire:click="update">update</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="store">add</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add the script here -->
<script>
    window.addEventListener('hideModal', () => {
        Livewire.dispatch('resetForm');
        const modalElement = document.getElementById('exampleModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        } else {
            // If it's not initialized, create it first
            const newModal = new bootstrap.Modal(modalElement);
            newModal.hide();
        }
    });
    window.addEventListener('showModal',() => {
        Livewire.dispatch('resetForm');
        const modalElement = document.getElementById('exampleModal');
        const modal = new bootstrap.Modal(modalElement);
        if (modal) {
            modal.show();
        }
    });
</script>
