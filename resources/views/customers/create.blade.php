<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-body-secondary">

    <div class="card position-absolute top-50 start-50 translate-middle rounded-4 shadow-lg p-4 bg-body-tertiary" style="width: 40rem;">
        <div class="text-center mb-3">
            <i class="fa-solid fa-user-plus fa-3x" style="color: blue;"></i>
        </div>
        <div class="card-body">
            <h2 class="text-center mb-4">New Customer</h2>
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nama" name="name" placeholder="Input Customer Name">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Input Customer Email">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Input Customer Phone Number" min="0">
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Input Customer Address">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
