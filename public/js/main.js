var board,posiciones; 
var chess = new Chess();
var pos = 0;
//chess.move('e4')
function main(){
    board = Chessboard('myBoard', {
        draggable: false,
        moveSpeed: 'slow',
        snapbackSpeed: 500,
        snapSpeed: 100,
        position: 'start'
      })
    
    //tras hacer el array de tableros, ver iniciar el "game" y con game.pgn ir construyendo la partida
    //con notaicón en inglés y los evenlistener para saltar a las jugadas
    var jugadas = document.getElementById("movimientos-procesados").textContent;
    posiciones = transformaJugadas(jugadas);

    var next = document.getElementById("NextMovement");
    var before = document.getElementById("BeforeMovement");

    next.addEventListener("click",NextMovement, false);
    before.addEventListener("click",BeforeMovement, false);
}

function transformaJugadas(jugadas){
  var array_jugadas = jugadas.split(",");
  var posicion_inicial = board.fen();
  var posiciones = new Array(posicion_inicial);
  var blancas, negras;
  var i = 0;
  for(let jugada of array_jugadas){
    var partes = jugada.split(" ");
    //e4
    blancas = partes[0];
    chess.move(blancas);
    posiciones.push(chess.fen());
    i++;
    //e6
    if(i==51){
      console.log("nothing");
    }
    negras = partes[1];
    chess.move(negras);
    posiciones.push(chess.fen());
    i++;
  }
  return posiciones;
}

function NextMovement(evento){
  if(pos < posiciones.length) {
    chess.load(posiciones[++pos]);
    board.position(posiciones[pos].split(" ")[0]);
  }
  else{
    alert("Es la última jugada, no puedes avanzar más")
  }
}

function cargarAuxiliar(n){
  chess.load(posiciones[n]);
  var posicion = posiciones[n].split(" ")[0];
  board.position(posicion);
}

/*function LoadMovement(evento){
  let actual = chess.fen();
  var pos, i = 0;
  for(posicion of posiciones){
    if(actual==poisicion){
      pos = i;
    }
    i++
  }
  chess.load(movimientos[pos]);
  board.position(movimientos[pos].split("")[0])
}*/

function BeforeMovement(evento){
  if(pos > 0) {
    chess.load(posiciones[--pos]);
    board.position(posiciones[pos].split("")[0]);
  }
  else{
    alert("Es la primera jugada, no puedes retroceder más")
  }
}


document.addEventListener("DOMContentLoaded",main, false);