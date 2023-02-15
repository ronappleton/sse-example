<html lang="en">
<head>
    <title>Order Page</title>
</head>
<body>
<h1>Order: <?=$order['id']?></h1>

<form method="post" action="/order/update">
    <input name="id" type="hidden" value="<?=$order['id']?>">
    <table>
        <tr>
            <td>
                <label for="name">Name</label>
            </td>
            <td>
                <input name="name" type="text" value="<?=$order['name']?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="editing_at">Edited At</label>
            </td>
            <td>
                <input name="editing_at" type="text" value="<?=$order['editing_at']?>" readonly>
            </td>
        </tr>
        <tr>
            <td>
                <label for="created_at">Created At</label>
            </td>
            <td>
                <input name="created_at" type="text" value="<?=$order['created_at']?>" readonly>
            </td>
        </tr>
        <tr>
            <td>
                <label for="updated_at">Updated At</label>
            </td>
            <td>
                <input name="updated_at" type="text" value="<?=$order['updated_at']?>" readonly>
            </td>
        </tr>
        <tr style="padding: 5px;"></tr>
        <tr></tr>
        <tr>
            <td><button type="submit">Update</button></td>
        </tr>
    </table>
</form>

<script type="application/x-javascript">
    document.onreadystatechange = () => {
        if (document.readyState === 'complete') {
            connect();
        }
    }

    function connect() {
        let socket = new WebSocket("ws://localhost:8888", "ocpp1.6");

        socket.onopen = () => {
            socket.subscribe('orders', (args) => console.log(args))
        }

        socket.onmessage = (event) => {
            alert(`[message] Data received from server: ${event.data}`);
        }

        socket.onclose = function(event) {
            if (event.wasClean) {
                alert(`[close] Connection closed cleanly, code=${event.code} reason=${event.reason}`);
                console.log(event)
            } else {
                alert('[close] Connection died');
                console.log(event.code)
            }
        };

        socket.onerror = function(error) {
            console.log(error);
            alert(error);
        };
    }
</script>
</body>
</html>
