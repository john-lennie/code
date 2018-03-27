<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drag and Drop - Draggable JS</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@shopify/draggable@1.0.0-beta.2/lib/draggable.min.js"></script>

    <style>

    .drag {
      display: flex;
    }

    li{
      border: solid 1px;
      width: 150px;
      margin: 10px;
      padding: 5px;
    }

    li:hover{
      cursor: pointer;
    }

    ul{
      border: solid 1px;
      width: 200px;
      margin: 15px;
      list-style-type: none;
    }
    </style>

  </head>
  <body>

  <?php include('../Includes/header.php'); ?>

  <div class="drag">
    <ul  id="coin-drag">
    </ul>
    <ul  id="coin-drop">
    </ul>
  </div>

  <script type="text/javascript">
  const droppable = new Draggable.Droppable(document.querySelectorAll("ul"), {
    draggable: "li",
    droppable: "ul"
  });

  droppable.on("droppable:over", function() {
    $("ul").removeClass("draggable-droppable--occupied");
  });
  droppable.on("droppable:out", () => console.log("droppable:out"));

  function Drag() {
    $.get("https://api.coinmarketcap.com/v1/ticker/?limit=5").done(function(
      data
    ) {
      $.map(data, function(data) {
        let resultMarkup = liResult(data);
        $("#coin-drag").append(resultMarkup);
      });
    });
  }

  function liResult(data) {
    const markup = `<li>
              <h2> ${data.name} </h2>
              <p id='price-btc'> ${data.price_btc} </p>
              <p id='price-usd'> ${data.price_usd} </p>

          </li>`;
    return markup;
  }

  Drag();
  </script>
  </body>
</html>
