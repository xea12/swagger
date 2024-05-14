<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Podgląd Zwierzaka</title>
</head>
<body>
<h1>Dane zwierzaka</h1>
<p><strong>ID:</strong> {{ $pet['id'] ?? 'Brak id' }}</p>
<p><strong>Name:</strong> {{ $pet['name'] ?? 'Brak imienia' }}</p>
<p><strong>Status:</strong> {{ $pet['status'] ?? 'Brak statusu' }}</p>
<p><strong>Kategoria:</strong> {{ $pet['category']['name'] ?? 'Brak kategorii' }}</p>
<p><strong>Link do zdjęcia:</strong> {{ $pet['photoUrls'][0] ?? 'Brak zdjęcia' }}</p>
<p><strong>Tagi:</strong> {{ $pet['tags']['name'] ?? 'Brak tagów' }}</p>

</body>
</html>
