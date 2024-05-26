<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .success {
            color: green;
            margin-bottom: 20px;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        form label {
            font-weight: bold;
            margin-right: 10px;
        }
        form input[type="file"] {
            margin-bottom: 10px;
        }
        form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        a.export-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a.export-link:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Management</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file">Import Excel File:</label>
            <input type="file" name="file" id="file" accept=".xlsx, .xls, .csv" required>
            <button type="submit">Import</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('admin.export') }}" class="export-link">Export Users to Excel</a>
    </div>
</body>
</html>
