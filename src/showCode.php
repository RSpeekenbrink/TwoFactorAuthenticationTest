<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Two Factor Authentication Show Code</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
      table {
        width: 50%;
      }
    </style>
  </head>
  <body>
    <div>
      Insert Secret: <input type="text" id="secretInput" /> <button id="secretButton">Insert</button>
    </div>
    <div>
      Timer: <span id="timer">-</span>
    </div>
    <div>
      <table>
        <thead>
          <th>
            Secret
          </th>
          <th>
            Code
          </th>
        </thead>
        <tbody id="secrets">

        </tbody>
      </table>
    </div>
    <script>
      var secrets = [];
      var running = false;

      $("#secretButton").click(function() {
        var newSecret = $("#secretInput").val();
        if(!isValidBase32(newSecret)) {
          alert("Invalid Key");
          return;
        }

        secrets.push(newSecret);

        updateCode(newSecret);

        if(!running) {
          running = true;
          setInterval(updateLoop, 1000);
        }
      });

      function isValidBase32(str) {
        if(str < 16 || str > 128) return false;

        var base32 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567=";

        for (var i = 0; i < str.length; i++) {
          if(!base32.includes(str[i])) return false;
        }

        return true;
      }

      var loopTime = 30;

      function updateLoop() {
        if(running) {
          if(loopTime > 0) {
            --loopTime;
            $("#timer").text(loopTime);
          }
          else {
            secrets.forEach(function(element) {
              updateCode(element);
            });
            loopTime = 30;
          }
        }
      }

      function updateCode(item) {
        if($("#"+item).length == 0) {
          var html = "<tr><td>"+item+"</td><td id='"+item+"''></td></tr>";
          $("#secrets").append(html);
        }

        $.ajax({
          url: "getCode.php",
          type: "POST",
          data: {secret:item},
          success: function(result){
            if(result.Code) {
              $('#'+item).text(result.Code);
            }
          }
        });
      }

    </script>
  </body>
</html>
