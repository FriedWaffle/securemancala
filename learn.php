<!DOCTYPE html>
<html>
<head>
</head>
<body onload="">
<script>
function onload()
{
    if("WebSocket" in window)
    {
        
        var wsUri = "ws://127.0.0.1:5500/";
        ws = new WebSocket(wsUri);

        console.log(ws);

        var self = this;

        ws.onopen = function () {
            console.log("Opening a connection...");
            window.identified = false;
        };
        ws.onclose = function (evt) {
            console.log("I'm sorry. Bye!");
        };
        ws.onmessage = function (evt) {
            // handle messages here
        };
        ws.onerror = function (evt) {
            console.log("ERR: " + evt.data);
        };

        this.write = function () {
            if (!window.identified) {
                connection.ident();
                console.debug("Wasn't identified earlier. It is now.");
            }
            this.send(theText.value);
        };

        this.ident = function () {
            var theText = document.getElementById('theText');
            var session = "Test";
            try {
                this.send(session);
            } catch (error) {
                if (error instanceof InvalidStateError) {
                    // possibly still 'CONNECTING'
                    if (ws.readyState !== 1) {
                        var waitSend = setInterval(ws.send(session), 1000);
                    }
                }
            }
        window.identified = true;
            theText.innerHTML = "Hello!";
            say.click();
            theText.disabled = false;
        };

        this.send = function (message, callback) {
        this.waitForConnection(function () {
            ws.send(message);
            if (typeof callback !== 'undefined') {
            callback();
            }
        }, 1000);
    };

    this.waitForConnection = function (callback, interval) {
        if (ws.readyState === 1) {
            callback();
        } else {
            var that = this;
            // optional: implement backoff for interval here
            setTimeout(function () {
                that.waitForConnection(callback, interval);
            }, interval);
        }
    };
    };
}

var connection = new onload();
connection.ident();
</script>
<h1 id="theText"></h1>

</body>
</html>