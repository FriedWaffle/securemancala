<!DOCTYPE html>
<html>
<head></head>
<body>
<script>
    var ws = new WebSocket('ws://127.0.0.1:80/testing.php');
    console.log(ws);

    ws.onpen = function(e)
    {
        ws.send('Finally!');
    }

    ws.onmessage = function(e)
    {
        console.log(e.data);
    }

    ws.onclose = function (e) {
      console.log('Lost connection!');
      console.log(e);
  };
    ws.onerror = function (e) {
        console.log('Error!');
        console.log(e);
    };

</script>
</body>
</html>