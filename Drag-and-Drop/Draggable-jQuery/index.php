<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Drag and Drop - Draggable jQuery</title>
  <link rel="stylesheet" href="../styles/style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <style>
  #draggable {
    cursor: -moz-grab;
    cursor: -webkit-grab;
    cursor: grab;
    width: 100px;
    height: 100px;
    padding: 0.5em;
    float: left;
    margin: 10px 10px 10px 0;
  }
  #drop1, #drop2 {
    width: 150px;
    height: 150px;
    padding: 0.5em;
    float: left;
    margin: 10px;
  }
  .ui-draggable-dragging {
    cursor: -moz-grabbing !important;
    cursor: -webkit-grabbing !important;
    cursor: grabbing !important;
  }
  </style>

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#draggable" ).draggable({ revert: "valid" });

    $( "#drop1, #drop2" ).droppable({
      classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
      },
      drop: function( event, ui ) {
        $( this )
        .addClass( "ui-state-highlight" )
        .find( "p" )
        .html( "Dropped!" );
      }
    });
  } );
  </script>
</head>
<body>

<?php include('../Includes/header.php'); ?>

<div id="draggable" data-target="drop1" class="ui-widget-content">
  <p>Drag Option 1</p>
</div>

<div id="drop1" class="ui-widget-header">
  <p>Drop Zone 1</p>
</div>

<div id="drop2" class="ui-widget-header">
  <p>Drop Zone 2</p>
</div>


</body>
</html>
