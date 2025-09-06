<form method="POST" action="/employees">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="number" step="0.01" name="hourly_rate" placeholder="Hourly Rate">
    <button type="submit">Save</button>
</form>
