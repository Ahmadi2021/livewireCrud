<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mt-3  mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    <button type="button" class="btn btn-primary">edit</button>
                    <button type="button" class="btn btn-danger">delete</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="text" class="form-control title" name="title" wire:model="title">
                            @error('title') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetInput">close</button>
                    @if($isEdit)
                        <button type="button" class="btn btn-primary">update</button>
                    @else
                        <button type="button" class="btn btn-primary" wire:click="store">add</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
