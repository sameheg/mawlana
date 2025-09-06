<form method="POST" action="/coupons/issue">
    @csrf
    <input type="number" name="customer_id" placeholder="Customer ID">
    <input type="number" name="discount" placeholder="Discount">
    <button type="submit">Issue Coupon</button>
</form>
