<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pets List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .pet-list {
            list-style-type: none;
            padding: 0;
            width: 40vw;
            margin: 0 auto;
        }

        .pet-item {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .pet-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 20px;
        }

        .pet-info {
            flex-grow: 1;
        }

        .pet-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<h1>Available Pets</h1>
<div style="text-align: center; margin-bottom: 20px">
    <a href="{{ route('pets.create') }}" class="btn btn-primary">Dodaj zwierzaka</a>
</div>

<ul class="pet-list">
    @foreach ($pets as $pet)
        <li class="pet-item">
            @if (!empty($pet['photoUrls']))
                <img src="{{ $pet['photoUrls'][0] }}" alt="{{ $pet['name'] ?? 'Brak imienia' }}" class="pet-image">
            @endif
            <div class="pet-info">
                <h3>{{ $pet['id'] ?? 'No id' }} - {{ $pet['name'] ?? 'No Name' }}</h3>

            </div>
            <div class="pet-actions">
                <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-secondary">Edytuj</a>
                <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </li>
    @endforeach
</ul>
</body>
</html>
