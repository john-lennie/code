<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Drag and Drop - Interact JS</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/interactjs@1.3.3/dist/interact.min.js"></script>

    <style>
    #outer-dropzone {
      height: 140px;
    }

    #inner-dropzone {
      height: 80px;
    }

    .dropzone {
      background-color: #ccc;
      border: dashed 4px transparent;
      border-radius: 4px;
      margin: 10px auto 30px;
      padding: 10px;
      width: 80%;
      transition: background-color 0.3s;
    }

    .drop-active {
      border-color: #aaa;
    }

    .drop-target {
      background-color: #29e;
      border-color: #fff;
      border-style: solid;
    }

    .drag-drop {
      display: inline-block;
      min-width: 40px;
      padding: 2em 0.5em;

      color: #fff;
      background-color: #29e;
      border: solid 2px #fff;

      -webkit-transform: translate(0px, 0px);
              transform: translate(0px, 0px);

      transition: background-color 0.3s;
    }

    .drag-drop.can-drop {
      color: #000;
      background-color: #4e4;
    }
    </style>

  </head>
  <body>

  <?php include('../Includes/header.php'); ?>

  <div id="no-drop" class="draggable drag-drop"> #no-drop </div>

  <div id="yes-drop" class="draggable drag-drop"> #yes-drop </div>

  <div id="outer-dropzone" class="dropzone">
    #outer-dropzone
    <div id="inner-dropzone" class="dropzone">#inner-dropzone</div>
  </div>

  <script type="text/javascript">
  // target elements with the "draggable" class
  interact('.draggable')
  .draggable({
    // enable inertial throwing
    inertia: true,
    // keep the element within the area of it's parent
    restrict: {
      restriction: "parent",
      endOnly: true,
      elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
    },
    // enable autoScroll
    autoScroll: true,

    // call this function on every dragmove event
    onmove: dragMoveListener,
    // call this function on every dragend event
    onend: function (event) {
      var textEl = event.target.querySelector('p');

      textEl && (textEl.textContent =
        'moved a distance of '
        + (Math.sqrt(Math.pow(event.pageX - event.x0, 2) +
                     Math.pow(event.pageY - event.y0, 2) | 0))
            .toFixed(2) + 'px');
    }
  });

  function dragMoveListener (event) {
    var target = event.target,
        // keep the dragged position in the data-x/data-y attributes
        x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
        y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

    // translate the element
    target.style.webkitTransform =
    target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)';

    // update the posiion attributes
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
  }

  // this is used later in the resizing and gesture demos
  window.dragMoveListener = dragMoveListener;

  /* The dragging code for '.draggable' from the demo above
   * applies to this demo as well so it doesn't have to be repeated. */

  // enable draggables to be dropped into this
  interact('.dropzone').dropzone({
    // only accept elements matching this CSS selector
    accept: '#yes-drop',
    // Require a 75% element overlap for a drop to be possible
    overlap: 0.75,

    // listen for drop related events:

    ondropactivate: function (event) {
      // add active dropzone feedback
      event.target.classList.add('drop-active');
    },
    ondragenter: function (event) {
      var draggableElement = event.relatedTarget,
          dropzoneElement = event.target;

      // feedback the possibility of a drop
      dropzoneElement.classList.add('drop-target');
      draggableElement.classList.add('can-drop');
      draggableElement.textContent = 'Dragged in';
    },
    ondragleave: function (event) {
      // remove the drop feedback style
      event.target.classList.remove('drop-target');
      event.relatedTarget.classList.remove('can-drop');
      event.relatedTarget.textContent = 'Dragged out';
    },
    ondrop: function (event) {
      event.relatedTarget.textContent = 'Dropped';
    },
    ondropdeactivate: function (event) {
      // remove active dropzone feedback
      event.target.classList.remove('drop-active');
      event.target.classList.remove('drop-target');
    }
  });
  </script>
  </body>
</html>
