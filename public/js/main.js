var board,posiciones; 
var chess = new Chess();
var pos = 0;

function main(){
  //primero inicio el tablero
  board = Chessboard('myBoard', {
      draggable: false,
      moveSpeed: 'slow',
      snapbackSpeed: 500,
      snapSpeed: 100,
      position: 'start'
    })
  //ahora creo el array de posiciones para navegar de una a otra
  var jugadas = document.getElementById("movimientos-procesados").textContent;
  posiciones = transformaJugadas(jugadas);
  //ahora muestro sólo lo construido
  document.getElementById("movimientos").classList.add("invisible");
  //creo los listeners para cada jugada y de estas ir a su posición
  var div = document.getElementById("listeners");
  let spans = div.querySelectorAll("span");
  for(var i = 0; i < spans.length; i++){
    spans[i].addEventListener("click",cargarJugada, false);
  }
  //inicializo y enlazo los botones siguiente y anterior
  //next
  let next = document.getElementById("next");
  next.addEventListener("click",NextMovement, false);
  //before
  let before = document.getElementById("before");
  before.addEventListener("click",BeforeMovement, false);
}

function transformaJugadas(jugadas){
  var array_jugadas = jugadas.split(",");
  var posicion_inicial = board.fen();
  var posiciones = new Array(posicion_inicial);
  var blancas, negras;
  var posicion_array = 1;
  var i = 1;
  var texto = "";
  for(let jugada of array_jugadas){
    //1.e4 e5
    //25.Qxe3+
    var partes = jugada.split(" ");
    //e4
    blancas = partes[0];
    texto+= "<span class=" + `"jugada"` + " id=" + `"${posicion_array}"` + " > " + i + ". " + blancas + "</span>";
    posicion_array++;
    if(blancas.includes("0")){
      if(blancas.length==3){
        chess.move("O-O");
      }
      else{
        chess.move("O-O-O");
      }
    } 
    else{ 
      chess.move(blancas);
    }
    posiciones.push(chess.fen());
    //e6
    if(partes.length>1){
      negras = partes[1];
      //negras = negras.replace(/0/g,"O");
      texto+= "<span class=" + `"jugada"` + " id=" + `"${posicion_array}"` + " > " + negras + "</span>";
      if(negras.includes("0")){
        if(negras.length==3){
          chess.move("O-O");
        }
        else{
          chess.move("O-O-O");
        }
      } 
      else{ 
        chess.move(negras);
      }
      //var aux = chess.move(negras);
      posiciones.push(chess.fen());
      posicion_array++;
    }
    i++;
  }
  //para crear las jugadas con sus listeners
  var div = document.getElementById("listeners"); 
  div.innerHTML = texto;
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

function BeforeMovement(evento){
  if(pos > 0) {
    chess.load(posiciones[--pos]);
    board.position(posiciones[pos].split(" ")[0]);
  }
  else{
    alert("Es la primera jugada, no puedes retroceder más")
  }
}


function cargarJugada(nodo){
  //nodo es el span de la jugada
  let padre = nodo.target;
  var n = padre.id;
  chess.load(posiciones[n]);
  board.position(posiciones[n].split(" ")[0]);
  pos = n;
}

function cargarJugadaAux(n){
  chess.load(posiciones[n]);
  board.position(posiciones[n].split(" ")[0]);
  pos = n;
}


document.addEventListener("DOMContentLoaded",main, false);