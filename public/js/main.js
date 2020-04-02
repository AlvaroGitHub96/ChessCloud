var board; 

function main(){
    board = Chessboard('myBoard', {
        draggable: false,
        moveSpeed: 'slow',
        snapbackSpeed: 500,
        snapSpeed: 100,
        position: 'start'
      })
    var game = new Chess();
    var jugadas = document.getElementById("movimientos").textContent;
    var tableros = transformaJugadas(jugadas);
    
    var jugada_blanco = 0;
    var jugada_negro = 0;

    document.addEventListener("click",clickShowPositionBtn, false);
}



/*
//la posicion inical es algo como esto:
{a8: "bR", b8: "bN", c8: "bB", d8: "bQ", e8: "bK", …}
a8: "bR"
b8: "bN"
c8: "bB"
d8: "bQ"
e8: "bK"
f8: "bB"
g8: "bN"
h8: "bR"
a7: "bP"
b7: "bP"
c7: "bP"
d7: "bP"
e7: "bP"
f7: "bP"
g7: "bP"
h7: "bP"
a2: "wP"
b2: "wP"
c2: "wP"
d2: "wP"
e2: "wP"
f2: "wP"
g2: "wP"
h2: "wP"
a1: "wR"
b1: "wN"
c1: "wB"
d1: "wQ"
e1: "wK"
f1: "wB"
g1: "wN"
h1: "wR"

*/

//tengo algo como esto:
/*
"1.e4 e6 
2.b3 d5 
3.Ab2 dxe4 4.Cc3 Cd7 5.Cxe4 Cgf6 
        6.Cc3 Ae7 7.g3 0–0 8.Ag2 c6 9.Cge2 Cd5 10.a4 Cxc3
        11.Cxc3 Cf6 12.0–0 Cd5 13.Aa3 Axa3 14.Txa3 Cxc3 15.dxc3 De7 
        16.Ta1 Td8 17.De2 Ad7 18.Tfd1 Ae8 19.Td4 Df6 
        20.Tad1 Txd4 21.Txd4 Td8 22.Dd2 Txd4 23.Dxd4"
*/

function obtenerPieza(jugada){
  //e4
  //los if están igualados a la notación es español, para ponerlo en inglés rehacer seeders y migraciones con datos nuevos
  if(jugada.indexOf("C")!=-1){
    return turno + "N";
  }
  else if(jugada.indexOf("A")!=-1){
    return turno + "B";
  }
  if(jugada.indexOf("T")!=-1){
    return turno + "R";
  }
  if(jugada.indexOf("D")!=-1){
    return turno + "Q";
  }
  else if(jugada.indexOf("R")!=-1){
    return turno + "K";
  }
  else{
    return turno + "P";
  }
}

function cambiarLetraNumero(letra){
  if(letra=="a") return 1;
  else if(letra=="b") return 2;
  else if(letra=="c") return 3;
  else if(letra=="d") return 4;
  else if(letra=="e") return 5;
  else if(letra=="f") return 6;
  else if(letra=="g") return 7;
  else return 8;
}

function cambiarNumeroLetra(numero){
  if(numero==1) return "a";
  else if(letra==2) return "b";
  else if(letra==3) return "c";
  else if(letra==4) return "d";
  else if(letra==5) return "e";
  else if(letra==6) return "f";
  else if(letra==7) return "g";
  else return "h";
}

function getOrigen(jugada, turno){
  var aux = board.position();
  var posicion = clickShowPositionBtn();
  var pieza = obtenerPieza(jugada,turno);
  var columna, fila;
  var posibles_columnas = new Array();
  var posibles_filas = new Array();
  if(pieza == turno + "P"){
    //peon
  }
  else if(pieza == turno + "N"){
    //Caballo
    //Cf3
    if(jugada.indexOf("+") == -1 && jugada.indexOf("#") == -1){
      columna = jugada.substring(jugada.length-1,jugada.length);
      fila = cambiarLetraNumero(jugada.substring(jugada.length-2,jugada.length-1));
    }
    else{
      columna = jugada.substring(jugada.length-2,jugada.length-1);
      fila = cambiarLetraNumero(jugada.substring(jugada.length-3,jugada.length-2));
    }
    //columnas
    if(columna < 8){
      posibles_columnas.add(columna+1);
    }
    if(columna > 1){
      posibles_columnas.add(columna-1);
    }
    if(columna < 7){
      posibles_columnas.add(columna+2);
    }
    if(columna > 2){
      posibles_columnas.add(columna-2);
    }
    //filas
    if(fila < 8){
      posibles_filas.add(fila+1);
    }
    if(fila > 1){
      posibles_filas.add(fila-1);
    }
    if(fila < 7){
      posibles_filas.add(fila+2);
    }
    if(fila > 2){
      posibles_filas.add(fila-2);
    }
    //g1,g5,e1,e5,h2,h4,d2,d4
    //hace for o for each
    if(aux[posibles_columnas[0]+posibles_filas[0]]==pieza){
      return posibles_columnas[0] + cambiarNumeroLetra(posibles_filas[0]);
    }
  }
  else if(pieza == turno + "B"){
    //Alfil
  }
  else if(pieza == turno + "R"){
    //Torre
  }
  else if(pieza == turno + "Q"){
    //Dama
  }
  else{
    //Rey
  }
}

function transformaJugadas(jugadas){
  var split = jugadas.split(".");
  var n = split.length - 1;
  var posicion_inicial = board.fen();
  var aux = new Array(posicion_inicial);
  var jugada;
  var blancas, negras;
  for(var i = 1; i <= n; i++){
    jugada = split[i].split(" ");
    //e4
    blancas = jugada[0];
    board.move(getOrigen(blancas, "w") + '-' +  blancas);
    aux.add(board.fen());
    //e6
    negras = jugada[1];
    board.move(getOrigen(negras, "b") + '-' +  negras);
    aux.add(board.fen());
  }
  return aux;
}

///////////////////////////////////

function clickShowPositionBtn () {
  console.log('Current position as an Object:')
  console.log(board.position())

  console.log('Current position as a FEN string:')
  console.log(board.fen())
}

//para cargar una jugada debemos al hacer click en ella obtener su posicion (clickShowPositionBtn) y cargarlo en cfg como el ejemplo:
/*var config = {
  position: {
    d4: 'wP',
    d6: 'bK',
    e4: 'wK'
  }
};
//luego lo asignamos a board
var board = Chessboard('myBoard', config) */

document.addEventListener("DOMContentLoaded",main, false);