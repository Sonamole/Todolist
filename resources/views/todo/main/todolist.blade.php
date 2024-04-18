@extends('todo.layouts.app')
@section('page', 'inner-page')
@section('content')

    <section class="todo-section gradient-custom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card todo-card" style="margin-top: 100px;">
                        <div class="card-body">
                            <h1 class="todo-title text-center">My Todo List</h1>
                            <p class="todo-subtitle text-center">Organize your tasks efficiently!</p>

                            <!-- Tabs navs -->
                            <ul class="nav nav-pills mb-4 justify-content-center" id="todo-tabs" role="tablist">
                                <li class="nav-item">
                                    <button class="btn btn-warning nav-link active" id="task-tab" data-toggle="pill"
                                        href="#task" role="tab" aria-controls="task"
                                        aria-selected="true">Tasks</button>
                                </li>&nbsp;&nbsp;
                                <li class="nav-item">
                                    <button class="btn btn-warning nav-link" id="category-tab" data-toggle="pill"
                                        href="#cat" role="tab" aria-controls="category"
                                        aria-selected="false">Categories</button>
                                </li>&nbsp;&nbsp;

                                <li class="nav-item">
                                    <button class="btn btn-warning nav-link" id="completed-tab" data-toggle="pill"
                                        href="#completed" role="tab" aria-controls="completed"
                                        aria-selected="false">Completed</button>
                                </li>&nbsp;&nbsp;

                            </ul>

                            <!-- Tabs content -->
                            <div class="tab-content" id="todo-tabs-content">
                                <div class="tab-pane fade show active" id="task" role="tabpanel"
                                    aria-labelledby="task-tab">
                                    <!-- Tasks creating -->
                                    <form action="{{ route('todo_create') }}" method="post" class="todo-form">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Add a new task" required>
                                            <select name="category" class="form-control select2" required>
                                                <option value="">Select a category</option>
                                                @foreach ($todocategory as $todo)
                                                    <option value="{{ $todo->id }}">{{ $todo->title }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-warning ms-2">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                    <label for="category">Choose Your Category</label>

                                    <select name="category" id="category">
                                        <option value="all">All</option>
                                        @foreach ($todocategory as $todoc)
                                            <option value="{{ $todoc->id }}">{{ $todoc->title }}</option>
                                        @endforeach
                                    </select>



                                    <div id="todos">

                                            @foreach ($todocreate as $todo)
                                                @unless ($todo->completed)
                                                    <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded"
                                                        style="background-color: #f4f6f7;">
                                                        <div class="todo" data-category="{{ $todo->category }}">
                                                            <p>{{ $todo->title }}-{{ $todo->categorys->title }}</p>

                                                            <button type="button"
                                                                class="btn btn-primary waves-effect waves-light ml-auto mr-3 edit-btn">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <form action="{{ route('todo_update', ['id' => $todo->id]) }}"
                                                                method="post" class="hidden-edit-form">
                                                                @csrf
                                                                <input type="text" name="title"
                                                                    value="{{ $todo->title }}">
                                                                <select name="category" required>
                                                                    @foreach ($todocategory as $ctodo)
                                                                        <option
                                                                            @if ($todo->category_id == $ctodo->id) {{ 'selected' }} @endif
                                                                            value="{{ $ctodo->id }}">{{ $ctodo->title }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Task</button>
                                                            </form>

                                                            <!-- Tasks completed -->
                                                            <form action="{{ route('todo_complete', ['id' => $todo->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success"  style="margin-top:5px; ">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>

                                                            <!-- Tasks deleting -->
                                                            <form action="{{ route('todo_delete', ['id' => $todo->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                {{-- @method('DELETE') --}}
                                                                <button type="submit" style="margin-top:5px; "
                                                                    class="btn btn-danger waves-effect waves-light">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>

                                                    </div>
                                                    </li>
                                                @endunless
                                            @endforeach
                                        {{-- </ul> --}}
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="cat" role="tabpanel" aria-labelledby="category-tab">
                                    <!-- Category creating -->
                                    <form action="{{ route('category_create') }}" method="post" class="todo-form">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Add a new category" required>
                                            <button class="btn btn-warning" type="submit">Add Category</button>
                                        </div>
                                    </form>
                                    <ul class="list-group todo-list">
                                        @foreach ($todocategory as $todo)
                                            <li class="list-group-item">{{ $todo->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="completed" role="tabpanel"
                                    aria-labelledby="completed-tab">
                                    <!-- Completed tasks -->
                                    <ul class="list-group todo-list">
                                        @foreach ($todocreate as $todo)
                                            @if ($todo->completed == 1)
                                                <li class="list-group-item">{{ $todo->title }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // handle tab switching
        document.addEventListener("DOMContentLoaded", function() {
            var tabs = document.querySelectorAll('[data-toggle="pill"]');
            tabs.forEach(function(tab) {
                tab.addEventListener("click", function(event) {
                    event.preventDefault();
                    var target = event.target.getAttribute("href");
                    document.querySelectorAll(".tab-pane").forEach(function(tabContent) {
                        tabContent.classList.remove("show", "active");
                    });
                    document.querySelector(target).classList.add("show", "active");
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Get all edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');

            // Add click event listener to each edit button
            editButtons.forEach(function(editBtn) {

                editBtn.addEventListener('click', function() {
                    // Toggle visibility of the corresponding hidden form

                    const hiddenForm = editBtn.nextElementSibling;
                    hiddenForm.classList.toggle('show');
                });
            });
        });

        document.getElementById('category').addEventListener('change', function() {
            var categoryId = this.value;
            var todos = document.querySelectorAll('.todo');

            todos.forEach(function(todo) {
                if (categoryId === 'all' || todo.dataset.category === categoryId) {
                    todo.style.display = 'block';
                } else {
                    todo.style.display = 'none';
                }
            });
        });
    </script>

@endsection
