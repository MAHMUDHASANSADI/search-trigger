<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
    <!-- Removed integrity and crossorigin -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 900px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .form-inline {
            display: flex;
            justify-content: space-between;
        }
        .search-container {
            display: flex;
            align-items: center;
        }
        .search-container input {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5 p-4 bg-white shadow-sm rounded">
        <h1 class="text-center mb-4">Items List</h1>

        <!-- Search Form -->
        <form action="{{ route('items.search') }}" method="GET" class="form-inline">
            <div class="search-container">
                <input type="text" name="query" placeholder="Search items" class="form-control" value="{{ request()->input('query') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Clear Search</a>
        </form>

        <!-- Display Success Messages -->
        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <!-- Items Table -->
        <table class="table table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($items->count() > 0)
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">No items found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $items->links('pagination::bootstrap-5') }}
        </div>

        <!-- Form to Add New Item -->
        <h2 class="mt-5">Add New Item</h2>
        <form action="{{ route('items.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter item name" required>
            </div>
            <button type="submit" class="btn btn-success">Add Item</button>
        </form>
    </div>

    <!-- Removed integrity and crossorigin -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
