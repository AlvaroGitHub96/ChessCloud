@extends('layouts.master')
@section('title','ChessCloud')
@section('content')
<meta charset="UTF-8">
  
  <div id="board" style="width: 400px"></div>
  <p>Status: <span id="status"></span></p>
  <p>FEN: <span id="fen"></span></p>
  <p>PGN: <span id="pgn"></span></p>
  <script src="board/website/js/jquery-3.2.1.min.js"></script>
  <script src="board/src/chessboard.js"></script>
  <script src="play/chess.js"></script>
  
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Other game?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button id="startBtnModalFooter" type="button" class="btn btn-info" data-dismiss="modal">Play</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

  <div>
    <button id="back" type="button" class="btn btn-info">Back</button>
    <button id="showPositionBtn" type="button" class="btn btn-info">Get Position</button>
    <button id="startBtn" type="button" class="btn btn-info">Start Positon</button>
  </div>
  
  <!--<div>
    <button id="back" type="button" class="btn btn-info">Back</button>
    <button id="next" type="button" class="btn btn-info">Next</button>
  </div>
  <div>
    <button id="resign" type="button" class="btn btn-info">Resign</button>
    <button id="draw" type="button" class="btn btn-info">Draw</button>
  </div>-->
  <script>
    var board,
    game = new Chess(),
    statusEl = $('#status'),
    fenEl = $('#fen'),
    pgnEl = $('#pgn');
    var jugadas = [];
    var i = 0;

    // do not pick up pieces if the game is over
    // only pick up pieces for the side to move
    var onDragStart = function(source, piece, position, orientation) {
      if (game.game_over() === true ||
          (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
          (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
        return false;
      }
    };

    var onDrop = function(source, target) {
      // see if the move is legal
      var move = game.move({
        from: source,
        to: target,
        promotion: 'q' // NOTE: always promote to a queen for example simplicity
      });

      // illegal move
      if (move === null) return 'snapback';

      updateStatus();
    };

    // update the board position after the piece snap 
    // for castling, en passant, pawn promotion
    var onSnapEnd = function() {
      board.position(game.fen());
    };

    var updateStatus = function() {
      var status = '';

      var moveColor = 'White';
      if (game.turn() === 'b') {
        moveColor = 'Black';
      }

      // checkmate?
      if (game.in_checkmate() === true) {
        status = 'Game over, ' + moveColor + ' is in checkmate.';
        //document.getElementById("myModal").show();

      }

      // draw?
      else if (game.in_draw() === true) {
        status = 'Game over, drawn position';
        //document.getElementById("myModal").showModal();
      }

      // game still on
      else {
        status = moveColor + ' to move';

        // check?
        if (game.in_check() === true) {
          status += ', ' + moveColor + ' is in check';
        }
      }
      statusEl.html(status);
      fenEl.html(game.fen());
      jugadas.push(game.fen());
      i++;
      //console.log(jugadas);
      pgnEl.html(game.pgn());
    };
    var cfg = {
      draggable: true,
      position: 'start',
      onDragStart: onDragStart,
      onDrop: onDrop,
      onSnapEnd: onSnapEnd
    };
    board = ChessBoard('board', cfg);
    //para saber mi posicion
    function clickShowPositionBtn () {
      console.log('Current position as an Object:')
      console.log(board.position())

      console.log('Current position as a FEN string:')
      console.log(board.fen())
    }
    updateStatus();
    /*$('#resign').on('click', function(){
      if(game.turn() === 'b'){
        //play black
        status = 'white win by resign';
      }
      else{
        //play white
        status = 'black win by resign';
      }
    });*/
    $('#startBtn').on('click', board.start);
    //$('#back').on('click', board.fenToObj(jugadas[i-1]));
    $('#showPositionBtn').on('click', clickShowPositionBtn)
  </script>
