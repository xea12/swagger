<form action="{{ route('pets.store') }}" method="POST">
    @csrf  {{-- Token CSRF dla bezpieczeństwa formularza --}}
    <div class="form-group">
        <label for="name">Id:</label>
        <input type="number" class="form-control" id="id" name="id" required>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" id="status" name="status">
            <option value="available">Available</option>
            <option value="pending">Pending</option>
            <option value="sold">Sold</option>
        </select>
    </div>
    <div class="form-group">
        <label for="photoUrls">Photo URL:</label>
        <input type="text" class="form-control" id="photoUrls" name="photoUrls" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Pet</button>
</form>
