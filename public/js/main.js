var board; 
var chess = new Chess();
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

function obtenerPieza(jugada,turno){
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
  var columna = "";
  var fila = "";
  var posibles_columnas = new Array();
  var posibles_filas = new Array();
  var origen = "";
  var busco_columnas = true;
  var aux_columna,aux_fila;
  jugada.replace('+','');
  jugada.replace('#','');
  jugada.replace('x','');
  if(jugada.length==4){
    columna= cambiarLetraNumero(jugada[1]);
    busco_columnas = false;
  }
  else{
    //detección de jaque y mate para sacar desde el final la columna y la fila
    columna =  cambiarLetraNumero(jugada.substring(jugada.length-1,jugada.length));
  }
  //detección de jaque y mate para sacar desde el final la columna y la fila
  fila = jugada.substring(jugada.length-2,jugada.length-1);
  

  if(pieza == turno + "P"){
    //peon
    if(jugada.length==3){
      columna=jugada[1];
      busco_columnas = false;
    }
    else{
      posibles_columnas.add(columna+1);
      posibles_columnas.add(columna-1);
      posibles_columnas.add(columna);
    }

    if(turno=='w'){
      posibles_filas.add(fila-1);
      if(fila==4){
        posibles_filas.add(2);
      }
    }
    else{
      posibles_filas.add(fila+1);
      if(fila==5){
        posibles_filas.add(7);
      }
    }

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }
  }
  else if(pieza == turno + "N"){
    //Caballo
    //columnas
    if(busco_columnas){
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

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }
    
  }
  else if(pieza == turno + "B"){
    //Alfil
    aux_columna = columna;
    aux_fila = fila; 
    if(busco_columnas){
      while(aux_columna<8){
        posibles_columnas.add(aux_columna+1);
        aux_columna++;
      }
    }
    while(aux_fila<8){
      posibles_filas.add(aux_fila+1);
      aux_fila++;
    }

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }

  }
  else if(pieza == turno + "R"){
    //Torre
    aux_columna = columna;
    aux_fila = fila; 
    if(busco_columnas){
      while(aux_columna<8){
        posibles_columnas.add(aux_columna+1);
        aux_columna++;
      }
    }
    while(aux_fila<8){
      posibles_filas.add(aux_fila+1);
      aux_fila++;
    }

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }
  }
  else if(pieza == turno + "Q"){
    //Dama
    aux_columna = columna;
    aux_fila = fila; 
    if(busco_columnas){
      while(aux_columna<8){
        posibles_columnas.add(aux_columna+1);
        aux_columna++;
      }
    }
    while(aux_fila<8){
      posibles_filas.add(aux_fila+1);
      aux_fila++;
    }

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }
  }
  else{
    //Rey
    if(busco_columnas){
      if(columna<8){
        posibles_columnas.add(columna+1);
      }
      if(columna>1){
        posibles_columnas.add(columna-1);
      }
    }

    if(fila<8){
      posibles_filas.add(fila+1);
    }
    if(fila>1){
      posibles_filas.add(fila-1);
    }

    if(busco_columnas){
      for(let columna_aux of posibles_columnas){
        for(let fila_aux of posibles_filas){
          if(aux[cambiarNumeroLetra(columna_aux) + fila_aux]==pieza){
            origen = cambiarNumeroLetra(columna_aux) + fila_aux;
            break;
          }
        }
        if(origen!=""){
          break
        }
      }
    }
    else{
      for(let fila_aux of posibles_filas){
        if(aux[columna + fila_aux]==pieza){
          origen = cambiarNumeroLetra(columna_aux) + fila_aux;
          break;
        }
      }
    }

  }

  return origen;
}

function transformaJugadas(jugadas){
  var array_jugadas = jugadas.split(",");
  var posicion_inicial = board.fen();
  var aux = new Array(posicion_inicial);
  var blancas, negras;
  //comprobar enroces según el turno 
  //para enrocar 2 parametros en move-> board.move('e1-g1','h1-f1')
  for(let jugada of array_jugadas){
    var partes = jugada.split(" ");
    //e4
    blancas = partes[0];
    blancas.replace('R','K');
    blancas.replace('C','N');
    blancas.replace('T','R');
    blancas.replace('A','B');
    blancas.replace('D','Q');
    chess.move(blancas);
    /*if(blancas=="0-0"){
      board.move('e1-g1','h1-f1');
    }
    else if(blancas=="0-0-0"){
      board.move('e1-c1','a1-d1');
    }
    else{
      board.move(getOrigen(blancas, "w") + '-' +  blancas);
    }*/
    aux.push(board.fen());
    //e6
    negras = partes[1];
    negras.replace('R','K');
    negras.replace('C','N');
    negras.replace('T','R');
    negras.replace('A','B');
    negras.replace('D','Q');
    chess.move(negras);
    /*if(negras=="0-0"){
      board.move('e8-g8','h8-f8');
    }
    else if(negras=="0-0-0"){
      board.move('e8-c8','a8-d8');
    }
    else{
      board.move(getOrigen(negras, "b") + '-' +  negras);
    }*/
    aux.push(board.fen());
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