<html lang="en">
<head>
    <title>Order Page</title>
</head>
<body>
<h1>Orders</h1>
<table style="border: black 1px solid;">
    <tr>
        <td colspan="1"><strong>Id</strong></td>
        <td colspan="3"><strong>Name</strong></td>
        <td colspan="2"><strong>Editing At</strong></td>
        <td colspan="2"><strong>Created At</strong></td>
        <td colspan="2"><strong>Updated At</strong></td>
    </tr>
    <?php foreach ($orders as $order) { ?>
        <tr>
            <td colspan="1"><a href="/order/<?=$order['id']?>"><?=$order['id']?></a></td>
            <td colspan="3"><?=$order['name']?></td>
            <td colspan="2"><?=$order['editing_at']?></td>
            <td colspan="2"><?=$order['created_at']?></td>
            <td colspan="2"><?=$order['updated_at'] ?: 'Not updated yet'?></td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
