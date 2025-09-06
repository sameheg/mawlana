<form method="POST" action="/loyalty/add">
    @csrf
    <input type="number" name="customer_id" placeholder="Customer ID">
    <input type="number" name="points" placeholder="Points">
    <button type="submit">Add Points</button>
</form>
