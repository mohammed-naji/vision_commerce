Dear <b>{{ $data->user->name }}</b>,
<br>
<br>
Please Find attached bellow for your invoice
<br>
<a style="background: #333;color: #fff;padding: 10px 30px;text-decoration: none;border-radius: 3px;" href="{{ url('invoices/'. $inv_name) }}" download>Download File</a>

<br>
<br>
Best Rgards,
