<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tenant Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Tenants</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Domain</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($tenants ?? [] as $tenant)
            <tr>
                <td>{{ $tenant->name }}</td>
                <td>{{ $tenant->domain }}</td>
                <td>
                    <a href="#" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No tenants found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <a href="{{ route('admin.tenants.create') }}" class="btn btn-primary">Add Tenant</a>
</div>
</body>
</html>
