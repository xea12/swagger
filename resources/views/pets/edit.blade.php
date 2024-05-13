<form method="POST" action="{{ route('pets.update', $pet['id']) }}">
    @csrf
    @method('PUT')  {{-- Metoda PUT dla aktualizacji danych --}}
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $pet['name'] }}" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
            <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
        </select>
    </div>
    <div class="form-group">
        <label for="photoUrls">Photo URL:</label>
        <input type="text" class="form-control" id="photoUrls" name="photoUrls" value="{{ $pet['photoUrls'][0] ?? '' }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Pet</button>
</form>
